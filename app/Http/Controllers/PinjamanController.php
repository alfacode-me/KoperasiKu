<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Pinjaman;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('pages.pinjaman');
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
      $res = $request->input('pinjaman');
      $pinjaman = new Pinjaman;
      $pinjaman->id_pinjaman      = strtoupper("pj-".hash('crc32b', $res['id_anggota'].$res['pinjaman'].Carbon::now()));
      $pinjaman->id_anggota       = $res['id_anggota'];
      $pinjaman->id_admin         = $request->session()->get('aktif')['id'];
      $pinjaman->tgl_pinjaman     = $res['tgl_pinjaman'];
      $pinjaman->pinjaman         = $res['pinjaman'];
      $pinjaman->bunga_pinjaman   = $res['bunga_pinjaman'];
      $pinjaman->jml_pinjaman     = $res['jml_pinjaman'];
      $pinjaman->jml_cicilan      = 0;
      $pinjaman->status           = "Belum Lunas";
      $pinjaman->created_at       = Carbon::now();
      if ($pinjaman->save()) {
        return Carbon::now();
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
        $pinjaman = DB::table('pinjaman')
          ->join('anggota', 'anggota.id_anggota', '=', 'pinjaman.id_anggota')
          ->join('admin', 'admin.id_admin', '=', 'pinjaman.id_admin')
          ->select('pinjaman.*', 'anggota.nama', 'admin.nama_admin')
          ->get();
        return $pinjaman;
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
      Pinjaman::where('id_pinjaman', $id)->update([
        'id_anggota'          => $res['id_anggota'],
        'id_admin'            => $res['id_admin'],
        'tgl_pinjaman'        => $res['tgl_pinjaman'],
        'pinjaman'            => $res['pinjaman'],
        'bunga_pinjaman'      => $res['bunga_pinjaman'],
        'jml_pinjaman'        => $res['jml_pinjaman'],
        'jml_cicilan'         => $res['jml_cicilan'],
        'status'              => $res['status'],
        'created_at'          => Carbon::now()
      ]);

      $ags = DB::table('pinjaman')
        ->where('pinjaman.id_pinjaman', '=', $res['id_pinjaman'])
        ->select('pinjaman.jml_pinjaman', 'pinjaman.jml_cicilan')
        ->distinct()->get();
      $cicilan = $ags[0]->jml_cicilan;
      $pinjaman = $ags[0]->jml_pinjaman;

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
    public function destroy($id)
    {
      DB::table('pinjaman')->where('id_pinjaman', '=', $id)->delete();
      return "OK";
    }
}
