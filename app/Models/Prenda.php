<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prenda extends Model
{
    protected $fillable = [
        'user_id',
        'imagen', 
        'notas', 
        'categoria_id', 
        'marca_id',
        'talla_id', 
        'color_id', 
        'estacion',
        'ocasion',
        'mood',
        'precio',
        'moneda',
        'fecha_adquisicion', 
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function talla()
    {
        return $this->belongsTo(Talla::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class, 'prenda_etiquetas');
    }

    public function outfits()
    {
        return $this->belongsToMany(Outfits::class, 'outfit_prendas');
    }
}
