<?php

namespace App\Http\Controllers\Api;

use App\Models\Led;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LedController extends Controller
{
    // CRUD

    // READ all data-> index (GET) -> terserah namanya
    function index() {
        $leds = Led::orderBy('name', 'ASC')
            ->get ();

        return response()
            ->json([
            'mesage' => 'Data berhasil ditampilkan',
            'data' => $leds
        ], 200);
    }

    // READ single data -> show (GET) -> terserah namanya
    function show($id) {
        $led = Led::find($id);

        if (!$led){ //dibaca: jika led tidak ada
        return response()
            ->json([
                'mesage' => 'Data tidak ditemukan',
                'data' => null
        ], 404);
        }

         return response()
            ->json([
                'mesage' => 'Data berhasil ditampilkan',
                'data' => $led
        ], 200);
    }

    // CREATE data -> store (POST) -> terserah namanya
    function store(Request $request) {
        $led = Led::find($id);

        if (!$led){ //dibaca: jika led tidak ada
        return response()
            ->json([
                'mesage' => 'Data tidak ditemukan',
                'data' => null
        ], 404);
        }

        $validated = $request
            ->validate([
                "name" => [
                    "required",
                    "string",
                    "min:3",
                    "max:255",
                ],
                "pin" => [
                    "required",
                    "numeric",
                    "between:0, 39",
                ],
                "status" => [
                    "required",
                    "boolean",
                ],
            ]);

        $led ->update($validated);

        return response()
            ->json([
                'mesage' => 'Data berhasil diubah',
                'data' => $led
        ], 200);
    }

    // UPDATE data -> update (PUT/PATCH) -> terserah namanya
    function update(Request $request, $id) {

        $validated = $request
        ->validate([
            "name" => [
                "required",
                "string",
                "min:3",
                "max:255",
            ],
            "pin" => [
                "required",
                "numeric",
                "between:0, 39",

            ],
            "status" => [
                "required",
                "boolean",
            ],
        ]);

        $led = Led::create($validated);

        return response()
            ->json([
                'mesage' => 'Data berhasil ditampilkan',
                'data' => $led
        ], 201);
    }

    // DELETE data -> destroy (DELETE) -> terserah namanya
    function destroy($id) {
        $led = Led::find($id);

        if (!$led){ //dibaca: jika led tidak ada
        return response()
            ->json([
                'mesage' => 'Data tidak ditemukan',
                'data' => null
        ], 404);
        }

        $led->delete();

        return response()
            ->json([
                'mesage' => 'Data berhasil dihapus',
                'data' => $led
        ], 200);

    }
}
