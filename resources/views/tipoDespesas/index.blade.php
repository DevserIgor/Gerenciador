@extends('layout')
@section('conteudo')
        @if($mensagemAlerta)
        <div class="alert alert-success"> {{ $mensagemAlerta }}</div>
        @endif
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 text-gray-800">Despesas</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " data-toggle="modal" data-target="#tipoDespesaAdicionarModal"><i class="fas fa-plus fa-sm text-white-50"></i> Adicionar</a>
        </div>


        <!-- Page Heading -->

{{--        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>--}}

        <!-- DataTales Example -->
        <div class="d-flex justify-content-center row  card shadow mb-4 ">
            <div class="card-header py-3 col-md-12">
                    <h6 class="m-0 font-weight-bold text-primary">Tipos de despesas</h6>
                </div>
            <div class="card-body d-flex justify-content-center">
                <div class="table-responsive table  col-md-8">
                    <table class="table table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-light">
                        <tr>
                            <th scope="col" width="10%" >Cód</th>
                            <th scope="col" width="45">Despesas</th>
                            <th scope="col" width="15">Conta Contábil</th>
                            <th scope="col" width="30" class="text-right">Opções</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr class="bg-primary text-light">
                            <th>Cód</th>
                            <th>Despesas</th>
                            <th>Conta Contábil</th>
                            <th class="text-right">Opções</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($tiposDespesas as $tipoDespesa)
                        <tr>
                            <td>{{ $tipoDespesa->id }}</td>
                            <td>{{ $tipoDespesa->descricao }}</td>
                            <td class="text-center">{{ $tipoDespesa->conta }}</td>
                            <td>
                                <div class="d-sm-flex justify-content-end ">
                                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="far fa-edit fa-sm mr-2"></i>Editar</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- End DataTales Example -->

        <!-- Modal Adicionar Despesa-->
        <div class="modal fade" id="tipoDespesaAdicionarModal" tabindex="-1" aria-labelledby="tipoDespesaAdicionarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tipoDespesaAdicionarLabel">Novo Tipo de Despesa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="tipoDespesaAdicionarform" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="descricao" class="col-form-label">Despesa</label>
                                <input type="text" class="form-control" name="descricao" required>
                            </div>
                            <div class="form-group">
                                <label for="conta" class="col-form-label">Conta Contábil</label>
                                <input class="form-control" name="conta" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                        <button type="submit" class="btn btn-primary" form="tipoDespesaAdicionarform">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Adicionar Despesa-->

@endsection
