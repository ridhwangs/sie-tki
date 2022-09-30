<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Administrasi;
class AdministrasiController extends Controller
{
    public function masuk(Request $request)
    {
        if(!empty($request->tgl_awal)){
            $where = [
                'coa' => $request->coa,
                'jenis' => 'masuk'
            ];
            $query = Administrasi::where($where)->whereBetween('tanggal', [$request->tgl_awal, $request->tgl_akhir]);
        }else{
            $query = Administrasi::where('jenis', 'masuk');
        }
        $data = [
            'administrasi' => $query->paginate(15)->appends(request()->query()),
            'sum' => $query->sum('kas_masuk'),
            'coa' => Administrasi::with('with_coa')->groupBy('coa')->get(), 
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
            'created_by' => Auth::user()->email,
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
