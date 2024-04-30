<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Temperature;

class TemperatureController extends Controller
{
    public function index()
    {
        $temperatures = Temperature::orderBy('created_at', 'desc')->get();
         // select * from temperatures order by created_at desc
        
         return response()->json([
            'status' => 'success',
            'message' => 'List data temperatures',
            'data' => $temperatures
        ]);
    }

    public function store(Request $request){
        $value = $request->input('value');

        $temperatures = Temperature::create([
            'value' => $value
        ]);

        // $temperatures = new Temperature();
        // $temperatures->value = $value;
        // $temperatures->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data temperature berhasil disimpan',
            'data' => $temperatures
        ]);
    }
}
