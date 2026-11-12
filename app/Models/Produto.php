<?php

namespace App\Models;

use App\Models\Scopes\ProdutoRelationsScope;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
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

    protected static function booted(): void
    {
        static::addGlobalScope(new ProdutoRelationsScope);
    }

    public function scopePorRegiao(Builder $query, string $nome)
    {
        $query->whereHas('regiao',fn($q)=>$q->where('regioes.nome','like',"%$nome%"));
    }

    #[Scope]
    public function importados(Builder $query, bool $importado = true)
    {
        $query->where('importado', $importado);
    }

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function promocoes(): BelongsToMany
    {
        return $this->belongsToMany(Promocao::class)
            ->withPivot('desconto')
            ->withTimestamps();
    }

    public function regiao(): BelongsToThrough
    {
        return $this->belongsToThrough(
            Regiao::class,
            [
                Estado::class,
                Fornecedor::class
            ],
            foreignKeyLookup: [
                Regiao::class => 'regiao_id',
                Fornecedor::class => 'fornecedor_id'
            ]
        );
    }
}
