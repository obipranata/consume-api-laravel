<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::query()->orderBy('nama')->get();
        return view("produk.list", compact('produk'));
    }

    public function detail($id)
    {
        $produk = Produk::query()->where("id", $id)->first();
        return view("produk.detail", compact('produk'));
    }

    public function store()
    {
        $produk = Produk::all();
        return view("produk.store", compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $data['nama'] = $request->nama;
        $data['harga'] = $request->harga;
        $data['deskripsi'] = $request->deskripsi;
        $data['ukuran'] = $request->ukuran;
        if ($request->hasFile('gambar')) {
            $produk = Produk::query()->where("id", $id)->first();
            Storage::disk('public')->delete($produk->file);
            $data['file'] = $request->file('gambar')->store('produk', 'public');
        }
        Produk::where('id', $id)->update($data);
        return redirect()->back()->with(['success' => 'Data berhasil di update!']);
        ;
    }

    public function create(Request $request)
    {
        $payload = [
            'nama' => $request->input("nama"),
            'harga' => $request->input("harga"),
            'deskripsi' => $request->input("deskripsi"),
            'ukuran' => $request->input("ukuran"),
            'file' => $request->file('gambar')->store('produk', 'public'),
        ];
        Produk::query()->create($payload);
        return redirect('/produk/list')->with(['success' => 'Data berhasil di tambahkan!']);
    }

    public function destroy($id)
    {
        $produk = Produk::query()->where("id", $id)->first();
        $produk->delete();
        Storage::disk('public')->delete($produk->file);
        return redirect()->back()->with(['success' => 'Data berhasil di hapus!']);
        ;
    }
}
