<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\{Piutang, Pelanggan};
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PiutangController extends Controller
{
    public function index()
    {
        return view('Page.Piutang.index');
    }

    public function read()
    {
        $data = Piutang::all();
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
            'nota' => 'required|file',
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data Tidak Lengkap');
        }

        try {
            $fileName = Carbon::today()->toDateString().Str::random(6).'.'.$request->nota->getClientOriginalExtension();
            $request->file('nota')->storeAs(
                'public', $fileName
            );
            
            Piutang::create([
                'pelanggan_id' => $request->pelanggan_id,
                'setoran' => $request->setoran > 0 ? $request->setoran : 0,
                'hutang' => $request->hutang > 0 ? $request->hutang : 0,
                'nota' => $fileName,
            ]);
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
        ]);
 
        if ($validator->fails()) {
            return "validasi error";
        }

        try {
            $piutang = Piutang::where('id', $id)->first();
            $fileName = "";
            if ($request->file('nota')){
                Storage::delete('nota_hutang/'.$piutang->nota);
                $fileName = Carbon::today()->toDateString().Str::random(6).'.'.$request->nota->getClientOriginalExtension();
                $request->file('nota')->storeAs(
                    'nota_hutang', $fileName
                );
            }

            $piutang->update([
                'setoran' => $request->setoran,
                'hutang' => $request->hutang,
                'nota' => $request->file('nota') ? $fileName : $piutang->nota
            ]);

            return "ok";
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function destroy($id)
    {
        $data = Piutang::findOrFail($id);
        $data->delete();
    }
}
