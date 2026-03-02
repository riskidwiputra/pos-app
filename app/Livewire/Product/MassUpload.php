<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\ProductsImport;
use App\Exports\ProductTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class MassUpload extends Component
{
    use WithFileUploads;

    public $file;
    public $importing = false;
    public $importFinished = false;
    public $importedCount = 0;
    public $importErrors = []; // Ganti nama dari $errors ke $importErrors

    protected $rules = [
        'file' => 'required|mimes:xlsx,xls|max:5120',
    ];

    protected $messages = [
        'file.required' => 'File Excel wajib dipilih',
        'file.mimes' => 'File harus berformat .xlsx atau .xls',
        'file.max' => 'Ukuran file maksimal 5MB',
    ];

    public function updatedFile()
    {
        $this->validate([
            'file' => 'mimes:xlsx,xls|max:5120'
        ]);
    }

    public function downloadTemplate()
    {
        return Excel::download(new ProductTemplateExport, 'template_upload_produk.xlsx');
    }

    public function import()
    {
        $this->validate();

        $this->importing = true;
        $this->importErrors = [];
        $this->importedCount = 0;

        try {
            DB::beginTransaction();

            $import = new ProductsImport();
            Excel::import($import, $this->file->getRealPath());

            $this->importErrors = $import->getErrors();

            if (empty($this->importErrors)) {
                DB::commit();
                $this->importedCount = $import->getSuccessCount();
                $this->importFinished = true;
                
                session()->flash('message', 'Berhasil mengimpor ' . $this->importedCount . ' produk!');
                
                $this->dispatch('import-finished');
            } else {
                DB::rollBack();
                $this->importing = false;
                return;
            }

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            DB::rollBack();
            $failures = $e->failures();
            
            foreach ($failures as $failure) {
                $this->importErrors[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $this->importErrors[] = 'Terjadi kesalahan: ' . $e->getMessage();
        }

        $this->importing = false;
    }

    public function resetImport()
    {
        $this->reset(['file', 'importing', 'importFinished', 'importedCount', 'importErrors']);
    }

    public function render()
    {
        return view('livewire.product.mass-upload');
    }
}