<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'name', 'slug', 'images', 'short_content', 'content', 'active', 'category_id', 'author'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'author'); // user_id là tên cột khóa ngoại trong bảng blogs
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }
}
