<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoEstoque;
use App\Repositories\ProdutoEstoqueRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class ProdutoEstoqueController extends Controller
{
    protected $repo;

    public function __construct(ProdutoEstoqueRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(){

        $produtosEstoque = $this->repo->allProdutosEstoque();

        return view('estoque.index', compact('produtosEstoque'));
    }

    public function store(Request $request){

        $validated = $request->validate([
        'product_id' => 'required|exists:produtos,id',
        ]);

        $this->repo->createEstoqueForProduto($validated['product_id']);

        return redirect()->route('estoque.index')->with('success', 'Estoque criado com sucesso');
    }

    public function edit($produto_id){
        // dd($produto_id);
        try{
            $produtoEstoque = $this->repo->getEstoqueComProduto($produto_id);
            $produto = $produtoEstoque->produto;

            return view('estoque.edit', compact('produtoEstoque', 'produto'));
        }catch(\Exception $e){
            return redirect()->route('estoque.index')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $produto_id){

        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        try{
            $this->repo->updateEstoque($produto_id, $validated);

            return redirect()->route('estoque.index')->with('success', 'Estoque atualizado com sucesso');
        }catch(\Exception $e){
            return redirect()->route('estoque.index')->with('error', $e->getMessage());
        }
    }

    public function destroy($id){
        try {
            $this->repo->deleteEstoque($id);

            return redirect()->route('produtos.index')
                ->with('success', 'Estoque do produto excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao excluir estoque: ' . $e->getMessage());
        }
    }
}
