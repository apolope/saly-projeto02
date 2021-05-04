@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <a href='{{ url('lends/returned') }}'>
                        Ver os devolvidos
                    </a>
                </div>
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
                    <h3>Lista dos Emprestimos Ativos</h3>
                    <table class="table">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Detentor</th>
                            <th scope="col">Data Devolução</th>
                            <th scope="col">Livros</th>
                            <th scope="col">Emprestado por</th>
                            <th scope="col">Data do Emprestimo</th>
                            <th scope="col">Entrega</th>
                            <th scope="col">Excluir</th>
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
                            <td>{{ \Carbon\Carbon::parse($l->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#modalReturnId{{ $l->id }}"
                                >
                                    Devolução
                                </button>
                                <form
                                    id='formReturnId{{ $l->id }}'
                                    action='{{ url('lends/devolution/' . $l->id) }}'
                                    method='post'
                                >
                                    @csrf
                                </form>
                            </td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="#modalId{{ $l->id }}"
                                >
                                    Excluir
                                </button>
                                <form
                                    id='formDeleteId{{ $l->id }}'
                                    action='{{ url('lends/delete/' . $l->id) }}'
                                    method='post'
                                >
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                            {{-- Modal confirm to delete --}}
                            <div
                                class="modal fade"
                                id="modalId{{ $l->id }}"
                                tabindex="-1"
                                aria-labelledby="modalId{{ $l->id }}"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Deletar Emprestimo
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deletar o livro : {{ $l->title }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-dismiss="modal"
                                            >
                                                Cancelar
                                            </button>
                                            <button
                                                type="submit"
                                                form="formDeleteId{{ $l->id }}"
                                                class="btn btn-danger"
                                            >
                                                Excluir
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Modal confirm to return --}}
                            <div
                                class="modal fade"
                                id="modalReturnId{{ $l->id }}"
                                tabindex="-1"
                                aria-labelledby="modalReturnId{{ $l->id }}"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Registrar Devolução
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Registrar a devolução do(s) livro(s)?
                                            <br />
                                            @foreach ($l->books as $b)
                                                <span class="badge badge-secondary">
                                                    {{ $b->title }}
                                                </span>
                                                @if (!$loop->last)
                                                    {{ 'e' }}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-dismiss="modal"
                                            >
                                                Cancelar
                                            </button>
                                            <button
                                                type="submit"
                                                form="formReturnId{{ $l->id }}"
                                                class="btn btn-success"
                                            >
                                                Confirmar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach
                    </table>
                    <div class="justify-content-end">
                        <a href='{{ url('lends/create') }}'>
                            <button type="button" class="btn btn-success">
                                Criar Emprestimo
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
