<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Administrasi;
class AdministrasiController extends Controller
{
    public function masuk(Type $var = null)
    {
        $data = [
            'administrasi' => Administrasi::where('jenis', 'masuk')->paginate(15),
        ];
        return view('_administrasi.masuk.index', $data);
    }

    public function keluar(Type $var = null)
    {
        $data = [
            'administrasi' => Administrasi::where('jenis', 'keluar')->paginate(15),
        ];
        return view('_administrasi.keluar.index', $data);
    }

    public function create($jenis)
    {
        $data = [
            'jenis' => $jenis,
        ];
        if($jenis == 'masuk'){
            return view('_administrasi.masuk.create', $data);
        }else{
            return view('_administrasi.keluar.create', $data);
        }
    }

    public function store(Request $request)
    {
        $kd_transaksi = date('ymdHis');
        $data = [
            'jenis' => $request->jenis,
            'coa' => $request->coa,
            'kd_transaksi' => $kd_transaksi,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'created_by' => 'ridhwangs@gmail.com',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if($request->jenis == 'masuk'){
            $data['kas_masuk'] = $request->jumlah;
        }else{
            $data['kas_keluar'] = $request->jumlah;
        }
        Administrasi::create($data);
        return redirect()->back()->with('message', ' Berhasil di simpan, dengan kode voucher '. $data['kd_transaksi']);
    }
}
