<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image_gallery extends Model
{
    use HasFactory;

       protected $fillable = [
        'image',
     'user_id',
    ];

}
