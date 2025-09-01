<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Models\ProdutoEstoque;

class ProdutoRepository
{
    public function allProdutos(){
        return Produto::all();
    }

    public function findById($id){
        $produto = Produto::findOrFail($id);

        return $produto;
    }

    public function updateProduto($id, $data){
        $produto = Produto::findOrFail($id);

        $produto->update($data);

    }

    public function createProduto($data){

        $produto = Produto::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
        ]);

        ProdutoEstoque::create([
            'product_id' => $produto->id,
            'quantity' => 0
        ]);
    }


    public function deleteProduto($id){
        $produto = Produto::findOrFail($id);

        if ($produto->stock && $produto->stock->quantity > 0) {
            throw new \Exception('Não é possível excluir o produto, pois ainda possui estoque.');
        }

        $produto->delete();
    }
}
