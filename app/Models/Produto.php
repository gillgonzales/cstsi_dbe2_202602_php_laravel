<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'qtd_estoque',
        'preco',
        'importado',
        'fornecedor_id'
    ];

    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class);
    }

    public function promocoes()
    {
        return $this->belongsToMany(Promocao::class);
    }
}
