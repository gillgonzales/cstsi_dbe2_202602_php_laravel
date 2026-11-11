<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promocao extends Model
{
    protected $table = "promocoes";
    protected $fillable = [
        'nome',
        'inicio',
        'fim',
        'desconto'
    ];

    public function produtos() : BelongsToMany
    {
        return $this->belongsToMany(Produto::class);
    }
}
