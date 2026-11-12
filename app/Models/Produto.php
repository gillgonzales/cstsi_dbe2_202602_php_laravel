<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Znck\Eloquent\Relations\BelongsToThrough;

class Produto extends Model
{
    use HasFactory, \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'nome',
        'descricao',
        'qtd_estoque',
        'preco',
        'importado',
        'fornecedor_id'
    ];

    public function fornecedor() : BelongsTo{
        return $this->belongsTo(Fornecedor::class);
    }

    public function promocoes() : BelongsToMany
    {
        return $this->belongsToMany(Promocao::class);
    }

     public function regiao() : BelongsToThrough{
        return $this->belongsToThrough(
            Regiao::class,
            [
                Estado::class,
                Fornecedor::class
            ],
            foreignKeyLookup:
            [
                Regiao::class=>'regiao_id',
                Fornecedor::class=>'fornecedor_id'
            ]
        );
    }
}
