<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::query()->orderBy('nama')->get();
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $produk
        ]);
    }

    public function show($id)
    {
        $produk = Produk::where("id", $id)->first();
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $produk
        ]);
    }

    public function store(Request $request)
    {
        $payload = [
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'ukuran' => $request->ukuran,
            'file' => $request->file->store('produk', 'public')
        ];
        $produk = Produk::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $produk
        ]);
    }

    public function update(Request $request, $id)
    {
        $payload = $request->except(['file']);
        $produk = Produk::find($id);
        if (isset($request->file)) {
            Storage::disk('public')->delete($produk->file);
            $payload["file"] = $request->file->store('produk', 'public');
        }

        $produk->update($payload);
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $produk
        ]);
    }

    public function destroy($id)
    {
        $produk = Produk::query()->where("id", $id)->first();
        $produk->delete();
        Storage::disk('public')->delete($produk->file);
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $produk
        ]);
    }
}
