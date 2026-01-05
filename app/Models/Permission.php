<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'module',
        'type',
        'icon',
        'url',
        'parent_id',
        'order',
        'description',
        'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Relasi ke Roles (Many to Many)
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }

    public function parent()
    {
        return $this->belongsTo(Permission::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Permission::class, 'parent_id')->orderBy('order');
    }

    public function scopeMenus($query)
    {
        return $query->where('type', 'menu')->whereNull('parent_id')->orderBy('order');
    }

    public function scopeFeatures($query)
    {
        return $query->where('type', 'feature');
    }

}
