<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    protected $table = 'regioes';
    protected $fillable = ['nome'];

    // public function estados()
    // {
    //     return $this->hasMany(Estado::class);
    // }
}
