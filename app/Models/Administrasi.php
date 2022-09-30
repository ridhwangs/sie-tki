<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;
    protected $table = '_administrasi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'coa',
        'kd_transaksi',
        'tanggal',
        'keterangan',
        'kas_masuk',
        'kas_keluar',
        'jenis',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function with_coa()
    {
        return $this->belongsTo('App\Models\Coa','coa','coa');
    }
}
