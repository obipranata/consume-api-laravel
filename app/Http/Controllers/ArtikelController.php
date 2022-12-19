<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::query()->get();
        return view("artikel.index", compact('artikel'));
    }

    public function edit($id)
    {
        $artikel = Artikel::query()->where("id", $id)->first();
        return view("artikel.edit", compact('artikel'));
    }

    public function show($id)
    {
        $artikel = Artikel::query()->where("id", $id)->first();
        return view("artikel.show", compact('artikel'));
    }

    public function store()
    {
        $artikel = Artikel::all();
        return view("artikel.store", compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $data['judul'] = $request->judul;
        $data['isi'] = $request->isi;
        if ($request->hasFile('foto')) {
            $artikel = Artikel::query()->where("id", $id)->first();
            Storage::disk('public')->delete($artikel->file);
            $data['foto'] = $request->file('foto')->store('artikel', 'public');
        }
        Artikel::where('id', $id)->update($data);
        return redirect()->back()->with(['success' => 'Data berhasil di update!']);
        ;
    }

    public function create(Request $request)
    {
        $payload = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'foto' => $request->file('foto')->store('artikel', 'public'),
        ];
        Artikel::query()->create($payload);
        return redirect('/artikel')->with(['success' => 'Data berhasil di tambahkan!']);
    }

    public function destroy($id)
    {
        $artikel = Artikel::query()->where("id", $id)->first();
        $artikel->delete();
        Storage::disk('public')->delete($artikel->foto);
        return redirect()->back()->with(['success' => 'Data berhasil di hapus!']);
        ;
    }
}
