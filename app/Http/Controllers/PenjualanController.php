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
use App\Models\{Penjualan, Barang, Pelanggan, Piutang};
use PDF;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('Page.Penjualan.index');
    }

    public function read()
    {
        $data = Penjualan::orderBy('tanggal', 'ASC')->with('pelanggan')->get();

        foreach($data as $item){
            $split_id_barang = explode(';', $item->barang_id);
            $each_barang = [];
            foreach($split_id_barang as $id_barang){
                $barang = Barang::where('id', $id_barang)->first();
                array_push($each_barang, $barang);
            }
            $item->barang = $each_barang;
        }
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
            'pelanggan_id' => 'required',
            'nama_barang' => 'required',
            'harga_jual' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
            'setoran' => 'required',
            'tanggal' => 'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json(["message" => "Validasi Error"], 400);;
        }

        DB::beginTransaction();
        try {
            $split_nama_barang = explode(',', $request->nama_barang);
            $split_harga_jual = explode(',', $request->harga_jual);
            $split_jumlah = explode(',', $request->jumlah);
            $split_satuan = explode(',', $request->satuan);
            $id_barang_inserted = [];
            $harga_total = 0;
            for($i=0;$i<count($split_nama_barang);$i++){
                $barang = Barang::create([
                    'nama_barang' => $split_nama_barang[$i],
                    'harga_jual' => $split_harga_jual[$i],
                    'jumlah' => $split_jumlah[$i],
                    'satuan' => $split_satuan[$i],
                    'status' => 'Barang Keluar'
                ]);
                array_push($id_barang_inserted, $barang->id);
                $harga_total += ($split_harga_jual[$i] * $split_jumlah[$i]);
            }

            $fileName = Carbon::today()->toDateString().Str::random(6).'.pdf';

            $penjualan = Penjualan::create([
                'pelanggan_id' => $request->pelanggan_id,
                'barang_id' => implode(';', $id_barang_inserted),
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
        $split_id_barang = explode(';', $penjualan->barang_id);
        foreach($split_id_barang as $id_barang){
            $barang = Barang::where('id', $id_barang)->first();
           array_push($each_barang, $barang); 
        }
        $penjualan->barang = $each_barang;
        return view('Page.Penjualan.edit')->with([
            'data' => $pelanggan,
            'penjualan' => $penjualan
        ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required',
            'nama_barang' => 'required',
            'harga_jual' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
            'setoran' => 'required',
            'nota' => 'nullable'
        ]);
 
        if ($validator->fails()) {
            return response()->json(["message" => "Validasi Error"], 400);;
        }

        DB::beginTransaction();
        try {
            $penjualan = Penjualan::where('id', $id)->first();
            $piutang = Piutang::where('nota', $penjualan->nota)->first();
            $split_id_barang = explode(';', $penjualan->barang_id);
            $split_nama_barang = explode(',', $request->nama_barang);
            $split_harga_jual = explode(',', $request->harga_jual);
            $split_jumlah = explode(',', $request->jumlah);
            $split_satuan = explode(',', $request->satuan);
            $harga_total = 0;
            for($i=0;$i<count($split_id_barang);$i++){
                $barang = Barang::where('id', $split_id_barang[$i])->first();
                $barang->update([
                    'nama_barang' => $split_nama_barang[$i],
                    'harga_jual' => $split_harga_jual[$i],
                    'jumlah' => $split_jumlah[$i],
                    'satuan' => $split_satuan[$i],
                    'status' => 'Barang Keluar'
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
                'piutang' => $harga_total
            ]);

            if (($harga_total - $request->setoran) == 0){
                $piutang->delete();
            }
            else{
                $piutang->update([
                    'setoran' => $harga_total < $request->setoran ? $request->setoran - $harga_total : 0,
                    'hutang' => $harga_total > $request->setoran ? $harga_total - $request->setoran : 0,
                    'nota' => $penjualan->nota
                ]);
            }
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
            $barang = Barang::where('id', $penjualan->barang_id)->first();
            $piutang = Piutang::where('nota', $penjualan->nota)->first();
            $barang->delete();
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
        $split_id_barang = explode(';', $penjualan->barang_id);
        $each_barang = [];
        $harga_total = 0;
        foreach($split_id_barang as $id_barang){
            $barang = Barang::where('id', $id_barang)->first();
            array_push($each_barang, $barang);
            $harga_total += ($barang->harga_jual * $barang->jumlah);
        }
        $penjualan->barang = $each_barang;
        $pdf = PDF::loadview('PDF.nota_penjualan', [
            'penjualan' => $penjualan,
            'harga_total' => $harga_total
        ]);
        return $pdf;
    }
}
