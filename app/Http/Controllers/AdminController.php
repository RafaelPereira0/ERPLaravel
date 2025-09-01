<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Repositories\AdmRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\CssSelector\Node\FunctionNode;

class AdminController extends Controller
{
    protected $repo;

    public function __construct(AdmRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(){

        try{
            $admins = $this->repo->all();

            return view('admin.index', compact('admins'));
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    public function create(){

        return view('admin.create');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try{
            $data = [
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ];

            $admin = $this->repo->createADM($data);

            return redirect()->route('admin.index')->with('success', 'Admin criado com sucesso.');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }


    }

    public function destroy($id){
        try{
            $this->repo->deleteAdm($id);

            return redirect()->route('admin.index')->with('success', 'Admin deletado com sucesso');

        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
