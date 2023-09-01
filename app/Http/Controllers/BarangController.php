<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\{Barang, StokBarang};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangController extends Controller
{
    public function index()
    {
        return view('Page.Barang.index');
    }

    public function readbarangmasuk()
    {
        $data = Barang::where('status', 'Barang Masuk')->with('stok_barang')->get();
        return view('Page.Barang.readbarangmasuk')->with([
            'data' => $data
        ]);
    }

    public function readbarangkeluar()
    {
        $data = Barang::where('status', 'Barang Keluar')->with('stok_barang')->get();
        return view('Page.Barang.readbarangkeluar')->with([
            'data' => $data
        ]);
    }

    public function readstokbarang()
    {
        $data = StokBarang::all();
        return view('Page.Barang.readstokbarang')->with([
            'data' => $data
        ]);
    }
    public function create()
    {
        $stok_barang = StokBarang::all();
        return view('Page.Barang.create')->with([
            'barang' => $stok_barang
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_barang' => 'required',
            'harga_beli' => 'nullable|integer',
            'harga_jual' => 'nullable|integer',
            'jumlah' => 'required|integer',
            'satuan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard')->with('error', 'Data Tidak Lengkap');
        }

        DB::beginTransaction();
        try {
            $stok_barang = StokBarang::where('id', $request->id_barang)->first();

            if ($request->id_barang == 0) {
                $stok_barang = StokBarang::create([
                    'nama_barang' => $request->nama_barang,
                    'stok' => 0,
                    'satuan' => $request->satuan
                ]);
            }

            $stok_barang->update([
                'stok' => $stok_barang->stok + $request->jumlah
            ]);

            $barang = Barang::create([
                'id_barang' => $stok_barang->id,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'jumlah' => $request->jumlah,
                'status' => 'Barang Masuk',
                'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tanggal),
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function editbarangmasuk($id)
    {
        $data = Barang::where('id', $id)->with('stok_barang')->first();
        return view('Page.Barang.editbarangmasuk')->with([
            'data' => $data
        ]);
    }

    public function updateBarangMasuk(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string',
            'harge_beli' => 'nullable|integer',
            'jumlah' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard')->with('error', 'Data Tidak Lengkap');
        }

        DB::beginTransaction();
        try {
            $data = Barang::findOrFail($id);
            $stok_barang = StokBarang::where('id', $data->id_barang)->first();
            $stok_barang->update([
                'stok' => $stok_barang->stok - $data->jumlah + $request->jumlah
            ]);
            $data->update([
                'nama_barang' => $request->nama_barang,
                'harga_beli' => $request->harga_beli,
                'jumlah' => $request->jumlah
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function editstokbarang($id)
    {
        $data = StokBarang::where('id', $id)->first();
        return view('Page.Barang.editstokbarang ')->with([
            'data' => $data
        ]);
    }

    public function updateStokBarang(Request $request, $id){
        $barang = StokBarang::where('id', $id)->first();
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan
        ]);
    }

    public function destroy($id)
    {
        $data = Barang::findOrFail($id);
        $stok_barang = StokBarang::where('id', $data->id_barang)->first();
        $stok_barang->update([
            'stok' => $stok_barang->stok - $data->jumlah
        ]);
        $data->delete();
    }
}
