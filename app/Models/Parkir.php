<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    use HasFactory;
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "parkir";
}
