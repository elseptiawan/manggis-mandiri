<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\{Penjualan, Barang, Pelanggan, Piutang};

class PenjualanController extends Controller
{
    public function index()
    {
        return view('Page.Penjualan.index');
    }

    public function read()
    {
        $data = Penjualan::with('pelanggan', 'barang')->get();
        return view('Page.Penjualan.read')->with([
            'data' => $data
        ]);
    }

    public function create()
    {
        $data = Pelanggan::all();
        return view('Page.Penjualan.create')->with([
            'data' => $data
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required|integer',
            'nama_barang' => 'required|string',
            'harga_jual' => 'required|integer',
            'jumlah' => 'required|integer',
            'satuan' => 'required|string',
            'setoran' => 'required|integer'
        ]);
 
        if ($validator->fails()) {
            return response()->json(["message" => "Validasi Error"], 400);;
        }

        DB::beginTransaction();
        try {
           $barang = Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga_jual' => $request->harga_jual,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'status' => 'Barang Keluar'
           ]);

           $penjualan = Penjualan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'barang_id' => $barang->id,
            'nota' => Carbon::today()->toDateString().Str::random(6),
            'tanggal' => Carbon::today(),
            'jam' => Carbon::now()->toTimeString(),
            'setoran' => $request->setoran,
            'piutang' => ($request->harga_jual * $request->jumlah) - $request->setoran
           ]);

            $piutang = Piutang::firstOrCreate([
                'pelanggan_id' => $request->pelanggan_id,
            ], [
                'pelanggan_id' => $request->pelanggan_id,
                'hutang' => 0
            ]);

            $piutang->hutang += $penjualan->piutang;
            $piutang->save();
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
