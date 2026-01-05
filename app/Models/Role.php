<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'level',
        'is_active'
    ];

     protected $casts = [
        'is_active' => 'boolean',
    ];
    /**
     * Relasi ke Users
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relasi ke Permissions (Many to Many)
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    /**
     * Cek apakah role memiliki permission tertentu
     */
    public function hasPermission($permissionSlug)
    {
        return $this->permissions()->where('slug', $permissionSlug)->exists();
    }
    public function getModulesCountAttribute()
    {
        return $this->permissions()->distinct('module')->count('module');
    }

    public function getPermissionsCountAttribute()
    {
        return $this->permissions()->count();
    }

    /**
     * Assign permission ke role
     */
    // public function givePermission($permission)
    // {
    //     if (is_string($permission)) {
    //         $permission = Permission::where('name', $permission)->firstOrFail();
    //     }

    //     return $this->permissions()->syncWithoutDetaching($permission);
    // }

    // /**
    //  * Revoke permission dari role
    //  */
    // public function revokePermission($permission)
    // {
    //     if (is_string($permission)) {
    //         $permission = Permission::where('name', $permission)->firstOrFail();
    //     }

    //     return $this->permissions()->detach($permission);
    // }

    // /**
    //  * Sync permissions untuk role
    //  */
    // public function syncPermissions($permissions)
    // {
    //     return $this->permissions()->sync($permissions);
    // }
}
