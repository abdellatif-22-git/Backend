<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function saveData(Request $request)
    {
        $data = $request->all();

        $filePath = 'data.json';

        $currentData = Storage::exists($filePath) ? json_decode(Storage::get($filePath), true) : [];

        $mergedData = array_merge($currentData, $data);

        Storage::put($filePath, json_encode($mergedData, JSON_PRETTY_PRINT));

        return response()->json(['message' => 'Data saved successfully']);
    }
}
