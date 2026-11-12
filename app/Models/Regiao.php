<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Regiao extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $table = 'regioes';
    protected $fillable = ['nome'];

    public function estados() : HasMany
    {
        return $this->hasMany(Estado::class);
    }

    public function fornecedores(): HasManyThrough{
        return $this->hasManyThrough(Fornecedor::class, Estado::class);
    }

     public function produtos()
    {
        return $this->hasManyDeep(
            Produto::class,
            [Estado::class,Fornecedor::class]
        );
    }
}
