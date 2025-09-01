<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\Produto;
use App\Models\ProdutoEstoque;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $produtoEstoque = ProdutoEstoque::with('produto')->get();

        return view('dashboard.index', compact('produtoEstoque'));
    }
}
