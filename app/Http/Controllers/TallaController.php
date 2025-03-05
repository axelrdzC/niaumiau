<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use Illuminate\Http\Request;

class TallaController extends Controller
{
    public function getAllTallas()
    {
        return response()->json(Talla::select('id', 'nombre')->get());
    }
}
