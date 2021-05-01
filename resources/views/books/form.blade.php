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

                    <h3>Inserir Livro</h3>

                    <form action="{{ url('books/add') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" name="title" aria-describedby="titleHelp" placeholder="Digite aqui o título">
                            <small id="titleHelp" class="form-text text-muted">Tente ser o mais preciso possível.</small>
                        </div>
                        <div class="form-group">
                            <label for="author">Autor</label>
                            <input type="text" class="form-control" name="author" aria-describedby="authorHelp" placeholder="Digite aqui o autor do livro">
                            <small id="authorHelp" class="form-text text-muted">Preencha como se tivesse sido você a te-lo escrito.</small>
                        </div>
                        <div class="form-group">
                            <label for="donor">Doador</label>
                            <input type="text" class="form-control" name="donor" aria-describedby="donorHelp" placeholder="Digite aqui que foi o doador do livro">
                        </div>
                        <div class="justify-content-end">
                            <button type="submit" class="btn btn-success">Cadastrar Novo Livro</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
