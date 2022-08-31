<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cluster;
use App\Models\Attribute;
use App\Models\Type;
use Session;

class ClusterController extends Controller
{
    
   

    public function update(Request $request)
    {
        $data = [
            'name' => $request->name,
            // 'information' => $request->information,
        ];
        Cluster::where('id', $request->id)->update($data);
        return redirect()->back()->with('message', 'Berhasil di simpan!');
    }

    public function type_update(Request $request)
    {
        $id = $request->id;
        $index = 0;
        $data = array();
        foreach ($id as $key => $val) {
          
            $where = [
                'id' => $id[$index],
            ];
            $data = [
                'luas_tanah' => $request->luas_tanah[$key],
                'luas_bangunan' => $request->luas_bangunan[$key],
            ];
            Type::where($where)->update($data);
            $index++;  
        }
        Session::flash('tab','type_kav-tab');
        return redirect()->back()->with('message', 'Berhasil di simpan!');
    }
}
