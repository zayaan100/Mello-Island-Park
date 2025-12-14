<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spa extends Model
{
    use HasFactory;

    protected $table = 'spa_services';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
    ];
}
