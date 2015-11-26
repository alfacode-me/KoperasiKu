<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\MasterSimpanan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MasterSimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('pages.jenis_simpanan');
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
      $res = $request->input('jenis_simpanan');
      $jenis_simpanan = new MasterSimpanan;
      $jenis_simpanan->id_jns_simpanan  = strtoupper("js-".hash('crc32b', $res['jns_simpanan'].$res['bunga_simpanan']));
      $jenis_simpanan->jns_simpanan     = $res['jns_simpanan'];
      $jenis_simpanan->bunga_simpanan   = $res['bunga_simpanan'];
      $jenis_simpanan->created_at       = Carbon::now();
      if ($jenis_simpanan->save()) {
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
        return DB::table('master_simpanan')->select('master_simpanan.*')->get();
      }
      if ($bunga_simpanan = DB::table('master_simpanan')->where('id_jns_simpanan', '=', $id)->select('master_simpanan.bunga_simpanan')->get()) {
        return $bunga_simpanan;
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
      MasterSimpanan::where('id_jns_simpanan', $id)->update([
        'jns_simpanan'  => $res['jns_simpanan'],
        'bunga_simpanan'=> $res['bunga_simpanan'],
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
      MasterSimpanan::where('id_jns_simpanan', $id)->delete();
      return "OK";
    }
}
