<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Piutang, Barang};

class LaporanController extends Controller
{
    public function index()
    {
        return view('Page.Laporan.index');
    }

    public function readpiutang()
    {
        $data = Piutang::with('pelanggan')->distinct()->get(['pelanggan_id']);
        return view('Page.Laporan.readpiutang')->with([
            'data' => $data
        ]);
    }

    public function detailpiutang($id)
    {
        $data = Piutang::where('pelanggan_id', $id)->with('pelanggan')->get();
        $total_setoran = 0;
        $total_hutang = 0;
        foreach($data as $item){
            $total_setoran += $item->setoran;
            $total_hutang += $item->hutang;
        }
        return view('Page.Laporan.detailpiutang')->with([
            'data' => $data,
            'total_setoran' => $total_setoran,
            'total_hutang' => $total_hutang
        ]);
    }

    public function readbarangmasuk()
    {
        $data = Barang::where('status', 'Barang Masuk')->get();
        return view('Page.Laporan.readbarangmasuk')->with([
            'data' => $data
        ]);
    }

    public function readbarangkeluar()
    {
        $data = Barang::where('status', 'Barang Keluar')->get();
        return view('Page.Laporan.readbarangkeluar')->with([
            'data' => $data
        ]);
    }
}
