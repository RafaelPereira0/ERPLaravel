@extends('layouts.app')

@section('title', 'Administradores')


@section('content')

    <div>
        <a href="{{route('admin.create')}}" class="btn btn-primary m-4">
            Criar Administrador
        </a>
    </div>

    @include('components.table', [
        'headers' => ['Nome', 'Email', 'Opções'],
        'rows' => $admins->map(function($admin) {
            return [
                $admin->name,
                $admin->email,
                '<a href="'.route('estoque.edit', $admin->id).'" class="btn btn-sm btn-warning me-2">Editar</a>'.
                '<form action="'.route('admin.destroy', $admin->id).'" method="POST" style="display:inline">'.
                    csrf_field().
                    method_field('DELETE').
                    '<button type="submit" class="btn btn-sm btn-danger">Excluir</button>'.
                '</form>'
            ];
        })->toArray(),
        'rawColumns' => [2]
    ])

@endsection
