<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DataController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $filePath = storage_path('app/data.json');

        // Delete the existing data.json file if it exists
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Create a new data.json file with the new data
        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));

        return response()->json(['message' => 'Data saved successfully and old file deleted']);
    }

    public function getData()
    {
        $filePath = storage_path('app/data.json');

        if (file_exists($filePath)) {
            $data = json_decode(file_get_contents($filePath), true);
            return response()->json($data);
        } else {
            return response()->json(['message' => 'No data found'], 404);
        }
    }
}
