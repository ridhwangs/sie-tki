<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\Card;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'card' => Card::join('master_cluster','master_cluster.cluster_id', 'card_table.cluster_id')->orderBy('card_table.nama_pemilik','ASC')->paginate(15),
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'nama_pemilik' => $request->nama_pemilik,
            'home_no' => $request->home_no,
            'kode_va' => $request->kode_va,
        ];
        Card::where('id', $request->id)->update($data);
        return redirect()->back()->with('message', 'Berhasil di simpan!');
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
    public function update(Request $request, $id)
    {
        //
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
                $data[] = [
                    'rfid' => $sheet->getCell('A'. $row )->getValue(),
                    'expired_date' => $sheet->getCell('B'. $row )->getValue(),
                    'cluster' => $sheet->getCell('C'. $row )->getValue(),
                    'home_no' => $sheet->getCell('D'. $row )->getValue(),
                    'nama_pemilik' => Str::replace("'", '',Str::replace('"', '', $sheet->getCell('F'. $row )->getValue())),
                ];
                $startcount++;
            }
            echo '<pre>';
            print_r($data);
            die();
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            echo 'There was a problem uploading the data!';
        }
    }
}
