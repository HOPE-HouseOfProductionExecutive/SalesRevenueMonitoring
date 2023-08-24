<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getData() {
        $data = Revenue::all();

        return view('page.data', compact('data'));
    }
    public function getDataJson() {
        $data = Revenue::all();

        return response()->json($data);
    }
}
