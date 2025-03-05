<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function prendas()
    {
        return $this->hasMany(Prenda::class);
    }
}
