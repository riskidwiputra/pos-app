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
        'username',
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
        if ($this->isSuperAdmin()) {
            return true;
        }
        return $this->role && $this->role->hasPermission($permissionSlug);
    }

     public function hasAnyPermission(array $permissionSlugs)
    {
        if (!$this->role) {
            return false;
        }

        foreach ($permissionSlugs as $slug) {
            if ($this->hasPermission($slug)) {
                return true;
            }
        }

        return false;
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
    public function isSuperAdmin(): bool
    {
        return $this->role && $this->role->level === 0;
    }

    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class, 'user_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'created_by');
    }
    
    public function mySales()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }
   
}
