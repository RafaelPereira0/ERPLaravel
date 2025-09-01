@extends('layouts.app')

@section('title', 'Fornecedores')

@section('content')


<div class="d-flex justify-content-center align-items-center vh-75">

    <form class="w-50 border p-4 rounded shadow" action="{{route('fornecedores.store')}}" method="POST">
        @csrf

        <h2 class="mb-4 text-primary fw-bold border-bottom pb-2">Novo Fornecedor</h2>

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" value="{{old('name')}}" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="cnpj" class="form-label">CNPJ</label>
            <input type="text" class="form-control" value="{{old('cnpj')}}" id="cnpj" name="cnpj" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" value="{{old('email')}}" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telefone</label>
            <input type="text" class="form-control" value="{{old('phone')}}" id="phone" name="phone" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@endsection
