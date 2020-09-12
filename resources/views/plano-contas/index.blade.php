@extends('table')
<!-- Page Heading -->
@section('titulo-page')
    Plano de Contas
@endsection
<!-- Page Heading -->

<!-- DataTales Example -->
@section('largura-table')
    col-md-6
@endsection
@section('titulo-table')
    Contas
@endsection
@section('thead')
    <th scope="col" width="50%">Descrição</th>
    <th scope="col" width="25%">Nº Conta Contábil</th>
    <th scope="col" width="25%" class="text-right">Opções</th>
@endsection
@section('tfooter')
    <th>Descrição</th>
    <th>Nº Conta Contábil</th>
    <th class="text-right">Opções</th>
@endsection
@section('tbody')
    @foreach($planoContas as $planoConta)
        <tr>
            <td>{{ $planoConta->descricao }} <input type="hidden" nome="descricao" value="{{ $planoConta->descricao }}" id="input-descricao-{{ $planoConta->id }}"></td>
            <td>{{ $planoConta->conta_contabil }} <input type="hidden" nome="conta_contabil" value="{{ $planoConta->conta_contabil }}" id="input-conta_contabil-{{ $planoConta->id }}"></td>
            <td>
                <div class="d-sm-flex justify-content-end ">
                    <div class="btn-group dropleft dropdown ">
                        <a class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm dropdown-toggle no-arrow" id="opcoesPlanoContas" href="#" aria-haspopup="true" aria-expanded="false" role="button" data-toggle="dropdown">
                            <i class="far fa-edit fa-sm mr-2"></i>Opções
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu shadow" aria-labelledby="opcoesPlanoContas">
                            <button class="dropdown-item" onclick="preencheEditar({{ $planoConta->id }})">
                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                Editar
                            </button>
                            <button class="dropdown-item" onclick="confirmarExcluir({{ $planoConta->id }})">
                                <i class="fas fa-trash-alt fa-sm fa-fw mr-2 text-gray-400"></i>
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
    Adicionar Conta
@endsection

@section('bodyModalAdicionar')
    @csrf
    <div class="form-group">
        <label for="descricao" class="col-form-label">Descrição</label>
        <input type="text" class="form-control" name="descricao" id="descricao-adicionar"  >
        <div class="invalid-feedback" id="nome-editar-validacao">
            O campo descrição precisa ter ao menos 3 caracteres.
        </div>
    </div>
    <input type="hidden" name="empresa_id" value="{{session()->get('empresaAtual')}}">
    <div class="form-group">
        <label for="conta_contabil" class="col-form-label">Nº Conta Contábil</label>
        <input type="text" class="form-control" name="conta_contabil" id="conta_contabil-adicionar">
        <div class="invalid-feedback" id="nome-editar-validacao">
            O campo Nº Conta Contábil  precisa ser preenchido.
        </div>
    </div>
@endsection
<!-- End Modal Adicionar-->

<!-- Modal Editar-->
@section('titleModalEditar')
    Editar Conta
@endsection
@section('bodyModalEditar')
    @csrf
    <div class="form-group">
        <label for="descricao" class="col-form-label">Descrição</label>
        <input type="text" class="form-control" name="descricao" id="descricao-editar">
        <div class="invalid-feedback" id="nome-editar-validacao">
            O campo descrição precisa ter ao menos 3 caracteres.
        </div>
    </div>
    <input type="hidden" name="empresa_id" value="{{session()->get('empresaAtual')}}">
    <div class="form-group">
        <label for="conta_contabil" class="col-form-label">Nº Conta Contábil</label>
        <input type="text" class="form-control" name="conta_contabil" id="conta_contabil-editar">
        <div class="invalid-feedback" id="nome-editar-validacao">
            O campo Nº Conta Contábil  precisa ser preenchido.
        </div>
    </div>
    @method('PUT')
@endsection
<!-- End Modal Editar-->

<!-- Modal Excluir-->
@section('titleModalExcluir')
    Excluir conta?
@endsection
@section('bodyModalExcluir')
    @csrf
    Tem certeza que deseja escluir a conta:<br>
    <span id="bodyModalExcluir"></span>
    @method('DELETE')
@endsection
<!-- End Modal Excluir-->

@section('script')
    <script>
        // preenche os campos do modal editar
        function preencheEditar(id){
            const descricao = document.querySelector(`#input-descricao-${id}`).value;
            const conta_contabil = document.querySelector(`#input-conta_contabil-${id}`).value;


            document.querySelector('#descricao-editar').value = descricao;
            document.querySelector('#conta_contabil-editar').value = conta_contabil;


            document.querySelector('#formModalEditar').setAttribute("action", `/plano-contas/${id}`);
            $("#modalEditar").modal("show");
        }

        //confirmaexclusao de usuario
        function confirmarExcluir(id){
            const descricao = document.querySelector(`#input-descricao-${id}`).value;

            document.querySelector("#bodyModalExcluir").textContent = descricao;
            document.querySelector('#formModalExcluir').setAttribute("action", `plano-contas/${id}`);

            $("#modalExcluir").modal("show");

        }

        function validaform(form){
            const descricaoElement = document.querySelector(`#descricao-${form}`);
            const planoContaelement = document.querySelector(`#conta_contabil-${form}`);

            var retorno = true;

            if(descricaoElement.value.length < 3){
                descricaoElement.classList.add('is-invalid');
                retorno = false;
            }

            if(planoContaelement.value.length < 1){
                planoContaelement.classList.add('is-invalid');
                retorno = false;
            }

            return retorno;
        }

        window.onload = function() {
            //adiciona submit no formulario de edicao para validações
            // document.querySelector('#formModalEditar').setAttribute('return onsubmit', 'validaEditar();')
            document.querySelector('#btn-salvar-modal-adicionar').addEventListener('click', (event) =>{
                event.preventDefault();
                submit = validaform('adicionar');
                if(submit){
                    document.querySelector('#formModalAdicionar').submit();
                }
            });

            //adiciona submit no formulario de adição para validações
            document.querySelector('#btn-salvar-modal-editar').addEventListener('click', (event) =>{
                event.preventDefault();
                submit = validaform('editar');
                if(submit){
                    document.querySelector('#formModalEditar').submit();
                }
            });
        };

    </script>
@endsection
