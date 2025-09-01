@extends('layouts.app')

@section('title', 'Fornecedores')

@section('content')

    <div>
        <a href="{{route('fornecedores.create')}}" class="btn btn-primary m-4">
            Criar Fornecedor
        </a>
    </div>

    @include('components.table', [
        'headers' => ['Nome', 'CNPJ', 'Email','Telefone', 'Opções'],
        'rows' => $fornecedores->map(function($fornecedor) {
            return [
                $fornecedor->name,
                $fornecedor->cnpj,
                $fornecedor->email,
                $fornecedor->phone,
                '<a href="'.route('fornecedores.edit', $fornecedor->id).'" class="btn btn-sm btn-warning me-2">Editar</a>'.
                '<form action="'.route('fornecedores.destroy', $fornecedor->id).'" method="POST" style="display:inline">'.
                    csrf_field().
                    method_field('DELETE').
                    '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir?\')>Excluir</button>'.
                '</form>'
            ];
        })->toArray(),
        'rawColumns' => [4]
    ])

@endsection
