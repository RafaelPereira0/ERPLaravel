<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoEstoque extends Model
{
    protected $table = 'produto_estoques';
    protected $fillable = ['product_id', 'quantity'];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'product_id');
    }
}
