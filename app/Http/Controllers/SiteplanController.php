<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cluster;
use App\Models\Attribute;
use Illuminate\Support\Str;

class SiteplanController extends Controller
{
    public function index()
    {
        $data = [
            'main' => Cluster::get(),
        ];
        return view('_siteplan.index', $data);
    }

    public function show($id)
    {
        $data = [
            'attribute' => Attribute::where('id_main', $id)->get(),
            'cluster' => Cluster::where('id', $id)->first(),
        ];
        return view('_siteplan.details', $data);
    }

    public function details($id)
    {
        $response = Attribute::where('_attribute.id', $id)
                            ->leftJoin('users', 'users.email', '=', '_attribute.marketing')
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
            'marketing' => $request->marketing,
            'keterangan' => $request->keterangan,
        ];
        if(!empty($request->no)){
            $data['no'] = $request->no;
        }
        if(!empty($request->size_width)){
            $data['size_width'] = $request->size_width;
        }
        if(!empty($request->size_height)){
            $data['size_height'] = $request->size_height;
        }
        if(!empty($request->margin_left)){
            $data['margin_left'] = $request->margin_left;
        }
        if(!empty($request->margin_top)){
            $data['margin_top'] = $request->margin_top;
        }
        if(!empty($request->background_color)){
            $data['background_color'] = $request->background_color;
        }
        if(!empty($request->border_prop)){
            $data['border_prop'] = $request->border_prop;
        }
        if(!empty($request->type_kavling)){
            $data['type_kavling'] = $request->type_kavling;
        }
        
        if(!empty($request->kode_va)){
            $data['kode_va'] = $request->kode_va;
        }
        Attribute::where('id', $request->id)->update($data);
        $response  = [
            'message' => 'Data Berhasil Tersimpan',
        ];
        return response()->json($response, 200);
    }

    public function duplicate($id)
    {
        $attribute = Attribute::where('_attribute.id', $id)->first();
        $array = [];

        for ($i=0; $i < 11 ; $i++) { 
            $no = $attribute->no - $i - $i;
            $int_size_width = Str::replace('px', '', $attribute->size_width) * $i;
            $int_margin_left = Str::replace('px', '', $attribute->margin_left) + $int_size_width;
            $data = [
                'id_main' => $attribute->id_main,
                'no' => $no,
                '_div' => '_'.rand(0, 99999) + $int_margin_left,
                'size_width' => $attribute->size_width,
                'size_height' => $attribute->size_height,
                'margin_left' => $int_margin_left.'px',
                'margin_top' => $attribute->margin_top,
                'background_color' => $attribute->background_color,
                'background_color_default' => $attribute->background_color_default,
                'status' => '0',
                'jalan' => 'GARDENVILLE VI',
                'border_prop' => $attribute->border_prop,
                'font_size' => $attribute->font_size,
                'line_height' => $attribute->line_height,
                'type_kavling' => $attribute->type_kavling,
                'created_by' => 'ridhwangs@gmail.com',
                'created_at' => date('Y-m-d H:i:s'),
            ];
            // echo "<pre>";
            // print_r($data);
            // die();
            Attribute::create($data);
        }
        
    }
}
