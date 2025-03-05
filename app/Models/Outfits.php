<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outfits extends Model
{
    protected $fillable = [
        'user_id',
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prendas()
    {
        return $this->belongsToMany(Prenda::class, 'outfit_prendas', 'outfit_id', 'prenda_id');
    }

}
