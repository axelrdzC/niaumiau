<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Prenda;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Talla;
use App\Models\Color;
use App\Models\Etiqueta;
use Illuminate\Support\Facades\Storage;

class PrendaController extends Controller
{
    public function index()
    {
        $prendas = Prenda::all();
        return view('closet.index', compact('prendas'));
    }

    public function create()
    {

        return view('closet.create', [
            'categorias' => Categoria::all(),
            'marcas' => Marca::all(),
            'tallas' => Talla::all(),
            'colores' => Color::all(),
            'etiquetas' => Etiqueta::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'notas' => 'nullable|string|max:255',
            'categoria_id' => 'nullable|exists:categorias,id',
            'marca_id' => 'nullable|exists:marcas,id',
            'talla_id' => 'nullable|exists:tallas,id',
            'color_id' => 'nullable|exists:colors,id',
            'estacion' => 'nullable|string', 
            'ocasion' => 'nullable|string', 
            'mood' => 'nullable|string', 
            'precio' => 'required|numeric|min:0',
            'moneda' => 'required|string|size:3|in:MXN,USD,EUR',
            'fecha_adquisicion' => 'nullable|date',
            'estado' => 'nullable|string|max:50',
        ]);

        $estaciones = explode(',', $request->estacion);

        $user = Auth::user();
        $name = $user->username;
    
        if ($request->hasFile('imagen')) {

            $file = $request->file('imagen');
            $filename = $name . '_' . time() . '.' . $file->getClientOriginalExtension(); // Nombre personalizado con timestamp
            $imagePath = $file->storeAs('prendas', $filename, 'public');
        
        }

        Prenda::create([
            'user_id' => auth()->id(),
            'imagen' => $imagePath,
            'notas' => $request->notas,
            'categoria_id' => $request->categoria_id,
            'marca_id' => $request->marca_id,
            'talla_id' => $request->talla_id,
            'color_id' => $request->color_id,
            'estacion' => json_encode($estaciones),
            'ocasion' => $request->ocasion, 
            'mood' => $request->mood, 
            'precio' => $request->precio,
            'moneda' => $request->moneda,
            'fecha_adquisicion' => $request->fecha_adquisicion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('closet.index');
    }

    public function edit(Prenda $prenda)
    {
        return view('modales.item-preview', compact('prenda'));
    }

    public function update(Request $request, $id)
    {
        // Buscar la prenda
        $prenda = Prenda::findOrFail($id);
    
        // Validar la solicitud
        $request->validate([
            'notas' => 'nullable|string|max:255',
            'categoria_id' => 'nullable|exists:categorias,id',
            'marca_id' => 'nullable|exists:marcas,id',
            'talla_id' => 'nullable|exists:tallas,id',
            'color_id' => 'nullable|exists:colors,id',
            'estacion' => 'nullable', // No aplicamos 'string' porque puede ser array
            'ocasion' => 'nullable|string',
            'mood' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'moneda' => 'required|string|size:3|in:MXN,USD,EUR',
            'fecha_adquisicion' => 'nullable|date',
            'estado' => 'nullable|string|max:50',
        ]);
    
        // Convertir estación a JSON
        $estaciones = json_encode((array) $request->estacion);
    
        // Procesar la imagen solo si se subió una
        $imagePath = $prenda->imagen; // Mantener la imagen anterior si no se cambia
        if ($request->hasFile('imagen')) {
            $user = Auth::user();
            $file = $request->file('imagen');
            $filename = $user->username . '_' . time() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('prendas', $filename, 'public');
        }
    
        // Actualizar la prenda
        $prenda->update([
            'user_id' => auth()->id(),
            'imagen' => $imagePath,
            'notas' => $request->notas,
            'categoria_id' => $request->categoria_id,
            'marca_id' => $request->marca_id,
            'talla_id' => $request->talla_id,
            'color_id' => $request->color_id,
            'estacion' => $estaciones,
            'ocasion' => $request->ocasion,
            'mood' => $request->mood,
            'precio' => $request->precio,
            'moneda' => $request->moneda,
            'fecha_adquisicion' => $request->fecha_adquisicion,
            'estado' => $request->estado,
        ]);
    
        // Responder con JSON si es una solicitud AJAX
        try {
            return response()->json(['success' => true, 'message' => 'Prenda actualizada correctamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al actualizar la prenda: ' . $e->getMessage()]);
        }
    }
    
    public function show($id)
    {
        $prenda = Prenda::findOrFail($id);
        return view('closet.show', compact('prenda'));
    }

    public function destroy($id)
    {
        $prenda = Prenda::find($id);
    
        if (!$prenda) {
            return response()->json(['success' => false, 'message' => 'Prenda no encontrada'], 404);
        }
    
        $prenda->delete();
    
        return response()->json(['success' => true, 'message' => 'Prenda eliminada correctamente']);
    }

    public function getAllPrendas()
    {
        return response()->json(Prenda::all());
    }

    public function getPrenda($id)
    {
        $prenda = Prenda::findOrFail($id);
        return response()->json($prenda);
    }
}
