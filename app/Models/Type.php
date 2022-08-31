<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $table = '_type';
    protected $fillable = [
        'id_cluster',
        'type_kavling',
        'luas_tanah',
        'luas_bangunan',
    ];

}
