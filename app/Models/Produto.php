<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $fillable = ['name', 'description', 'price'];

    // Relacionamento com ProdutoEstoque
    public function stock()
    {
        return $this->hasOne(ProdutoEstoque::class, 'product_id', 'id');
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class, 'product_id', 'id');
    }
}
