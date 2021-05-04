@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <a href='{{ url('lends') }}'>
                        Voltar para os ativos
                    </a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Session::has('message'))
                        <div
                            class="alert {{ \Session::get('alert-class', 'alert-info') }}"
                            role="alert"
                            id="success-alert"
                        >
                            {{ \Session::get('message') }}
                        </div>
                    @endif
                    <h3>Lista dos Emprestimos Devolvidos</h3>
                    <table class="table">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Detentor</th>
                            <th scope="col">Data Prevista Devolução</th>
                            <th scope="col">Livros</th>
                            <th scope="col">Emprestado por</th>
                        </tr>
                        @foreach ($lends as $l)
                        <tr>
                            <td>{{ $l->id }}</td>
                            <td>{{ $l->holder->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($l->return_forecast)->format('d/m/Y') }}</td>
                            <td>
                                @foreach ($l->books as $b)
                                <span class="badge badge-secondary">
                                    {{ $b->title }}
                                </span>
                                @if (!$loop->last)
                                    {{ 'e' }}
                                @endif
                                @endforeach
                            </td>
                            <td>{{ $l->lender->name }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
