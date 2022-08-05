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

    

    public function update(Request $request)
    {
        $data = [
            'name' => $request->name,
            'information' => $request->information,
        ];
        Main::where('id', $request->id)->update($data);
        return redirect()->back()->with('message', 'Berhasil di simpan!');
    }
}
