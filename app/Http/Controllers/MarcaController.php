<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function getAllMarcas()
    {
        return response()->json(Marca::select('id', 'nombre')->get());
    }
}
