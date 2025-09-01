<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Repositories\FornecedorRepository;
use Illuminate\Cache\RedisTagSet;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    protected $repo;

    public function __construct(FornecedorRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
         try{
            $fornecedores = $this->repo->allFornecedores();

            return view('fornecedor.index', compact('fornecedores'));
        }catch(\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }



    public function create()
    {
        return view('fornecedor.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:fornecedors,email',
            'phone' => 'nullable|string|max:20',
            'cnpj' => ['required', 'regex:/^\d{14}$/', 'unique:fornecedors,cnpj'],
        ]);

        try {


            $this->repo->createFornecedor($validated);

            return redirect()->route('fornecedores.index')
                            ->with('success', 'Fornecedor criado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', $e->getMessage())
                            ->withInput();
        }
    }

    public function edit($id)
    {
        $fornecedor = $this->repo->findById($id);

        return view('fornecedor.edit', compact('fornecedor'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:fornecedors,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'cnpj' => ['required', 'regex:/^\d{14}$/'],
        ]);

        try {
            $this->repo->updateFornecedor($id, $validated);

            return redirect()->route('fornecedores.index')
                            ->with('success', 'Fornecedor editado com sucesso.');

        } catch (\Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $this->repo->deleteFornecedor($id);

            return redirect()->route('fornecedores.index')
                            ->with('success', 'Fornecedor deletado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', $e->getMessage());
        }
    }

}
