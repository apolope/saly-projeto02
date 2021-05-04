@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><a href='{{ url('books') }}'>Voltar</a></div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h3>Editar Livro #{{ $book->id }}</h3>

                    <form action="{{ url('books/update/' . $book->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" name="title" aria-describedby="titleHelp" placeholder="Digite aqui o título" value='{{ $book->title }}' required>
                            <small id="titleHelp" class="form-text text-muted">Tente ser o mais preciso possível.</small>
                        </div>
                        <div class="form-group">
                            <label for="author">Autor</label>
                            <input type="text" class="form-control" name="author" aria-describedby="authorHelp" placeholder="Digite aqui o autor do livro" value='{{ $book->author }}' required>
                            <small id="authorHelp" class="form-text text-muted">Preencha como se tivesse sido você a te-lo escrito.</small>
                        </div>
                        <div class="form-group">
                            <label for="donor">Doador</label>
                            {{ Form::select(
                                'user_id',
                                $users,
                                old('user_id',
                                $book->user_id),
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'Selecionar o doador do livro'
                                ]
                            ) }}
                        </div>
                        <div class="justify-content-end">
                            <button type="submit" class="btn btn-success">Atualizar Novo Livro</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
