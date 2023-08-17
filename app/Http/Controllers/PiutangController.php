<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Piutang;

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
        return view('Page.Piutang.create');
    }

    public function edit($id){
        $data = Piutang::findOrFail($id);
        return view('Page.Piutang.edit')->with([
            'data' => $data
        ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'setoran' => 'required|integer',
        ]);
 
        if ($validator->fails()) {
            return redirect()->route('dashboard')->with('error', 'Data Tidak Lengkap');
        }

        $data = Piutang::findOrFail($id);
        $data->update([
            'hutang' => $data->hutang - $request->setoran,
        ]);
    }
}
