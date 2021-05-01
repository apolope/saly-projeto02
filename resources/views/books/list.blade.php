@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Livros') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Session::has('message'))
                        <div class="alert {{ \Session::get('alert-class', 'alert-info') }}" role="alert" id="success-alert">
                            {{ \Session::get('message') }}
                        </div>
                    @endif
                    <h3>Lista dos Livros</h3>

                    <table class="table">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Doador</th>
                            <th scope="col">Inclusão</th>
                        </tr>
                        @foreach ($books as $b)
                            <tr>
                                <td>{{ $b->id }}</td>
                                <td>{{ $b->title }}</td>
                                <td>{{ $b->author }}</td>
                                <td>{{ $b->donor }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->created_at)->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="justify-content-end">
                        <a href='{{ url('books/new') }}'><button type="button" class="btn btn-success">Adicionar Novo Livro</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
