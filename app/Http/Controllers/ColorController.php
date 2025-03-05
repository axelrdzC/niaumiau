<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function getAllColors()
    {
        return response()->json(Color::select('id', 'nombre', 'hex')->get());
    }
}
