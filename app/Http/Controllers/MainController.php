<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cluster;
use App\Models\Attribute;

class MainController extends Controller
{
    public function index()
    {
        $data = [
            'main' => Cluster::get(),
        ];
        return view('_main.index', $data);
    }


    public function view($name)
    {
        $cluster = Cluster::where('name', $name)->first();

        $data = [
            'main' => $cluster,
            'attribute' => Attribute::where('id_main', $cluster->id)->get(),
        ];
        return view('_main.view', $data);
    }

}
