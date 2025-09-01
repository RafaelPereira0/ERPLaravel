@extends('layouts.app')

@section('title', 'Produtos')

@section('content')

    <div>
        <a href="{{route('produtos.create')}}" class="btn btn-primary m-4">
            Criar Produto
        </a>
    </div>

@include('components.table', [
    'headers' => ['Nome', 'Preço (R$)', 'Descrição', 'Ações'],
    'rows' => $produtos->map(function($produto) {
        $acoes = '';

        // Se não tiver estoque, botão para criar
        if (!$produto->stock) {
            $acoes .= '<form action="' . route('estoques.store') . '" method="POST" style="display:inline">';
            $acoes .= csrf_field();
            $acoes .= '<input type="hidden" name="product_id" value="' . $produto->id . '">';
            $acoes .= '<button type="submit" class="btn btn-sm btn-warning me-2">Criar Estoque</button>';
            $acoes .= '</form>';
        }
            $acoes .= '<a href="' . route('produtos.edit', $produto->id) . '" class="btn btn-sm btn-warning me-2">Editar</a>';
            $acoes .= '<form action="' . route('produtos.destroy', $produto->id) . '" method="POST" style="display:inline">';
            $acoes .= csrf_field();
            $acoes .= method_field('DELETE');
            $acoes .= '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir?\')">Excluir</button>';
            $acoes .= '</form>';

        return [
            $produto->name,
            number_format($produto->price, 2, ',', '.'),
            $produto->description,
            $acoes
        ];
    })->toArray(),
    'rawColumns' => [3]
])


@endsection
