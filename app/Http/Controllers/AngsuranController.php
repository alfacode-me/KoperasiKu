<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Angsuran;
use App\Pinjaman;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AngsuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('pages.angsuran');
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
      $res = $request->input('angsuran');

      $angsuran = new Angsuran;
      $angsuran->id_angsuran      = strtoupper("as-".hash('crc32b', $res['id_pinjaman'].$res['jml_angsuran'].Carbon::now()));
      $angsuran->id_pinjaman      = $res['id_pinjaman'];
      $angsuran->id_admin         = $request->session()->get('aktif')['id'];
      $angsuran->tgl_angsuran     = $res['tgl_angsuran'];
      $angsuran->jml_angsuran     = $res['jml_angsuran'];
      $angsuran->created_at       = Carbon::now();
      if ($angsuran->save()) {
        $ags = DB::table('pinjaman')
          ->where('pinjaman.id_pinjaman', '=', $res['id_pinjaman'])
          ->select('pinjaman.jml_pinjaman', 'pinjaman.jml_cicilan')
          ->distinct()->get();
        $cicilan = $ags[0]->jml_cicilan + $res['jml_angsuran'];
        $pinjaman = $ags[0]->jml_pinjaman;
        Pinjaman::where('id_pinjaman', $res['id_pinjaman'])->update([
          'jml_cicilan'    => $cicilan,
          'created_at'     => Carbon::now()
        ]);
        if ($cicilan >= $pinjaman) {
          Pinjaman::where('id_pinjaman', $res['id_pinjaman'])->update([
            'status'      => "Lunas",
            'created_at'  => Carbon::now()
          ]);
        }
        return "OK";
      } else {
        return "FAIL";
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if ($id == "all") {
        $angsuran = DB::table('angsuran')
          ->join('pinjaman', 'pinjaman.id_pinjaman', '=', 'angsuran.id_pinjaman')
          ->join('anggota', 'anggota.id_anggota', '=', 'pinjaman.id_anggota')
          ->join('admin', 'admin.id_admin', '=', 'angsuran.id_admin')
          ->select('angsuran.*','anggota.id_anggota', 'anggota.nama', 'admin.nama_admin', 'pinjaman.id_pinjaman')
          ->get();
        return $angsuran;
      }
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
      $res = $request->input('update');

      $ag = DB::table('angsuran')
        ->where('id_angsuran', '=', $res['id_angsuran'])
        ->select('angsuran.jml_angsuran')
        ->distinct()->get();
      $ang = $ag[0]->jml_angsuran;
      Angsuran::where('id_angsuran', $id)->update([
        'id_pinjaman'     => $res['id_pinjaman'],
        'id_admin'        => $res['id_admin'],
        'tgl_angsuran'    => $res['tgl_angsuran'],
        'jml_angsuran'    => $res['jml_angsuran'],
        'created_at'      => Carbon::now()
      ]);

      $ags = DB::table('pinjaman')
        ->where('pinjaman.id_pinjaman', '=', $res['id_pinjaman'])
        ->select('pinjaman.jml_pinjaman', 'pinjaman.jml_cicilan')
        ->distinct()->get();
      $cicilan = $ags[0]->jml_cicilan - $ang + $res['jml_angsuran'];
      $pinjaman = $ags[0]->jml_pinjaman;
      Pinjaman::where('id_pinjaman', $res['id_pinjaman'])->update([
        'jml_cicilan'    => $cicilan,
        'created_at'     => Carbon::now()
      ]);
      if ($cicilan >= $pinjaman) {
        Pinjaman::where('id_pinjaman', $res['id_pinjaman'])->update([
          'status'      => "Lunas",
          'created_at'  => Carbon::now()
        ]);
      }
      if ($cicilan <= $pinjaman) {
        Pinjaman::where('id_pinjaman', $res['id_pinjaman'])->update([
          'status'      => "Belum Lunas",
          'created_at'  => Carbon::now()
        ]);
      }
      return "OK";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      $res = $request->input('delete');
      $ags = DB::table('pinjaman')
        ->where('pinjaman.id_pinjaman', '=', $res['id_pinjaman'])
        ->select('pinjaman.jml_pinjaman', 'pinjaman.jml_cicilan')
        ->distinct()->get();
      $cicilan = $ags[0]->jml_cicilan - $res['jml_angsuran'];
      $pinjaman = $ags[0]->jml_pinjaman;
      Pinjaman::where('id_pinjaman', $res['id_pinjaman'])->update([
        'jml_cicilan'    => $cicilan,
        'created_at'     => Carbon::now()
      ]);
      if ($cicilan >= $pinjaman) {
        Pinjaman::where('id_pinjaman', $res['id_pinjaman'])->update([
          'status'      => "Lunas",
          'created_at'  => Carbon::now()
        ]);
      }
      DB::table('angsuran')->where('id_angsuran', '=', $id)->delete();
      return "OK";
    }
}
