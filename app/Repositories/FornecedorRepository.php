<?php

namespace App\Repositories;

use App\Models\Fornecedor;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FornecedorRepository{

    public function allFornecedores(){

        return Fornecedor::all();

    }

       public function createFornecedor($data)
    {

            if(Fornecedor::where('email', $data['email'])->exists()){
                throw new Exception("Já existe um cliente com esse email");
            }

            if (Fornecedor::where('cnpj', $data['cnpj'])->exists()) {
                throw new Exception("Já existe um fornecedor com esse CNPJ");
            }

            $fornecedor = Fornecedor::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'cnpj' => $data['cnpj'],
                'phone' => $data['phone'] ?? null,
            ]);

            return $fornecedor;

    }

     public function findById($id){


        $fornecedor = Fornecedor::find($id);

        return $fornecedor;

    }

    public function updateFornecedor($id, $data){

        $fornecedor = Fornecedor::findOrFail($id);


        $fornecedor->update($data);

        return $fornecedor;
    }

    public function deleteFornecedor($id){
        $fornecedor = Fornecedor::findOrFail($id);

        $fornecedor->delete();

    }

}
