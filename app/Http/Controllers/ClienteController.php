<?php

namespace App\Http\Controllers;

use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    protected $repo;

    public function __construct(ClienteRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(){

        try{
            $clientes = $this->repo->allClientes();

            return view('cliente.index', compact('clientes'));
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    public function create(){

        return view('cliente.create');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'phone' => 'nullable|string|max:20',
        ]);

        try{

            $cliente = $this->repo->createCliente($validated);

            return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso.');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }


    }

    public function edit($id){
        $cliente = $this->repo->findById($id);

        return view('cliente.edit', compact('cliente'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:fornecedors,email,' . $id,
            'phone' => 'nullable|string|max:20',
        ]);

        try{
            $this->repo->updateCliente($id, $validated);

            return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso');
        }catch(\Exception $e){
            return redirect()->route('clientes.index')->with('error', $e->getMessage());
        }
    }

    public function destroy($id){
        try{
            $this->repo->deleteCliente($id);

            return redirect()->route('clientes.index')->with('success', 'Cliente deletado com sucesso');
        }catch(\Exception $e){
            return redirect()->route('clientes.index')->with('error', $e->getMessage());
        }
    }
}
