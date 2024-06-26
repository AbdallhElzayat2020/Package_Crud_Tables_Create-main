<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostFiles extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'id',
        'img',
        'post_id',
    ];
}
