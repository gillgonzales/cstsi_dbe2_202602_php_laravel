<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    protected $table = "promocoes";
    protected $fillable = [
        'nome',
        'inicio',
        'fim',
        'desconto'
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class);
    }
}
