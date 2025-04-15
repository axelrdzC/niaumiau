<?php

namespace App\Http\Controllers;

use App\Models\Outfits;
use App\Models\Prenda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OutfitsController extends Controller
{
    public function create()
    {

        return view('outfits.create', [
            'prendas' => Prenda::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prendas' => 'required|array',  
        ]);

        $outfit = Outfits::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        $outfit->prendas()->sync($request->prendas);

        return redirect()->route('outfits.index')
                         ->with('success', 'Outfit creado exitosamente!');
    }

    public function edit(Outfits $outfit)
    {
        $prendas = Prenda::all();
        return view('outfits.edit', compact('outfit', 'prendas'));
    }

    public function update(Request $request, $id)
    {
        
        $outfit = Outfits::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'prendas' => 'required|array',  
        ]);
    
        $outfit->update([
            'name' => $request->name,
        ]);
    
        $outfit->prendas()->sync($request->prendas);
    
        return redirect()->route('outfits.index')
                         ->with('success', 'Outfit actualizado exitosamente!');
    }

    public function index()
    {
        $userId = Auth::id(); // Obtiene el ID del usuario autenticado
        $outfits = Outfits::with('prendas')
                ->where('user_id', $userId)
                ->get();

        return view('outfits.index', compact('outfits'));
    }

    public function show($id)
    {
        $outfit = Outfits::with('prendas')->findOrFail($id);

        return response()->json([
            'outfit' => $outfit,
            'prendas' => $outfit->prendas,
        ]);
    }

    public function destroy(Outfits $outfit)
    {
        $outfit->prendas()->detach(); // Desvincular prendas antes de eliminar
        $outfit->delete();

        return response()->json(['success' => true]);
    }

}
