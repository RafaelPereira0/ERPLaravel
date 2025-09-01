@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container">

    <div class="row">
        @foreach ($produtoEstoque as $produto)
            @if ($produto->quantity <= 5 && $produto->quantity > 0)
                <div class="alert alert-warning" role="alert">
                    Estoque baixo: Produto {{$produto->produto->name}} está com apenas {{$produto->quantity}} unidades em estoque
                </div>
            @elseif ($produto->quantity == 0)
                <div class="alert alert-danger" role="alert">
                    Não há unidades do produto {{$produto->produto->name}} em estoque
                </div>
            @endif
        @endforeach

        {{-- aqui será os relatorios de cada produto  --}}

    </div>
</div>

@endsection
