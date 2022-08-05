<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Main;
use App\Models\Attribute;

class SiteplanController extends Controller
{
    public function index()
    {
        $data = [
            'main' => Main::get(),
        ];
        return view('_member.siteplan.index', $data);
    }

    public function details($name)
    {
        $main = Main::where('name', $name)->first();
        $data = [
            'attribute' => Attribute::where('id_main', $main->id)->get(),
            'cluster' => $main,
        ];
        return view('_member.siteplan.details', $data);
    }
}
