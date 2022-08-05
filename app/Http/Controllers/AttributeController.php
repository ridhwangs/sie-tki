<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function details($id)
    {
        $response = Attribute::where('_attribute.id', $id)
                            ->join('users', 'users.email', '=', '_attribute.marketing')
                            ->select('_attribute.*',  'users.name AS nama_user')
                            ->first();
        return response()->json($response, 200);
    }
    
    public function update(Request $request)
    {
        if($request->status == 1){
            $background_color = '#e74c3c';
        }elseif($request->status == 2){
            $background_color = '#f1c40f';
        }else{
            $background_color = '#ffffff';
        }
        $data = [
            'status' => $request->status,
            'background_color' => $background_color,
        ];
        if(!empty($request->marketing)){
            $data['marketing'] = $request->marketing;
        }
        if(!empty($request->keterangan)){
            $data['keterangan'] = $request->keterangan;
        }
        if(!empty($request->kode_va)){
            $data['kode_va'] = $request->kode_va;
        }
        Attribute::where('id', $request->id)->update($data);
        return redirect()->back()->with('message', 'Berhasil di simpan!');
    }
}
