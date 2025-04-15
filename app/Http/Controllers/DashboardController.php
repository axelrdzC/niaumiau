<?php

namespace App\Http\Controllers;

use App\Models\Outfits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Obtiene el ID del usuario autenticado
        $outfits = Outfits::with('prendas')
                ->where('user_id', $userId)
                ->get();
        return view('dashboard', compact('outfits'));
    }
}
