@extends('layouts.app')

@section('title', 'Registrar Movimentação')

@section('content')


<div class="d-flex justify-content-center align-items-center vh-75">

    <form class="w-50 border p-4 rounded shadow" action="{{ route('movimentacoes.update', $movimentacao->id) }}" method="POST">
        @csrf
        @method('put')

        <h2 class="mb-4 text-primary fw-bold border-bottom pb-2">Registrar Entrada ou Saída de Produto</h2>

        <div class="mb-3">
           <label for="product_id" class="form-label">Produto</label>
            <select name="product_id" id="product_id" class="form-select" required>
                @foreach($produtos as $produto)
                    <option value="{{ $produto->id }}" {{ old('product_id', $movimentacao->produto->id) == $produto->id ? 'selected' : '' }}>
                        {{ $produto->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Tipo</label>
            <select name="type" id="type" class="form-select" required>
                <option value="entrada" {{ old('type', $movimentacao->type) == 'entrada' ? 'selected' : '' }}>Entrada</option>
                <option value="saida" {{ old('type', $movimentacao->type) == 'saida' ? 'selected' : '' }}>Saída</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantidade</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $movimentacao->quantity ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@endsection
