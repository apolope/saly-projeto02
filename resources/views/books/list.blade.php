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
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                        @foreach ($books as $b)
                        <tr>
                            <td>{{ $b->id }}</td>
                            <td>{{ $b->title }}</td>
                            <td>{{ $b->author }}</td>
                            <td>{{ $b->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($b->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <a href='{{ url('books/edit/' . $b->id) }}'>
                                    <button type="button" class="btn btn-success">Editar</button>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalId{{ $b->id }}">
                                    Excluir
                                </button>
                                <form
                                    id='formDeleteId{{ $b->id }}'
                                    action='{{ url('books/delete/' . $b->id) }}'
                                    method='post'
                                >
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                            {{-- Modal confirm to delete --}}
                            <div class="modal fade" id="modalId{{ $b->id }}" tabindex="-1" aria-labelledby="modalId{{ $b->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Deletar Livro</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deletar o livro : {{ $b->title }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" form="formDeleteId{{ $b->id }}" class="btn btn-danger">Excluir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach
                    </table>

                    <div class="justify-content-end">
                        <a href='{{ url('books/create') }}'><button type="button" class="btn btn-success">Adicionar Novo Livro</button></a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
