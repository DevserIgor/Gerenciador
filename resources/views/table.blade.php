@extends('layout')
@section('conteudo')
    @include("erros", ['errors'=> $errors] )
    @include("alert")
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">@yield('titulo-page')</h1>
        @if(!Request::is('usuarios/*/empresas'))
            <span class="d-sm-flex justify-content-end">

            <form action="@yield('action-intervalo-table')" method="POST" class=" form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100  d-none" id="form-intervalo-datas">
                @csrf
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control bg-light border-0 small data input-sm" value="@yield('data-inicio')" name="tableDataInicio" placeholder="Data Inicial" aria-label="Pesquisar" aria-describedby="basic-addon2">
                    <div class="input-group-append ">
                        <button class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="btn-pesquisar-intervalo" type="submit">
                            <i class="fas fa-search fa-sm text-white-50"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control bg-light border-0 small mr-2 data input-sm" value="@yield('data-fim')" name="tableDataFim" placeholder="Data Final" aria-label="Pesquisar" aria-describedby="basic-addon2">
                </div>
            </form>

            <a href="@yield('rota-download-excel')" class="  btn btn-sm btn-primary shadow-sm mr-2 d-none" id="btn-top-excel"><i class="fas fa-download fa-sm text-white-50"></i> Excel</a>
            <a href="@yield('rota-download-doc')" class="  btn btn-sm btn-primary shadow-sm mr-2 d-none" id="btn-top-download"><i class="fas fa-download fa-sm text-white-50"></i> Download</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " data-toggle="modal" data-target="#modalAdicionar" id="btn-top-adicionar"><i class="fas fa-plus fa-sm text-white-50"></i> Adicionar</a>
            </span>
        @else
            <span class="d-sm-flex justify-content-end">
                <a href="{{ route('usuarios.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm mr-2 text-white " id="btn-top-voltar">Voltar</a>
                <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " id="btn-top-salvar"><i class="fas fa-upload  fa-sm text-white-50"></i> Salvar</button>
            </span>
        @endif
    </div>

    <!-- DataTales Example-->
    <div class="d-flex justify-content-center row  card shadow mb-4 ">
        <div class="card-header py-3 col-md-12">
            <h6 class="m-0 font-weight-bold text-primary">@yield('titulo-table')</h6>
        </div>
        <div class="card-body d-flex justify-content-center">
            <div class="table-responsive table  @yield('largura-table')">
                @if(Request::is('usuarios/*/empresas'))
                    <form action="#" method="POST" id="form-table">
                    @csrf
                @endif

                <table class="table table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-light">
                        <tr>@yield('thead')</tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-primary text-light">@yield('tfooter')</tr>
                    </tfoot>
                    <tbody>

                        @yield('tbody')

                    </tbody>
                </table>
                @if(Request::is('usuarios/*/empresas'))
                    </form>
                @endif
            </div>
        </div>

    </div>

    <!-- End DataTales Example -->

    <!-- Modal Adicionar empresa-->
    <div class="modal fade" id="modalAdicionar" tabindex="-1" aria-labelledby="labelModalAdicionar" aria-hidden="true">
        <div class="modal-dialog @yield('tamanho-modal')">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelModalAdicionar">@yield('titleModalAdicionar')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formModalAdicionar" method="post" @yield('upload-form-adicionar')>
                        @yield('bodyModalAdicionar')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btn-salvar-modal-adicionar" form="formModalAdicionar">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar empresa-->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="labelModalEditar" aria-hidden="true">
        <div class="modal-dialog @yield('tamanho-modal')">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelModalEditar">@yield('titleModalEditar')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formModalEditar" method="post" @yield('upload-form-editar')>
                        @yield('bodyModalEditar')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btn-salvar-modal-editar" form="formModalEditar">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Excluir-->
    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="labelModalExluir" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelModalExluir">@yield('titleModalExcluir')</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formModalExcluir" method="post" >
                        @yield('bodyModalExcluir')
                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" id="btnModalExcluir" form="formModalExcluir">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    @yield('script')

@endsection
