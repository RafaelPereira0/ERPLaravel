@extends('layouts.app')

@section('title', 'Produtos')

@section('content')

    @include('components.table', [
        'headers' => ['Nome', 'Quantidade', 'Ações'],
        'rows' => $produtosEstoque->map(function($produto) {
            return [
                $produto->produto->name,
                $produto->quantity,
                '<a href="'.route('estoque.edit', $produto->produto->id).'" class="btn btn-sm btn-warning me-2">Editar</a>'.
                '<form action="'.route('estoque.destroy', $produto->id).'" method="POST" style="display:inline">'.
                    csrf_field().
                    method_field('DELETE').
                    '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir?\')">Excluir</button>'.
                '</form>'
            ];
        })->toArray(),
        'rawColumns' => [2]
    ])

@endsection
