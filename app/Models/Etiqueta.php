<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    public function prendas()
    {
        return $this->belongsToMany(Prenda::class, 'prenda_etiquetas');
    }
}
