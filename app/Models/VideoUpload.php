<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','name','category','subcategory','description'
    ];
}