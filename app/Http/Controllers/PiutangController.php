<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\{Piutang, Pelanggan};
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use PDF;

class PiutangController extends Controller
{
    public function index()
    {
        return view('Page.Piutang.index');
    }

    public function read()
    {
        $data = [];
        if(auth()->user()->role === 'administrasi' || auth()->user()->role === 'pemiliktoko' || auth()->user()->role === 'pelayantoko'){
            $data = Piutang::all();
        }
        else if(auth()->user()->role === 'pelanggan'){
            $pelanggan = Pelanggan::where('user_id', auth()->user()->id)->first();
            $data = Piutang::where('pelanggan_id', $pelanggan->id)->get();
        }
        return view('Page.Piutang.read')->with([
            'data' => $data
        ]);
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        return view('Page.Piutang.create')->with([
            'pelanggan' => $pelanggan
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required|integer',
            'setoran' => 'nullable|integer',
            'hutang' => 'nullable|integer',
            'keterangan' => 'required|string'
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data Tidak Lengkap');
        }

        try {
            $fileName = Carbon::today()->toDateString().Str::random(6).'.pdf';
            
            $piutang = Piutang::create([
                'pelanggan_id' => $request->pelanggan_id,
                'setoran' => $request->setoran > 0 ? $request->setoran : 0,
                'hutang' => $request->hutang > 0 ? $request->hutang : 0,
                'nota' => $fileName,
                'keterangan' => $request->keterangan
            ]);
            $pdf = $this->createPDF($piutang->id);
            $content = $pdf->download()->getOriginalContent();
            $store = Storage::put('public/'.$fileName,$content);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function edit($id){
        $data = Piutang::where('id', $id)->with('pelanggan')->first();
        return view('Page.Piutang.edit')->with([
            'data' => $data,
            'pelanggan' => Pelanggan::all()
        ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required|integer',
            'setoran' => 'nullable|integer',
            'hutang' => 'nullable|integer',
            'nota' => 'nullable',
            'keterangan' => 'required|string'
        ]);
 
        if ($validator->fails()) {
            return "validasi error";
        }

        try {
            $piutang = Piutang::where('id', $id)->first();

            $fileName = Carbon::today()->toDateString().Str::random(6).'.pdf';
            Storage::delete('public/'.$piutang->nota);

            $piutang->update([
                'setoran' => $request->setoran,
                'hutang' => $request->hutang,
                'nota' => $fileName,
                'keterangan' => $request->keterangan
            ]);
            
            $pdf = $this->createPDF($piutang->id);
            $content = $pdf->download()->getOriginalContent();
            Storage::put('public/'.$fileName,$content);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function destroy($id)
    {
        $data = Piutang::findOrFail($id);
        Storage::delete('public/'.$data->nota);
        $data->delete();
    }

    public function createPDF($piutang_id){
        $piutang = Piutang::where('id', $piutang_id)->with('pelanggan')->first();
        $pdf = PDF::loadview('PDF.nota_piutang', [
            'piutang' => $piutang
        ]);
        return $pdf;
    }
}
