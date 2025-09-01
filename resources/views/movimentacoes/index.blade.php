@extends('layouts.app')

@section('title', 'Movimentações')

@section('content')

    <div>
        <a href="{{route('movimentacoes.create')}}" class="btn btn-primary m-4">
            Criar Movimentacao
        </a>
    </div>

    <form method="GET" action="{{ route('movimentacoes.index') }}" class="mb-4 d-flex gap-2">
        <select name="tipo" class="form-select w-auto" onchange="this.form.submit()">
            <option value="">-- Todos --</option>
            <option value="entrada" {{ request('tipo') == 'entrada' ? 'selected' : '' }}>Entradas</option>
            <option value="saida" {{ request('tipo') == 'saida' ? 'selected' : '' }}>Saídas</option>
        </select>
    </form>

    @include('components.table',[
        'headers' => ['Produto','Quantidade', 'Tipo', 'Ações'],
        'rows' => $movimentacoes->map(function($movimentacao) {
            return [
                $movimentacao->produto->name,
                $movimentacao->quantity,
                $movimentacao->type,
                '<a href="'.route('movimentacoes.edit', $movimentacao->id).'" class="btn btn-sm btn-warning me-2">Editar</a>'.
                '<form action="'.route('movimentacoes.destroy', $movimentacao->id).'" method="POST" style="display:inline">'.
                    csrf_field().
                    method_field('DELETE').
                    '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir?\')>Excluir</button>'.
                '</form>'
            ];
        })->toArray(),
        'rawColumns' => [3]
    ])

@endsection
