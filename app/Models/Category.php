<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name', 'slug', 'images', 'author', 'memu_active'
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'author'); 
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }

    public function blogsCount()
    {
        return $this->blogs()->where('active',1)->count();
    }
}
