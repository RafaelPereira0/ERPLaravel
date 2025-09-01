@extends('layouts.app')

@section('title', 'Produtos')

@section('content')


<div class="d-flex justify-content-center align-items-center vh-75">

    <form class="w-50 border p-4 rounded shadow" action="{{route('produtos.store')}}" method="POST">
        @csrf

        <h2 class="mb-4 text-primary fw-bold border-bottom pb-2">Novo Produto</h2>

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço (R$)</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="description" name="description" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@endsection
