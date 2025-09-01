
@php
    $raw = $rawColumns ?? [];
    if (!is_array($raw)) {
        $raw = (array) $raw;
    }
@endphp

<div class="container d-flex justify-content-center text-center vh-75">
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <table class="table table-striped w-75">

        <thead>
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr>
                    @foreach($row as $index => $cell)
                        @if(in_array($index, $raw))
                            <td>{!! $cell !!}</td>
                        @else
                            <td>{{ $cell }}</td>
                        @endif
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) }}" class="text-center">Nenhum registro encontrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

