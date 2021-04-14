<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang', compact('barang'));
    }

    public function add()
    {
        return view('add_barang');
    }

    public function insert(Request $res)
    {
        Barang::create([
            "nama_barang" => $res->nama_barang,
            "satuan" => $res->satuan,
            "jumlah" => $res->jumlah,
            "ket" =>  $res->ket,
            "lokasi" =>  $res->lokasi
        ]);
        return redirect('barang')->with('success', "Berhasil menambahkan data!");
    }
    public function delete($id)
    {
        $barang = Barang::destroy($id);

        return redirect('barang')->with('success', "Berhasil menghapus data!");
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);

        return view('edit_barang', compact('barang'));
    }

    public function update(Request $req)
    {
        $barang = Barang::findOrFail($req->id);

        $barang->nama_barang = $req->nama_barang;
        $barang->satuan = $req->satuan;
        $barang->jumlah = $req->jumlah;
        $barang->ket = $req->ket;
        $barang->lokasi = $req->lokasi;
        $barang->save();

        return redirect('barang')->with('success', "Data berhasil diubah!");
    }

    public function print()
    {

        $barang = Barang::all();
        return view('barang_print', compact('barang'));
    }
}
