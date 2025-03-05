<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function getAllCategorias()
    {
        return response()->json(Categoria::select('id', 'nombre')->get());
    }
}
