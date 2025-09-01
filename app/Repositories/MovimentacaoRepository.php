<?php

namespace App\Repositories;

use App\Models\Movimentacao;
use App\Models\Produto;
use App\Models\ProdutoEstoque;
use Exception;

class MovimentacaoRepository{

    public function query(){

        return Movimentacao::with('produto');
    }

    public function getProdutosForMovimentacao(){
        try{

            return Produto::all();

        }catch(Exception $e){
            throw new Exception("Erro ao buscar produtos para nova movimentação: ". $e->getMessage());
        }
    }

    public function getMovimentacaoById($id)
    {
        return Movimentacao::findOrFail($id);
    }

    public function createMovimentacao($data){

        $produtoEstoque = ProdutoEstoque::where('product_id', $data['product_id'])->first();

        if ($data['type'] === 'saida' && $data['quantity'] > $produtoEstoque->quantity) {
            throw new \Exception('Quantidade de saída maior que o estoque disponível.');
        }

        Movimentacao::create([
            'product_id' => $data['product_id'],
            'type' => $data['type'],
            'quantity' => $data['quantity'],
        ]);

        if ($data['type'] === 'entrada') {
            $produtoEstoque->quantity += $data['quantity'];
        } else {
            $produtoEstoque->quantity -= $data['quantity'];
        }

        $produtoEstoque->save();

    }

    public function updateMovimentacao($id, $data)
    {
        $movimentacao = Movimentacao::findOrFail($id);
        $produtoEstoque = ProdutoEstoque::where('product_id', $movimentacao->product_id)->firstOrFail();


        if ($movimentacao->type === 'entrada') {
            $produtoEstoque->quantity -= $movimentacao->quantity;
        } else {
            $produtoEstoque->quantity += $movimentacao->quantity;
        }


        if ($data['type'] === 'saida' && $data['quantity'] > $produtoEstoque->quantity) {
            throw new \Exception('Quantidade de saída maior que o estoque disponível.');
        }

        if ($data['type'] === 'entrada') {
            $produtoEstoque->quantity += $data['quantity'];
        } else {
            $produtoEstoque->quantity -= $data['quantity'];
        }

        $produtoEstoque->save();

        $movimentacao->update($data);

        return $movimentacao;
    }

    public function deleteMovimentacao($id)
    {
        $movimentacao = Movimentacao::findOrFail($id);
        $produtoEstoque = ProdutoEstoque::where('product_id', $movimentacao->product_id)->firstOrFail();


        if ($movimentacao->type === 'entrada') {
            $produtoEstoque->quantity -= $movimentacao->quantity;
        } else {
            $produtoEstoque->quantity += $movimentacao->quantity;
        }

        $produtoEstoque->save();

        $movimentacao->delete();

        return true;
    }


}


