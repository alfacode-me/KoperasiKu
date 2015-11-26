<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Simpanan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('pages.simpanan');
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
      $res = $request->input('simpanan');
      $simpanan = new Simpanan;
      $simpanan->id_simpanan      = strtoupper("sm-".hash('crc32b', $res['id_anggota'].$res['id_jns_simpanan'].$res['simpanan'].Carbon::now()));
      $simpanan->id_anggota       = $res['id_anggota'];
      $simpanan->id_admin         = $request->session()->get('aktif')['id'];
      $simpanan->id_jns_simpanan  = $res['id_jns_simpanan'];
      $simpanan->tgl_simpanan     = $res['tgl_simpanan'];
      $simpanan->simpanan         = $res['simpanan'];
      $simpanan->bunga            = $res['bunga'];
      $simpanan->jml_simpanan     = $res['jml_simpanan'];
      $simpanan->created_at       = Carbon::now();
      if ($simpanan->save()) {
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
        $simpanan = DB::table('simpanan')
          ->join('anggota', 'anggota.id_anggota', '=', 'simpanan.id_anggota')
          ->join('admin', 'admin.id_admin', '=', 'simpanan.id_admin')
          ->join('master_simpanan', 'master_simpanan.id_jns_simpanan', '=', 'simpanan.id_jns_simpanan')
          ->select('simpanan.*', 'anggota.nama', 'admin.nama_admin', 'master_simpanan.jns_simpanan')
          ->get();
        return $simpanan;
      }
      if ($id == "anggota") {
        $simpanan = DB::table('anggota')
              ->select('anggota.id_anggota','anggota.nama')
              ->get();
        return $simpanan;
      }
      if ($id == "admin") {
        $simpanan = DB::table('admin')
              ->select('admin.id_admin','admin.nama_admin')
              ->get();
        return $simpanan;
      }
      if ($id == "master_simpanan") {
        $simpanan = DB::table('master_simpanan')
              ->select('master_simpanan.*')
              ->get();
        return $simpanan;
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
      Simpanan::where('id_simpanan', $id)->update([
        'id_anggota'          => $res['id_anggota'],
        'id_admin'            => $res['id_admin'],
        'id_jns_simpanan'     => $res['id_jns_simpanan'],
        'tgl_simpanan'        => $res['tgl_simpanan'],
        'simpanan'            => $res['simpanan'],
        'bunga'               => $res['bunga'],
        'jml_simpanan'        => $res['jml_simpanan'],
        'created_at'          => Carbon::now()
      ]);
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
      DB::table('simpanan')->where('id_simpanan', '=', $id)->delete();
      return "OK";
    }
}
