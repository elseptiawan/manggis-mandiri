<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\{Pelanggan, User};

class PelangganController extends Controller
{
    public function index()
    {
        return view('Page.Pelanggan.index');
    }

    public function read()
    {
        $data = Pelanggan::with('user')->get();
        return view('Page.Pelanggan.read')->with([
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('Page.Pelanggan.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required|string',
            'alamat' => 'required|string',
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
                'name' => $request->nama_pelanggan,
                'email' => $request->email,
                'password' => Hash::make($request->passsword),
                'role' => 'pelanggan'
            ]);

            $pelanggan = Pelanggan::create([
                'user_id' => $user->id,
                'nama_pelanggan' => $request->nama_pelanggan,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function edit($id){
        $data = Pelanggan::findOrFail($id);
        return view('Page.Pelanggan.edit')->with([
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
        $data = Pelanggan::findOrFail($id);
        $data->delete();
    }
}
