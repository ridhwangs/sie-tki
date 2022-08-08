<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_cluster extends Model
{
    use HasFactory;
    protected $connection = 'db_hunian';
    protected $table = "master_cluster";
    protected $primaryKey = "cluster_id";
    protected $fillable = ['nama_cluster'];
}
