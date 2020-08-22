@extends('table')
<!-- Page Heading -->
@section('titulo-page')
    Empresas
@endsection
<!-- Page Heading -->

<!-- DataTales Example -->
@section('titulo-table')
    Empresas
@endsection
@section('thead')
    <th scope="col" width="10%">Nº Empresa</th>
    <th scope="col" width="30%">CNPJ</th>
    <th scope="col" width="40%">Nome</th>
    <th scope="col" width="20%" class="text-right">Opções</th>
@endsection
@section('tfooter')
    <th>Nº Empresa</th>
    <th>CNPJ</th>
    <th>Nome</th>
    <th class="text-right">Opções</th>
@endsection
@section('tbody')
    @foreach($empresas as $empresa)
        <tr>
            <td>{{ $empresa->nro_empresa }} <input type="hidden" nome="nro_empresa" value="{{ $empresa->nro_empresa }}" id="input-nro_empresa-{{ $empresa->id }}"></td>
            <td>{{ $empresa->cnpj }} <input type="hidden" nome="cnpj" value="{{ $empresa->cnpj }}" id="input-cnpj-{{ $empresa->id }}"></td>
            <td>{{ $empresa->nome }} <input type="hidden" nome="nome" value="{{ $empresa->nome }}" id="input-nome-{{ $empresa->id }}"></td>
            <td>
                <div class="d-sm-flex justify-content-end ">
                    <div class="btn-group dropleft dropdown ">
                        <a class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm dropdown-toggle no-arrow" id="opcoesEmpresa" href="#" aria-haspopup="true" aria-expanded="false" role="button" data-toggle="dropdown">
                            <i class="far fa-edit fa-sm mr-2"></i>Opções
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu shadow" aria-labelledby="opcoesUsuario">
                            <button class="dropdown-item" onclick="preencheEditarEmpresa({{ $empresa->id }})">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Editar
                            </button>
                            <button class="dropdown-item" onclick="confirmarExcluirEmpresa({{ $empresa->id }})">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Excluir
                            </button>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
@endsection

<!-- Modal Adicionar-->
@section('titleModalAdicionar')
    Adicionar Empresa
@endsection

@section('bodyModalAdicionar')
    @csrf
    <div class="form-group">
        <label for="nro_empresa" class="col-form-label">Nº Empresa</label>
        <input type="text" class="form-control" name="nro_empresa" id="nro_empresa-adicionar" required >
    </div>
    <div class="form-group">
        <label for="cnpj" class="col-form-label">CNPJ</label>
        <input type="text" class="form-control" name="cnpj" id="cnpj-adicionar" required >
    </div>
    <div class="form-group">
        <label for="nome" class="col-form-label">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome-adicionar" required >
    </div>
@endsection
<!-- End Modal Adicionar-->

<!-- Modal Editar-->
@section('titleModalEditar')
    Editar Empresa
@endsection
@section('bodyModalEditar')
    @csrf
    <div class="form-group">
        <label for="nro_empresa" class="col-form-label">Nº Empresa</label>
        <input type="text" class="form-control" name="nro_empresa" id="nro_empresa-editar" required >
    </div>
    <div class="form-group">
        <label for="cnpj" class="col-form-label">CNPJ</label>
        <input type="text" class="form-control" name="cnpj" id="cnpj-editar" required >
    </div>
    <div class="form-group">
        <label for="nome" class="col-form-label">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome-editar" required >
    </div>
    @method('PUT')
@endsection
<!-- End Modal Editar-->

<!-- Modal Excluir-->
@section('titleModalExcluir')
    Excluir Empresa?
@endsection
@section('bodyModalExcluir')
    @csrf
    Tem certeza que deseja escluir a empresa:<br>
    <span id="bodyModalExcluir"></span>
    @method('DELETE')
@endsection
<!-- End Modal Excluir-->

@section('script')
    <script>
        // preenche os campos do modal editar
        function preencheEditarEmpresa(empresaId){
            const nro_empresa = document.querySelector(`#input-nro_empresa-${empresaId}`).value;
            const cnpj = document.querySelector(`#input-cnpj-${empresaId}`).value;
            const nome = document.querySelector(`#input-nome-${empresaId}`).value;

            document.querySelector('#nro_empresa-editar').value = nro_empresa;
            document.querySelector('#cnpj-editar').value = cnpj;
            document.querySelector('#nome-editar').value = nome;

            document.querySelector('#formModalEditar').setAttribute("action", `/empresas/${empresaId}`);
            $("#modalEditar").modal("show");
        }

        //confirmaexclusao de usuario
        function confirmarExcluirEmpresa(empresaId){
            const nome = document.querySelector(`#input-nome-${empresaId}`).value;

            document.querySelector("#bodyModalExcluir").textContent = nome;
            document.querySelector('#formModalExcluir').setAttribute("action", `empresas/${empresaId}`);

            $("#modalExcluir").modal("show");

        }

    </script>
@endsection
