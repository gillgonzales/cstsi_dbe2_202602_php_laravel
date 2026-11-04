<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Estado extends Model
{
    protected $fillable = ['nome','uf','regiao_id'];

    public function regiao() : BelongsTo {
        return $this->belongsTo(Regiao::class);
    }

    public function fornecedores() : HasMany {
            return $this->hasMany(Fornecedor::class);
    }
}
