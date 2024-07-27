<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\wali;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        return view('operator.index');
    }

    public function wali()
    {
        $walikelas = wali::with('user', 'kelas', 'jurusan')->get();

        return view('operator.wali', compact('walikelas'));
    }

    public function tambahwali(Request $request)
    {
        if(strlen($request->password) > 0)
        {
            $user= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'role' => 'wali'
            ]);

            wali::insert([
                'nuptk' => $request->nuptk,
                'id' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nip' => $request->nip,
            ]);
        }
        else
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'wali'
            ]);

            wali::insert([
                'nuptk' => $request->nuptk,
                'id' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nip' => $request->nip,
            ]);
        }

        return redirect()->back();
    }

    public function editwali(Request $r)
    {
        //DB wali
        DB::table('walis')->where('id', $r->id)->update([
            'nuptk' => $r->nuptk,
            'jenis_kelamin' => $r->jenis_kelamin,
            'nip' => $r->nip,
        ]);


        //DB user
        DB::table('users')->where('id', $r->id)->update([
            'name' => $r->name,
            'email' => $r->email,
            'password' => password_hash($r->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->back();
    }

    public function hapuswali($id)
    {
        $w = wali::find($id);
        $w->delete();

        $w = user::find($id);
        $w->delete();

        return redirect()->back();
    }

    public function kelas()
    {
        return view('operator.kelas');
    }

    public function koordinat()
    {
        return view('operator.koordinat');
    }

    public function absen()
    {
        return view('operator.absen');
    }

    public function jurusan()
    {


        return view('operator.jurusan');
    }
}
