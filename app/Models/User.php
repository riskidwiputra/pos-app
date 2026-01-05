<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
     protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];
    /**
     * Relasi ke Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Cek apakah user memiliki role tertentu
     */
    public function hasRole($roleSlug)
    {
        return $this->role && $this->role->slug === $roleSlug;
    }

    public function hasPermission($permissionSlug)
    {
        return $this->role && $this->role->hasPermission($permissionSlug);
    }

    public function scopeAdmins($query)
    {
        return $query->whereHas('role', function($q) {
            $q->where('level', 1);
        });
    }

    public function scopeCustomers($query)
    {
        return $query->whereHas('role', function($q) {
            $q->where('level', 2);
        });
    }
        // Helper methods
    public function isAdmin(): bool
    {
        return $this->role && $this->role->level === 1;
    }

    public function isCustomer(): bool
    {
        return $this->role && $this->role->level === 2;
    }
    // /**
    //  * Cek apakah user adalah Super Admin
    //  */
    // public function isSuperAdmin()
    // {
    //     return $this->hasRole('super_admin');
    // }

    // /**
    //  * Cek apakah user adalah Admin
    //  */
    // public function isAdmin()
    // {
    //     return $this->hasRole('admin');
    // }

    // /**
    //  * Cek apakah user adalah User biasa
    //  */
    // public function isUser()
    // {
    //     return $this->hasRole('user');
    // }
    // public function getMenuPermissions()
    // {
    //     if (!$this->role) {
    //         return collect([]);
    //     }

    //     return $this->role->permissions()
    //         ->where('type', 'menu')
    //         ->orderBy('order')
    //         ->get();
    // }

    // public function hasMenuAccess($menuSlug): bool
    // {
    //     return $this->hasPermission($menuSlug);
    // }

    // /**
    //  * Cek apakah user memiliki salah satu dari beberapa permission
    //  */
    // public function hasAnyPermission(array $permissions)
    // {
    //     if ($this->isSuperAdmin()) {
    //         return true;
    //     }

    //     foreach ($permissions as $permission) {
    //         if ($this->hasPermission($permission)) {
    //             return true;
    //         }
    //     }

    //     return false;
    // }

    // /**
    //  * Cek apakah user memiliki semua permission yang disebutkan
    //  */
    // public function hasAllPermissions(array $permissions)
    // {
    //     if ($this->isSuperAdmin()) {
    //         return true;
    //     }

    //     foreach ($permissions as $permission) {
    //         if (!$this->hasPermission($permission)) {
    //             return false;
    //         }
    //     }

    //     return true;
    // }

    // /**
    //  * Get all permissions dari role user
    //  */
    // public function getAllPermissions()
    // {
    //     if ($this->isSuperAdmin()) {
    //         return Permission::all();
    //     }

    //     return $this->role ? $this->role->permissions : collect([]);
    // }

    // /**
    //  * Scope untuk filter berdasarkan role
    //  */
    // public function scopeByRole($query, $roleName)
    // {
    //     return $query->whereHas('role', function ($q) use ($roleName) {
    //         $q->where('name', $roleName);
    //     });
    // }

    // /**
    //  * Scope untuk filter hanya user aktif
    //  */
    // public function scopeActive($query)
    // {
    //     return $query->where('is_active', true);
    // }
}
