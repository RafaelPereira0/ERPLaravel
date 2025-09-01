<?php

namespace App\Repositories;

use App\Models\ProdutoEstoque;
use Exception;

class ProdutoEstoqueRepository{

    public function allProdutosEstoque(){
        $produtosEstoque = ProdutoEstoque::with('produto')->get();

        return $produtosEstoque;
    }

    public function getEstoqueComProduto($produtoId){
        $estoque = ProdutoEstoque::with('produto')
            ->where('product_id', $produtoId)
            ->first();

        if (!$estoque || !$estoque->produto) {
            throw new \Exception("Produto ou estoque não encontrado.");
        }

        return $estoque;
    }

    public function createEstoqueForProduto($id){
        return ProdutoEstoque::create([
            'product_id' => $id,
            'quantity' => 0
        ]);
    }


    public function updateEstoque($id, $data){

        $produto = ProdutoEstoque::findOrFail($id);

        $produto->update($data);
    }

    public function deleteEstoque($id){
        $estoque = ProdutoEstoque::findOrFail($id);

        $estoque->delete();

    }
}

