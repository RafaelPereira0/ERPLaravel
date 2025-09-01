@extends('layouts.app')

@section('title', 'Clientes')

@section('content')

    <div>
        <a href="{{route('clientes.create')}}" class="btn btn-primary m-4">
            Criar Cliente
        </a>
    </div>

    @include('components.table', [
        'headers' => ['Nome', 'Email', 'Telefone', 'Opções'],
        'rows' => $clientes->map(function($cliente) {
            return [
                $cliente->name,
                $cliente->email,
                $cliente->phone,
                '<a href="'.route('clientes.edit', $cliente->id).'" class="btn btn-sm btn-warning me-2">Editar</a>'.
                '<form action="'.route('clientes.destroy', $cliente->id).'" method="POST" style="display:inline">'.
                    csrf_field().
                    method_field('DELETE').
                    '<button type="submit" class="btn btn-sm btn-danger">Excluir</button>'.
                '</form>'
            ];
        })->toArray(),
        'rawColumns' => [3]
    ])

@endsection
