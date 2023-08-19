<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'info',
        'role_id',
        'token',
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
        'password' => 'hashed',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'author');
    }

    public function category()
    {
        return $this->hasMany(Blog::class, 'author');
    }

    public function role()
    {
        return $this->belongsTo(role::class, 'role_id');
    }


    public function hasRole($roleName)
    {
        return $this->role->name === $roleName;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}
