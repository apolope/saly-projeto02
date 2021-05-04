@extends('layouts.app')

@section('scripts')
    <script type="text/javascript" src="/js/multselect.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <a href='{{ url('lends') }}'>
                            Voltar
                        </a>
                    </div>
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
                        <h3>Inserir Saída</h3>
                        <form action="{{ url('lends/store') }}" method="post">
                            @csrf
                            <input hidden name="lender_user_id" value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <label for="users">Detentor</label>
                                {{ Form::select(
                                    'user_id',
                                    $users,
                                    old('user_id', auth()->user()->id),
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => 'Selecionar o detentor do livro',
                                    ]
                                ) }}
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <label for="title">Livros Disponíveis</label>
                                        {{ Form::select(
                                            'books',
                                            $books,
                                            old('books', null),
                                            [
                                                'id' => 'bookList',
                                                'name' => 'bookList',
                                                'multiple' => 'multiple',
                                                'style' => 'width: 100%; height: 150px; margin: 0px 2px 0px 3px;'
                                            ]
                                        ) }}
                                    </div>
                                    <div class="col-md-1 d-flex justify-content-center h-100">
                                        <a href="javascript:void(0);" id="removePop">
                                            <button type="button" class="btn btn-dark"><</button>
                                        </a>
                                    </div>
                                    <div class="col-md-1 d-flex justify-content-center h-100">
                                        <a href="javascript:void(0);" class="addPop" id="addPop">
                                            <button type="button" class="btn btn-dark">></button>
                                        </a>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="title">Livros Selecionados</label>
                                        <select id="selectBooksList" name="selectBooksList[]" multiple="multiple"
                                            style="width: 100%; height: 150px; margin: 0px 2px 0px 3px;">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="author">Data de retorno</label>
                                <div class="input-group date">
                                    <input
                                        id="return_forecast"
                                        name="return_forecast"
                                        class="form-control"
                                        type="date"
                                        value="{{ \Carbon\Carbon::now()->addDays(5)->format('Y-m-d') }}"
                                        id="example-date-input"
                                    >
                                </div>
                            </div>
                            <div class="justify-content-end">
                                <button type="submit" class="btn btn-success">Cadastrar Saída</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
