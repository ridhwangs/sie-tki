<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Administrasi;
use App\Models\Coa;
class AdministrasiController extends Controller
{
    public function masuk(Request $request)
    {
        if(empty($request->tgl_awal)){
            $tgl_awal = '1994-06-18';
        }else{
            $tgl_awal = $request->tgl_awal;
        }
        if(!empty($request->tgl_akhir)){
            $where = [
                'jenis' => 'masuk'
            ];
            if($request->coa != 'all'){
                $where['coa'] = $request->coa;
            }
            $query = Administrasi::where($where)->whereBetween('tanggal', [$tgl_awal, $request->tgl_akhir]);
            $sum_all = Administrasi::where($where)->whereBetween('tanggal', [$tgl_awal, $request->tgl_akhir]);
            $sum_group = Administrasi::select('_administrasi.coa AS coa', '_coa.keterangan AS keterangan')->selectRaw("SUM(_administrasi.kas_masuk) as kas_masuk")->join('_coa', '_coa.coa', '=','_administrasi.coa')->whereBetween('tanggal', [$tgl_awal, $request->tgl_akhir])->groupBy('coa');
        }else{
            $query = Administrasi::where('jenis', 'masuk');
            $sum_all = Administrasi::where('jenis', 'masuk');
            $sum_group = Administrasi::select('_administrasi.coa AS coa', '_coa.keterangan AS keterangan')->selectRaw("SUM(_administrasi.kas_masuk) as kas_masuk")->join('_coa', '_coa.coa', '=','_administrasi.coa')->groupBy('coa');
        }
        $data = [
            'administrasi' => $query->orderBy('tanggal','DESC')->paginate(15)->appends(request()->query()),
            'sum' => $sum_all->sum('kas_masuk'),
            'sum_group' => $sum_group->get(),
            'coa' => Administrasi::select('_administrasi.coa AS coa', '_coa.keterangan AS keterangan')->leftJoin('_coa', '_coa.coa', '=','_administrasi.coa')->groupBy('_administrasi.coa')->get(), 
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
            'coa' => Coa::orderBy('coa', 'ASC')->get(),
        ];
        if($jenis == 'masuk'){
            return view('_administrasi.masuk.create', $data);
        }else{
            return view('_administrasi.keluar.create', $data);
        }
    }

    public function edit($id)
    {
        $administrasi = Administrasi::where('id', $id)->first();
        $data = [
            'jenis' => $administrasi->jenis,
            'data' => $administrasi,
            'coa' => Coa::orderBy('coa', 'ASC')->get(),
        ];
        if($data['jenis'] == 'masuk'){
            return view('_administrasi.masuk.edit', $data);
        }else{
            return view('_administrasi.keluar.edit', $data);
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

    public function update(Request $request, $id)
    {
        $row = Administrasi::where('id', $id)->first();
        $data = [
            'coa' => $request->coa,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if($row->jenis == 'masuk'){
            $data['kas_masuk'] = $request->jumlah;
        }else{
            $data['kas_keluar'] = $request->jumlah;
        }
        Administrasi::where('id',$id)->update($data);
        return redirect()->back()->with('message', ' Data Berhasil di perbaharui');
    }

    public function delete($id)
    {   
        $data = Administrasi::where('id', $id)->first();
        Administrasi::where('id',$id)->delete();
        return redirect()->route('administrasi.'.$data->jenis)->with('message', 'Kode '.$data->kd_transaksi.' Berhasil di hapus');
    }
}
