<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $connection = 'db_hunian';
    protected $table = "card_table";
    protected $primaryKey = "id";

    protected $fillable = [
        'rfid',
        'nama_pemilik',
        'expired_date',
        'home_no',
        'cluster_id',
        'created_by',
    ];
    
}
