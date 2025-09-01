<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\Produto;
use App\Models\ProdutoEstoque;
use App\Repositories\MovimentacaoRepository;
use Exception;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    protected $repo;

    public function __construct(MovimentacaoRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request){
        $query = $this->repo->query();


        if ($request->filled('tipo')) {
            $query->where('type', $request->tipo);
        }

        $movimentacoes = $query->get();

        return view('movimentacoes.index', compact('movimentacoes'));
    }

    public function create()
    {

        $produtos = $this->repo->getProdutosForMovimentacao();

        return view('movimentacoes.create', compact('produtos'));
    }

    public function edit($id)
    {
        try {

            $movimentacao = $this->repo->getMovimentacaoById($id);

            $produtos = Produto::all();

            return view('movimentacoes.edit', compact('movimentacao', 'produtos'));
        } catch (\Exception $e) {
            return redirect()->route('movimentacoes.index')
                            ->with('error', $e->getMessage());
        }
    }



    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produtos,id',
            'type' => 'required|in:entrada,saida',
            'quantity' => 'required|integer|min:1',
        ]);

        try{
            $this->repo->createMovimentacao($request->only(['product_id', 'type', 'quantity']));

            return redirect()->route('movimentacoes.index')->with('success', 'Movimentação criada com sucesso');
        }catch(\Exception $e){
            return redirect()->route('movimentacoes.index')->with('error', $e->getMessage());
        }

    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:produtos,id',
            'type' => 'required|in:entrada,saida',
            'quantity' => 'required|numeric|min:1',
        ]);

        try {
            $this->repo->updateMovimentacao($id, $validated);
            return redirect()->route('movimentacoes.index')->with('success', 'Movimentação atualizada com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('movimentacoes.index')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->repo->deleteMovimentacao($id);
            return redirect()->back()->with('success', 'Movimentação deletada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
