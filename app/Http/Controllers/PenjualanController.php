<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\{Penjualan, Barang, Pelanggan, Piutang, StokBarang};
use PDF;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('Page.Penjualan.index')->with([
            'barang' => StokBarang::where('stok', '>', 0)->get()
        ]);
    }

    public function read()
    {
        $data = Penjualan::orderBy('tanggal', 'ASC')->with('pelanggan')->get();

        foreach($data as $item){
            $split_id_barang = explode(';', $item->barang_keluar_id);
            $each_barang = [];
            foreach($split_id_barang as $id_barang){
                $barang = Barang::where('id', $id_barang)->first();
                array_push($each_barang, $barang);
            }
            $item->barang = $each_barang;
            foreach($item->barang as $barang){
                $stok = StokBarang::where('id', $barang->id_barang)->first();
                $barang->stok_barang = $stok;
            }
        }

        return view('Page.Penjualan.read')->with([
            'data' => $data
        ]);
    }

    public function create()
    {
        $data = Pelanggan::all();
        $barang = StokBarang::where('stok', '>', 0)->get();
        return view('Page.Penjualan.create')->with([
            'data' => $data,
            'barang' => $barang
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required',
            'id_barang' => 'required',
            'harga_jual' => 'required',
            'jumlah' => 'required',
            'setoran' => 'required',
            'tanggal' => 'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json(["message" => "Validasi Error"], 400);;
        }

        DB::beginTransaction();
        try {
            $split_id_barang = explode(',', $request->id_barang);
            $split_harga_jual = explode(',', $request->harga_jual);
            $split_jumlah = explode(',', $request->jumlah);
            $split_satuan = explode(',', $request->satuan);
            $id_barang_inserted = [];
            $harga_total = 0;
            for($i=0;$i<count($split_id_barang);$i++){
                $barang = Barang::create([
                    'id_barang' => $split_id_barang[$i],
                    'harga_jual' => $split_harga_jual[$i],
                    'jumlah' => $split_jumlah[$i],
                    'status' => 'Barang Keluar',
                    'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tanggal),
                ]);
                $stok = StokBarang::where('id', $barang->id_barang)->first();
                $stok->update([
                    'stok' => $stok->stok - $barang->jumlah
                ]);
                array_push($id_barang_inserted, $barang->id);
                $harga_total += ($split_harga_jual[$i] * $split_jumlah[$i]);
            }

            $fileName = Carbon::today()->toDateString().Str::random(6).'.pdf';

            $penjualan = Penjualan::create([
                'pelanggan_id' => $request->pelanggan_id,
                'barang_keluar_id' => implode(';', $id_barang_inserted),
                'nota' => $fileName,
                'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tanggal),
                'setoran' => $request->setoran,
                'piutang' => $harga_total
            ]);

            if (($harga_total - $request->setoran) !== 0){
                    Piutang::create([
                        'pelanggan_id' => $request->pelanggan_id,
                        'setoran' => $request->setoran,
                        'hutang' => $harga_total,
                        'nota' => $penjualan->nota,
                        'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tanggal),
                        'keterangan' => 'Transaksi Penjualan'
                    ]);
            }
            $pdf = $this->createPDF($penjualan->id);
            $content = $pdf->download()->getOriginalContent();
            Storage::put('public/'.$fileName,$content);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function edit($id){
        $penjualan = Penjualan::where('id', $id)->first();
        $pelanggan = Pelanggan::all();
        $each_barang = [];
        $split_id_barang = explode(';', $penjualan->barang_keluar_id);
        foreach($split_id_barang as $id_barang){
            $barang = Barang::where('id', $id_barang)->first();
           array_push($each_barang, $barang); 
        }
        $penjualan->barang = $each_barang;
        foreach($penjualan->barang as $barang){
            $stok = StokBarang::where('id', $barang->id_barang)->first();
            $barang->stok_barang = $stok;
        }
        return view('Page.Penjualan.edit')->with([
            'data' => $pelanggan,
            'penjualan' => $penjualan,
            'stok_barang' => StokBarang::all()
        ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required',
            'id_barang' => 'required',
            'harga_jual' => 'required',
            'jumlah' => 'required',
            'setoran' => 'required',
            'tanggal' => 'required',
            'nota' => 'nullable'
        ]);
 
        if ($validator->fails()) {
            return response()->json(["message" => "Validasi Error"], 400);;
        }

        DB::beginTransaction();
        try {
            $penjualan = Penjualan::where('id', $id)->first();
            $piutang = Piutang::where('nota', $penjualan->nota)->first();
            $split_id_barang = explode(';', $penjualan->barang_keluar_id);
            $split_id_stok_barang = explode(',', $request->id_barang);
            $split_harga_jual = explode(',', $request->harga_jual);
            $split_jumlah = explode(',', $request->jumlah);
            $split_satuan = explode(',', $request->satuan);
            $harga_total = 0;
            for($i=0;$i<count($split_id_barang);$i++){
                $barang = Barang::where('id', $split_id_barang[$i])->first();
                $stok = StokBarang::where('id', $barang->id_barang)->first();
                $stok->update([
                    'stok' => $stok->stok + $barang->jumlah
                ]);
                $barang->update([
                    'id_barang' => $split_id_stok_barang[$i],
                    'harga_jual' => $split_harga_jual[$i],
                    'jumlah' => $split_jumlah[$i],
                    'satuan' => $split_satuan[$i],
                    'status' => 'Barang Keluar',
                    'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tanggal),
                ]);
                $new_stok = StokBarang::where('id', $barang->id_barang)->first();
                $new_stok->update([
                    'stok' => $new_stok->stok - $split_jumlah[$i]
                ]);
                $harga_total += ($split_harga_jual[$i] * $split_jumlah[$i]);
            }

            $fileName = Carbon::today()->toDateString().Str::random(6).'.pdf';
            Storage::delete('public/'.$penjualan->nota);
            $pdf = $this->createPDF($penjualan->id);
            $content = $pdf->download()->getOriginalContent();
            Storage::put('public/'.$fileName,$content);

            $penjualan->update([
                'pelanggan_id' => $request->pelanggan_id,
                'nota' => $fileName,
                'setoran' => $request->setoran,
                'piutang' => $harga_total,
                'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tanggal),
            ]);

            $piutang->update([
                'setoran' => $request->setoran,
                'hutang' => $harga_total,
                'nota' => $penjualan->nota,
                'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tanggal)
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $penjualan = Penjualan::findOrFail($id);
            $split_barang_keluar_id = explode(';', $penjualan->barang_keluar_id);
            foreach($split_barang_keluar_id as $barang_keluar_id){
                $barang_keluar = Barang::where('id', $barang_keluar_id)->first();
                $stok_barang = StokBarang::where('id', $barang_keluar->id_barang)->first();
                $stok_barang->update([
                    'stok' => $stok_barang->stok + $barang_keluar->jumlah
                ]);
                $barang_keluar->delete();
            }
            $piutang = Piutang::where('nota', $penjualan->nota)->first();
            if ($piutang){
                $piutang->delete();
            }
            $penjualan->delete();
            DB::commit();
            Storage::delete('public/'.$penjualan->nota);
        } catch (\Throwable $th) {
            DB::rollback();
            return "error transaction";
        }
    }

    public function createPDF($penjualan_id){
        $penjualan = Penjualan::where('id', $penjualan_id)->with('pelanggan')->first();
        $split_id_barang = explode(';', $penjualan->barang_keluar_id);
        $each_barang = [];
        $harga_total = 0;
        foreach($split_id_barang as $id_barang){
            $barang = Barang::where('id', $id_barang)->first();
            array_push($each_barang, $barang);
            $harga_total += ($barang->harga_jual * $barang->jumlah);
        }
        $penjualan->barang = $each_barang;
        foreach($penjualan->barang as $barang){
            $stok = StokBarang::where('id', $barang->id_barang)->first();
            $barang->stok_barang = $stok;
        }
        $pdf = PDF::loadview('PDF.nota_penjualan', [
            'penjualan' => $penjualan,
            'harga_total' => $harga_total
        ]);
        return $pdf;
    }
}
