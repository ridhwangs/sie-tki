<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    use HasFactory;
    protected $table = '_coa';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
}
