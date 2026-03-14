<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->get('search', '');
        $selectedCategoryId = $request->get('category', null);

        // Get Categories with Product Count
        $categories = Category::withCount(['products' => function($q) {
            $q->where('status_product', 'Tersedia')->where('stok_tersedia', '>', 0);
        }])
        ->having('products_count', '>', 0)
        ->get();

        // Get Products
        $products = Product::with(['category', 'unit'])
            ->where('status_product', 'Tersedia')
            ->where('stok_tersedia', '>', 0)
            ->when($searchTerm, fn($q) => $q->where('nama_produk', 'like', "%{$searchTerm}%"))
            ->when($selectedCategoryId, fn($q) => $q->where('category_id', $selectedCategoryId))
            ->paginate(20);

        // Format products for view
        $products->getCollection()->transform(function($p) {
            return [
                'id'     => $p->id,
                'nama'   => $p->nama_produk,
                'harga'  => $p->harga_jual,
                'stok'   => $p->stok_tersedia,
                'satuan' => $p->unit->singkatan ?? 'pcs',
                'foto'   => $p->gambar_barang ? asset("storage/{$p->gambar_barang}") : $this->defaultImage(),
            ];
        });

        return view('kasir.index', compact('products', 'categories', 'searchTerm', 'selectedCategoryId'));
    }

    public function getProduct($id)
    {
        $product = Product::with(['category', 'unit'])->find($id);

        if (!$product || $product->stok_tersedia <= 0) {
            return response()->json(['error' => 'Produk tidak tersedia'], 404);
        }

        return response()->json([
            'id'     => $product->id,
            'nama'   => $product->nama_produk,
            'harga'  => $product->harga_jual,
            'stok'   => $product->stok_tersedia,
            'satuan' => $product->unit->singkatan ?? 'pcs',
            'foto'   => $product->gambar_barang ? asset("storage/{$product->gambar_barang}") : $this->defaultImage(),
            'harga_beli' => $product->harga_beli,
        ]);
    }

    public function prosesPembayaran(Request $request)
    {
        $request->validate([
            'keranjang' => 'required|array|min:1',
            'keranjang.*.product_id' => 'required|exists:products,id',
            'keranjang.*.jumlah' => 'required|integer|min:1',
            'tunai' => 'required|numeric|min:0',
        ]);

        $keranjang = $request->keranjang;
        $tunai = $request->tunai;
        
        // Hitung total
        $total = 0;
        foreach ($keranjang as $item) {
            $product = Product::find($item['product_id']);
            $total += $product->harga_jual * $item['jumlah'];
        }

        // Validasi uang cukup
        if ($tunai < $total) {
            return response()->json(['error' => 'Uang tidak cukup'], 400);
        }

        DB::beginTransaction();
        
        try {
            $invoice = $this->generateInvoice();
            $kembalian = $tunai - $total;
            
            // Create Sale
            $sale = Sale::create([
                'invoice_number' => $invoice,
                'customer_id' => null,
                'transaction_date' => now(),
                'payment_method' => 'cash',
                'notes' => null,
                'total' => $total,
                'paid_amount' => $tunai,
                'change_amount' => $kembalian,
                'status' => 'lunas',
                'created_by' => Auth::id(),
            ]);

            // Create Sale Items & Update Stock
            foreach ($keranjang as $item) {
                $product = Product::find($item['product_id']);
                
                // Check stock
                if ($product->stok_tersedia < $item['jumlah']) {
                    throw new \Exception("Stok {$product->nama_produk} tidak cukup");
                }
                
                $hargaBeli = $product->harga_beli ?? 0;
                
                // Create sale item
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'product_name' => $product->nama_produk,
                    'price' => $product->harga_jual,
                    'price_purchase' => $hargaBeli,
                    'quantity' => $item['jumlah'],
                    'unit' => $product->unit->singkatan ?? 'pcs',
                    'subtotal' => $product->harga_jual * $item['jumlah'],
                ]);

                // Update stock
                $product->decrement('stok_tersedia', $item['jumlah']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'invoice' => $invoice,
                'sale_id' => $sale->id,
                'tanggal' => now()->format('d/m/Y H:i'),
                'total' => $total,
                'tunai' => $tunai,
                'kembalian' => $kembalian,
                'items' => array_map(function($item) {
                    $product = Product::find($item['product_id']);
                    return [
                        'nama' => $product->nama_produk,
                        'harga' => $product->harga_jual,
                        'jumlah' => $item['jumlah'],
                        'subtotal' => $product->harga_jual * $item['jumlah'],
                    ];
                }, $keranjang),
                'kasir' => Auth::user()->fullname ?? Auth::user()->name,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Transaksi gagal: ' . $e->getMessage()], 500);
        }
    }

    private function generateInvoice()
    {
        $tanggal = now()->format('Ymd');
        $terakhir = Sale::whereDate('created_at', today())
                       ->latest('id')
                       ->first();
        
        $urutan = $terakhir ? intval(substr($terakhir->invoice_number, -4)) + 1 : 1;
        
        return 'INV-' . $tanggal . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
    }

    private function defaultImage()
    {
        return 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="200" height="200"%3E%3Crect fill="%23e5e7eb" width="200" height="200"/%3E%3Ctext fill="%236b7280" font-family="sans-serif" font-size="16" dy="10.5" font-weight="bold" x="50%25" y="50%25" text-anchor="middle"%3ENo Image%3C/text%3E%3C/svg%3E';
    }
}