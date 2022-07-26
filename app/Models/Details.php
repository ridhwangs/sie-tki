<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;
    protected $table = '_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_cluster',
        'type_kavling',
        'header',
        'information',
        'img_src',
    ];
}
