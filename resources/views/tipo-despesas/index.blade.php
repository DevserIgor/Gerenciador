@extends('table')
<!-- Page Heading -->
@section('titulo-page')
    Tipo de Despesas
@endsection
<!-- Page Heading -->

<!-- DataTales Example -->
@section('largura-table')
    col-md-7
@endsection
@section('titulo-table')
    Tipo de Despesas
@endsection
@section('thead')
    <th scope="col" width="50%">Descrição</th>
    <th scope="col" width="25%">Conta Contábil</th>
    <th scope="col" width="25%" class="text-right">Opções</th>
@endsection
@section('tfooter')
    <th>Descrição</th>
    <th>Conta Contábil</th>
    <th class="text-right">Opções</th>
@endsection
@section('tbody')
    @foreach($tipoDespesas as $tipoDespesa)
        <tr>
            <td>{{ $tipoDespesa->descricao }}
                <input type="hidden"
                       nome="descricao"
                       value="{{ $tipoDespesa->descricao }}"
                       id="input-descricao-{{ $tipoDespesa->id }}"
                >
            </td>
            <td>{{ $tipoDespesa->planoConta->conta_contabil }} - {{ $tipoDespesa->planoConta->descricao }}
                <input type="hidden"
                       nome="plano_conta"
                       value="{{ $tipoDespesa->planoConta->id }}"
                       id="input-planoConta-{{ $tipoDespesa->id }}"
                >
            </td>

            <td>
                <div class="d-sm-flex justify-content-end ">

                    <div class="btn-group dropleft dropdown ">
                        <a class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm dropdown-toggle no-arrow" id="opcoesPlanoContas" href="#" aria-haspopup="true" aria-expanded="false" role="button" data-toggle="dropdown">
                            <i class="far fa-edit fa-sm mr-2"></i>Opções
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu shadow" aria-labelledby="opcoesPlanoContas">
                            <button class="dropdown-item" onclick="preencheEditar({{ $tipoDespesa->id }})">
                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                Editar
                            </button>
                            <button class="dropdown-item" onclick="confirmarExcluir({{ $tipoDespesa->id }})">
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
    Adicionar Tipo de Despesa
@endsection

@section('bodyModalAdicionar')
    @csrf
    <div class="form-group">
        <label for="descricao" class="col-form-label">Nome</label>
        <input type="text" class="form-control" name="descricao" id="descricao-adicionar">
        <div class="invalid-feedback" id="descricao-adicionar-validacao">
            a descrição deve conter no mínimo três caracteres.
        </div>
    </div>
    <input type="hidden" name="empresa_id" value="{{session()->get('empresaAtual')}}">
    <div class="form-group " id="formGroupPlanoContas-adicionar">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="planoContas-adicionar">Conta Contábil</label>
            </div>
            <select class="custom-select" name="plano_conta_id" id="planoContas-adicionar" ></select>
            <div class="invalid-feedback" id="planoContas-adicionar-validacao">
                Escolha ao menos uma conta contábil.
            </div>
        </div>
    </div>
@endsection
<!-- End Modal Adicionar-->

<!-- Modal Editar-->
@section('titleModalEditar')
    Editar Tipo de Despesa
@endsection
@section('bodyModalEditar')
    @csrf
    <div class="form-group">
        <label for="descricao" class="col-form-label">Nome</label>
        <input type="text" class="form-control" name="descricao" id="descricao-editar" required >
        <div class="invalid-feedback" id="descricao-adicionar-validacao">
            a descrição deve conter no mínimo três caracteres.
        </div>
    </div>
    <input type="hidden" name="empresa_id" value="{{session()->get('empresaAtual')}}">
    <div class="form-group " id="formGroupPlanoContas-adicionar">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="planoContas-editar">Conta Contábil</label>
            </div>
            <input type="hidden" disabled value="" id="planoConta-editar-hidden">
            <select class="custom-select" name="plano_conta_id" id="planoContas-editar"></select>
            <div class="invalid-feedback" id="planoContas-adicionar-validacao">
                Escolha ao menos uma conta contábil.
            </div>
        </div>
    </div>
    @method('PUT')
@endsection
<!-- End Modal Editar-->

<!-- Modal Excluir-->
@section('titleModalExcluir')
    Excluir Tipo de Despesa?
@endsection
@section('bodyModalExcluir')
    @csrf
    Tem certeza que deseja escluir o tipo de despesa:<br>
    <span id="bodyModalExcluir"></span>
    @method('DELETE')
@endsection
<!-- End Modal Excluir-->

@section('script')
    <script>

        // preenche os campos do modal editar
        function preencheEditar(id){
            const descricao = document.querySelector(`#input-descricao-${id}`).value;
            const planoConta = document.querySelector(`#input-planoConta-${id}`).value;


            document.querySelector('#descricao-editar').value = descricao;

            document.querySelector('#planoConta-editar-hidden').value = planoConta;
            console.log('plano conta hidden',document.querySelector('#planoConta-editar-hidden').value);
            retornaContas('editar');
            document.querySelector('#formModalEditar').setAttribute("action", `/tipo-despesas/${id}`);

            $("#modalEditar").modal("show");
        }



        //confirmaexclusao de usuario
        function confirmarExcluir(id){
            const descricao = document.querySelector(`#input-descricao-${id}`).value;

            document.querySelector("#bodyModalExcluir").textContent = descricao;
            document.querySelector('#formModalExcluir').setAttribute("action", `tipo-despesas/${id}`);

            $("#modalExcluir").modal("show");

        }

        function retornaContas(origem){

            elementSelect = document.querySelector(`#planoContas-${origem}`);
            elementSelect.innerHTML = '';
            criaOption(`#planoContas-${origem}`,'','Carregando...');

            fetch('/plano-contas/retorna-contas', {
                method: 'GET'
            })
                .then(response => response.json())
                .then(contas => {
                    elementSelect.innerHTML = '';
                    contas.map((conta)=>{
                        criaOption(`#planoContas-${origem}`,conta.id,`${conta.conta_contabil} - ${conta.descricao}`);
                    });
                }).then(()=>{
                     var conta = document.querySelector("#planoConta-editar-hidden").value;
                     document.querySelector(`#planoContas-${origem}`).value = conta;
                });
        }

        function criaOption(selectId,value,text){
            elementSelect = document.querySelector(selectId);
            var opt = document.createElement('option');
            opt.value = value;
            opt.innerHTML = text;
            elementSelect.appendChild(opt);
        }

        function validaform(form){
            const descricaoElement = document.querySelector(`#descricao-${form}`);
            const planoContaElement = document.querySelector(`#planoContas-${form}`);

            var retorno = true;

            if(descricaoElement.value.length < 3){
                descricaoElement.classList.add('is-invalid');
                retorno = false;
            }

            if(planoContaElement.value === ""){
                planoContaElement.classList.add('is-invalid');
                retorno = false;
            }

            return retorno;
        }

        document.querySelector('#btn-top-adicionar').addEventListener("click", function(){
            retornaContas('adicionar');
        });


        window.onload = function() {
            // adiciona submit no formulario de edicao para validações
            document.querySelector('#btn-salvar-modal-adicionar').addEventListener('click', (event) =>{
                event.preventDefault();
                submit = validaform('adicionar');
                if(submit){
                    document.querySelector('#formModalAdicionar').submit();
                }
            });

            // adiciona submit no formulario de adição para validações
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
