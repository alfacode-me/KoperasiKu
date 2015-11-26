<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Anggota;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('pages.anggota');
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
      $res = $request->input('anggota');
      $anggota = new Anggota;
      $anggota->id_anggota    = strtoupper("ak-".hash('crc32b', $res['nama'].$res['tglg'].$res['tgll']));
      $anggota->nama          = $res['nama'];
      $anggota->tgl_gabung    = $res['tglg'];
      $anggota->telp          = $res['nt'];
      $anggota->jenis_kelamin = $res['jk'];
      $anggota->kota          = $res['kota'];
      $anggota->tgl_lahir     = $res['tgll'];
      $anggota->pekerjaan     = $res['p'];
      $anggota->alamat        = $res['al'];
      $anggota->created_at    = Carbon::now();
      if ($anggota->save()) {
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
        return Anggota::all();
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
      Anggota::where('id_anggota', $id)->update([
        'nama'          => $res['nama'],
        'tgl_gabung'    => $res['tgl_gabung'],
        'telp'          => $res['telp'],
        'jenis_kelamin' => $res['jenis_kelamin'],
        'kota'          => $res['kota'],
        'tgl_lahir'     => $res['tgl_lahir'],
        'pekerjaan'     => $res['pekerjaan'],
        'alamat'        => $res['alamat'],
        'created_at'    => Carbon::now()
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
      Anggota::where('id_anggota', $id)->delete();
      return "OK";
    }
}
