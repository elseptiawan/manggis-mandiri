<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        return view('Page.Barang.index');
    }

    public function read()
    {
        $data = Barang::all();
        return view('Page.Barang.read')->with([
            'data' => $data
        ]);
    }
    public function create()
    {
        return view('Page.Barang.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string',
            'harge_beli' => 'nullable|integer',
            'harga_jual' => 'nullable|integer',
            'jumlah' => 'required|integer',
            'satuan' => 'required|string'
        ]);
 
        if ($validator->fails()) {
            return redirect()->route('dashboard')->with('error', 'Data Tidak Lengkap');
        }

        $barang = Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'status' => 'Barang Masuk',
        ]);
    }

    public function edit($id){
        $data = Barang::findOrFail($id);
        return view('Page.Barang.edit')->with([
            'data' => $data
        ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string',
            'harge_beli' => 'nullable|integer',
            'harga_jual' => 'nullable|integer',
            'jumlah' => 'required|integer',
            'satuan' => 'required|string'
        ]);
 
        if ($validator->fails()) {
            return redirect()->route('dashboard')->with('error', 'Data Tidak Lengkap');
        }

        $data = Barang::findOrFail($id);
        $data->update([
            'nama_barang' => $request->nama_barang,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan
        ]);
    }

    public function destroy($id)
    {
        $data = Barang::findOrFail($id);
        $data->delete();
    }
}
