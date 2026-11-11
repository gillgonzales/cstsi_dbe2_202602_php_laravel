<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Regiao extends Model
{
    protected $table = 'regioes';
    protected $fillable = ['nome'];

    public function estados() : HasMany
    {
        return $this->hasMany(Estado::class);
    }
}
