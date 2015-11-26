<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use Hash;
use App\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MasukController extends Controller
{
    public function cek_akun(Request $req)
    {
      $username = $req->input('username');
      $password = $req->input('password');
      if (Admin::where('username', $username)->count() != 0) {
        $admin = Admin::where('username', $username)->get();
        if ($username === $admin[0]->username) {
          if (Hash::check($password, $admin[0]->password)) {
            $aktif = [
              'id'       => $admin[0]->id_admin,
              'username' => $admin[0]->username,
              'nama'     => $admin[0]->nama_admin
            ];
            if ($req->session()->has('aktif')) {
              return "OK";
            }
            else {
              $req->session()->put('aktif', $aktif);
              return "OK";
            }
          }
          else {
            return "Password Salah";
          }
        } else {
          return "Username Salah";
        }
      } else {
        return "Username Salah";
      }
    }
    public function keluar(Request $req)
    {
      $req->session()->flush();
      return redirect('/masuk');
    }
}
