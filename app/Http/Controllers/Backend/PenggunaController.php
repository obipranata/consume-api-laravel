<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::query()->get();
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $pengguna->makeHidden([
                'password'
            ])
        ]);
    }

    public function show($id)
    {
        $pengguna = Pengguna::query()->where("id", $id)->first();

        if ($pengguna == null) {
            return response()->json([
                "status" => false,
                "message" => "Pengguna tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $pengguna
        ]);
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        if (!isset($payload["nama"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada nama",
                "data" => null
            ]);
        }
        if (!isset($payload["email"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada email",
                "data" => null
            ]);
        }
        if (!isset($payload["password"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada password",
                "data" => null
            ]);
        }

        $pengguna = Pengguna::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $pengguna
        ]);
    }

    public function update(Request $request, $id)
    {
        $payload = $request->all();
        $pengguna = Pengguna::find($id);
        if (!$pengguna) {
            return response()->json([
                "status" => false,
                "message" => "pengguna tidak ditemukan",
                "data" => null
            ]);
        }

        $pengguna->update($payload);
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $pengguna
        ]);
    }

    public function destroy($id)
    {
        $pengguna = Pengguna::find($id);
        if (!$pengguna) {
            return response()->json([
                "status" => false,
                "message" => "pengguna tidak ditemukan",
                "data" => null
            ]);
        }

        $pengguna->delete();
        return response()->json([
            "status" => true,
            "message" => "Data berhasil dihapus",
        ]);
    }
}
