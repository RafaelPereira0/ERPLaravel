<?php

namespace App\Repositories;

use App\Models\Cliente;
use Exception;

class ClienteRepository{

    public function allClientes(){

        return Cliente::all();
    }

    public function findById($id){
        $cliente = Cliente::find($id);

        return $cliente;

    }

    public function createCliente($data)
    {


        if(Cliente::where('email', $data['email'])->exists()){
            throw new Exception("Já existe um cliente com esse email");
        }

        $cliente = Cliente::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'] ?? null,
        ]);

        return $cliente;
    }

    public function updateCliente($id, $data){
        $cliente = Cliente::findOrFail($id);

        $cliente->update($data);

        return $cliente;
    }

    public function deleteCliente($id){
        $cliente = Cliente::findOrFail($id);

        $cliente->delete();
    }

}
