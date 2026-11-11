<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function fornecedor() : BelongsTo{
        return $this->belongsTo(Fornecedor::class);
    }

    public function promocoes() : BelongsToMany
    {
        return $this->belongsToMany(Promocao::class);
    }
}
