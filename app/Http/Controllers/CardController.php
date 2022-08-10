<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\Card;
use App\Models\Master_cluster;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $addWhere = '->paginate(15)';
        if(!empty($request->search)){
            $query = Card::join('master_cluster','master_cluster.cluster_id', 'card_table.cluster_id')->orderBy('card_table.nama_pemilik','ASC')->where('card_table.rfid', 'like', '%' . $request->search . '%')->orWhere('card_table.nama_pemilik', 'like', '%' . $request->search . '%');
        }else{
            $query = Card::join('master_cluster','master_cluster.cluster_id', 'card_table.cluster_id')->orderBy('card_table.nama_pemilik','ASC');
        }
        $data = [
            'card' => $query->paginate(15),
            'master_cluster' => Master_cluster::get(),
        ];
        return view('_penghuni.card.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'master_cluster' => Master_cluster::get(),
        ];
        return view('_penghuni.card.create', $data);
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
            'rfid' => 'required|unique:db_hunian.card_table|max:16',
        ]);
        $data = [
            'cluster_id' => $request->cluster_id,
            'rfid' => $request->rfid,
            'nama_pemilik' => $request->nama_pemilik,
            'kode_va' => $request->kode_va,
            'created_by' => Auth::user()->email,
        ];
        Card::create($data);
        return redirect()->back()->with('message', $data['rfid'].' Berhasil di simpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Card::where('id', $id)->first();
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = [
            'cluster_id' => $request->cluster_id,
            'nama_pemilik' => $request->nama_pemilik,
            'home_no' => $request->home_no,
            'kode_va' => $request->kode_va,
            'created_by' => Auth::user()->email,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        Card::where('id', $request->id)->update($data);
        return redirect()->back()->with('message', $data['nama_pemilik'].' Berhasil di simpan!');
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

    public function upload(Request $request)
    {
      
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:csv,txt'
        ]);
        $the_file = $request->file('uploaded_file');
        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'F', $column_limit );
            $startcount = 2;
            $data = array();
            foreach ( $row_range as $row ) {
                $master_cluster = Master_cluster::where('nama_cluster', $sheet->getCell('C'. $row )->getValue())->first();
                $data = [
                    'rfid' => $sheet->getCell('A'. $row )->getValue(),
                    'expired_date' => $sheet->getCell('B'. $row )->getValue(),
                    'cluster_id' => $master_cluster->cluster_id,
                    'home_no' => $sheet->getCell('D'. $row )->getValue(),
                    'nama_pemilik' => Str::replace("'", '',Str::replace('"', '', $sheet->getCell('F'. $row )->getValue())),
                    'created_by' => 'Import',
                ];
                $card_table = Card::where('rfid', $data['rfid'])->count();
                if($card_table > 0){
                    Card::where('rfid', $data['rfid'])->update($data);
                }else{
                    Card::create($data);
                }
                $startcount++;
            }
            return redirect()->back()->with('message', 'Berhasil di simpan!');
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            echo 'There was a problem uploading the data!';
        }
    }
}
