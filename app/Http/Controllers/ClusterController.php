<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cluster;
use App\Models\Attribute;

class ClusterController extends Controller
{
    
   

    public function update(Request $request)
    {
        $data = [
            'name' => $request->name,
            'information' => $request->information,
        ];
        Cluster::where('id', $request->id)->update($data);
        return redirect()->back()->with('message', 'Berhasil di simpan!');
    }
}
