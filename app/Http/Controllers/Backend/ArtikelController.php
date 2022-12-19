<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Lib\Response;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::query()->get();
        return Response::result(
            true,
            "Success",
            $artikel
        );
    }

    public function show($id)
    {
        $artikel = Artikel::where('id', $id)->first();
        return Response::result(
            true,
            "Success",
            $artikel
        );
    }

    public function store(Request $request)
    {
        $payload = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'foto' => $request->file('foto')->store('artikel', 'public'),
        ];
        $artikel = Artikel::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $artikel->makeHidden([
                'isi'
            ])
        ]);

        return Response::result(
            true,
            "Data berhasil di tambahkan",
            $artikel->makeHidden(['isi'])
        );
    }

    public function update(Request $request, $id)
    {
        $payload = $request->except(['foto']);
        $artikel = Artikel::find($id);
        if (isset($request->foto)) {
            Storage::disk('public')->delete($artikel->foto);
            $payload['foto'] = $request->foto->store('artikel', 'public');
        }

        $artikel->update($payload);

        return Response::result(
            true,
            "Data berhasil di update",
            $artikel->makeHidden([
                'isi'
            ])
        );
    }

    public function destroy($id)
    {
        $artikel = Artikel::find($id);

        Storage::disk('public')->delete($artikel->foto);
        $artikel->delete();

        return Response::result(
            true,
            "Data berhasil di hapus",
            $artikel->makeHidden([
                'isi'
            ])
        );
    }
}
