<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = '_attribute';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_main',
        'no',
        '_div',
        'size_width',
        'size_height',
        'margin_left',
        'margin_top',
        'background_color',
        'background_color_default',
        'border_prop',
        'font_size',
        'line_height',
        'type_kavling',
        'jalan',
        'status',
        'marketing',
        'kode_va',
        'keterangan',
        'created_by',
        'created_at',
        
    ];
}
