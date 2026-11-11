<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fornecedor extends Model
{

    use HasFactory;

    protected $table  = 'fornecedores';
    protected $fillable = [
        'nome',
        'descricao'
    ];

    public function produtos(): HasMany{
        return $this->hasMany(Produto::class);
    }

    public function estado() : BelongsTo{
        return $this->belongsTo(Estado::class);
    }
}
