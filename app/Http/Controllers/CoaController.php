<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Coa;

class CoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'coa' => Coa::all(),
        ];
        return view('_administrasi.coa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('_administrasi.coa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'coa' => 'required|unique:_coa',
            'keterangan' => 'required|max:255',
            'alokasi' => 'required|max:64',
            'transaksi' => 'required'
        ]);
        $data = [
            'coa' => $request->coa,
            'keterangan' => $request->keterangan,
            'alokasi' => $request->alokasi,
            'transaksi' => $request->transaksi,
            'created_by' => Auth::user()->email,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        Coa::insert($data);
        return redirect()->back()->with('message', $request->coa.' Berhasil di simpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'coa' => Coa::find($id),
        ];
        return view('_administrasi.coa.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'coa' => $request->coa,
            'keterangan' => $request->keterangan,
            'alokasi' => $request->alokasi,
            'transaksi' => $request->transaksi,
            'created_by' => Auth::user()->email,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        Coa::where('id',$id)->update($data);
        return redirect()->back()->with('message', $request->coa.' Berhasil di simpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
