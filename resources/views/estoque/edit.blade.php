@extends('layouts.app')

@section('title', 'Editar Estoque')

@section('content')


@section('content')


    <div class="d-flex justify-content-center align-items-center vh-75">

        <form class="w-50 border p-4 rounded shadow" action="{{route('estoque.update', $produtoEstoque->id)}}" method="POST">
            @csrf
            @method('PUT')
            <h2 class="mb-4 text-primary fw-bold border-bottom pb-2">Editar Estoque - Item: {{$produto->name}}</h2>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="quantity" value="{{$produtoEstoque->quantity}}" name="quantity" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>


@endsection
