<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Main;
use App\Models\Attribute;

class MainController extends Controller
{
    public function index()
    {
        $data = [
            'main' => Main::get(),
        ];
        return view('index', $data);
    }

    public function view($id)
    {
        $data = [
            'main' => Main::where('id', $id)->first(),
            'attribute' => Attribute::where('id_main', $id)->get(),
        ];
        return view('_attribute.index', $data);
    }

    public function details($id)
    {
        $response = Attribute::where('id', $id)->first();
        return response()->json($response, 200);
    }

    public function update(Request $request)
    {
        if($request->status == 1){
            $background_color = '#e74c3c';
        }elseif($request->status == 2){
            $background_color = '#f1c40f';
        }else{
            $background_color = '#0fabb8';
        }
        $data = [
            'status' => $request->status,
            'marketing' => $request->marketing,
            'keterangan' => $request->keterangan,
            'background_color' => $background_color,
        ];
        Attribute::where('id', $request->id)->update($data);
        return redirect()->back()->with('message', 'Berhasil di simpan!');
    }
}
