<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoEstoque;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    protected $repo;

    public function __construct( ProdutoRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(){

        $produtos = $this->repo->allProdutos();

        return view('produto.index', compact('produtos'));
    }

    public function create(){
        return view('produto.create');
    }

    public function edit($id){
        try{
            $produto = $this->repo->findById($id);

            return view('produto.edit', compact('produto'));

        }catch(\Exception $e){
            return redirect()->route('produtos.index')->with('error', $e->getMessage());
        }


    }

    public function update(Request $request, $id){

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string|max:200'
        ]);


        try{

            $this->repo->updateProduto($id, $validated);

            return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso');

        }catch(\Exception $e){
            return redirect()->route('produtos.index')->with('error', $e->getMessage());
        }

    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string|max:200'
        ]);

        try{

            $this->repo->createProduto($validated);

            return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso');

        }catch(\Exception $e){
            return redirect()->route('produtos.index')->with('error', $e->getMessage());
        }

    }

    public function destroy($id)
    {

        try{
            $this->repo->deleteProduto($id);

            return redirect()->route('produtos.index')->with('success', 'Produto deletado com sucesso');
        }catch(\Exception $e){
            return redirect()->route('produtos.index')->with('error', $e->getMessage());
        }

    }

}
