<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\{Karyawan, User};

class KaryawanController extends Controller
{
    public function index()
    {
        return view('Page.Karyawan.index');
    }

    public function read()
    {
        $data = Karyawan::with('user')->get();
        return view('Page.Karyawan.read')->with([
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('Page.Karyawan.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_karyawan' => 'required|string',
            'posisi' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|same:confirm_password',
            'confirm_password' => 'required|string'
        ]);
 
        if ($validator->fails()) {
            return response()->json(["message" => "Validasi Error"], 400);;
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->nama_karyawan,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => str_replace(' ', '', strtolower($request->posisi))
            ]);

            $karyawan = Karyawan::create([
                'user_id' => $user->id,
                'nama_karyawan' => $request->nama_karyawan,
                'posisi' => $request->posisi,
                'no_hp' => $request->no_hp
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function edit($id){
        $data = Karyawan::findOrFail($id);
        return view('Page.Karyawan.edit')->with([
            'data' => $data
        ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
        ]);
 
        if ($validator->fails()) {
            return response()->json(["message" => "Validasi Error"], 400);;
        }

        $data = Pelanggan::findOrFail($id);
        $data->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp
        ]);
    }

    public function destroy($id)
    {
        $data = Karyawan::findOrFail($id);
        $user = User::where('id', $data->user_id)->first();
        $data->delete();
        $user->delete();
    }
}
