<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cluster;
use App\Models\Attribute;
use App\Models\Details;

class MainController extends Controller
{
    public function index($themes)
    {
        $data = [
            'main' => Cluster::get(),
            'attribute' => Attribute::where('status', '0')->limit(9)->get(),
            'themes' => $themes
        ];
        return view('themes.'.$themes.'._main.index', $data);
    }

    public function landing()
    {
        return view('landing');
    }

    public function view(Request $request, $themes, $name)
    {
        $cluster = Cluster::where('name', $name)->first();

        if(empty($request->zoom)){
            $zoom = 5;
        }else{
            $zoom = $request->zoom;
        }
        $data = [
            'main' => $cluster,
            'zoom_level' => $zoom,
            'attribute' => Attribute::where('id_main', $cluster->id)->get(),
            'themes' => $themes
        ];
        return view('themes.'.$themes.'._main.view', $data);
    }

    public function details($themes, $id)
    {
        $attribute = Attribute::where('id', $id)->first();
        $data = [
            'main' => Cluster::where('id', $attribute->id_main)->first(),
            'attribute' => $attribute,
            'details' => Details::where(['id_cluster' => $attribute->id_main, 'type_kavling' => $attribute->type_kavling])->get(),
            'themes' => $themes
        ];
        return view('themes.'.$themes.'._main.details', $data);
    }

}
