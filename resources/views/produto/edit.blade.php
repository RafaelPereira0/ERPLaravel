@extends('layouts.app')

@section('title', 'Produtos')

@section('content')


<div class="d-flex justify-content-center align-items-center vh-75">

    <form class="w-50 border p-4 rounded shadow" action="{{route('produtos.update', $produto->id)}}" method="POST">
        @csrf
        @method('put')

        <h2 class="mb-4 text-primary fw-bold border-bottom pb-2">Novo Produto</h2>

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" value="{{old('name', $produto->name)}}" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço (R$)</label>
            <input type="number" class="form-control" value="{{old('price', $produto->price)}}" id="price" name="price" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <input type="text" class="form-control" value="{{old('description', $produto->description)}}" id="description" name="description" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@endsection
