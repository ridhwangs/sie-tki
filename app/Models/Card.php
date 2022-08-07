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
}
