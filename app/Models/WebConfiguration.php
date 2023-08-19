<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebConfiguration extends Model
{
    use HasFactory;
    protected $table = 'web_configurations';
    protected $fillable = [
        'logo','name','about', 'instagram', 'twitter', 'facebook','linkedin','pinterest','dribbble'
    ];
}
