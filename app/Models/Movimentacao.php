<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'movimentacoes';

    protected $fillable = [
        'product_id',
        'type',
        'quantity',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'product_id');
    }
}
