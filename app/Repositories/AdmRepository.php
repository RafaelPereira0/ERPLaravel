<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\User;
use Exception;

class AdmRepository{

    public function all(){

        return User::where('role', 'admin')->get();

    }

    public function findById($id){
        $user = User::find($id);

        return $user;

    }

    public function createADM($data){



        if(User::where('email', $data['email'])->exists()){
            throw new Exception("Já existe um usuário com esse email");
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return $user;

    }

    public function deleteAdm($id){
        $adm = User::findOrFail($id);

        $adm->delete();
    }

}

?>
