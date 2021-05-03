@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CRUD Simples - Projeto02 Saly</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Abrir a lista de <a href="{{ url('lends') }}">Emprestimos</a>
                    <br />
                    Abrir a lista de <a href="{{ url('books') }}">Livros</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
