@extends('table')
<!-- Page Heading -->
@section('titulo-page')
    Despesas
@endsection
<!-- Page Heading -->

<!-- Rota de download de excel -->
@section('rota-download-excel')
    /despesas/exportacao-excel
@endsection
<!-- intervalo datas -->
@section('action-intervalo-table')
    /despesas/seta-intervalo-table
@endsection
@section('data-inicio')
    {{ date('d/m/Y',session()->get('tableDataInicio')) }}
@endsection
@section('data-fim')
    {{ date('d/m/Y',session()->get('tableDataFim')) }}
@endsection

<!-- DataTales Example -->
@section('largura-table')
    col-md-10
@endsection
@section('titulo-table')
    Despesas
@endsection
@section('thead')
    <th scope="col" width="15%">Data</th>
    <th scope="col" width="15%">Despesa</th>
    <th scope="col" width="10%">Valor</th>
    <th scope="col" width="30%">Histórico</th>
    <th scope="col" width="18%">Conta Contábil</th>
    <th scope="col" width="12%" class="text-right">Opções</th>
@endsection
@section('tfooter')
    <th>Data</th>
    <th>Conta</th>
    <th>Valor</th>
    <th>Histórico</th>
    <th>Conta Contábil</th>
    <th class="text-right">Opções</th>
@endsection
@section('tbody')
    @foreach($despesas as $despesa)
        <tr>
            <td>{{ date('d/m/Y', strtotime($despesa->data_cadastro) ) }}
                <input type="hidden"
                       value="{{ date('d/m/Y', strtotime($despesa->data_cadastro) ) }}"
                       id="input-data_cadastro-{{ $despesa->id }}"
                >
            </td>

            <td>{{ $despesa->tipo_despesa->descricao }}
                <input type="hidden"
                       value="{{ $despesa->tipo_despesa->id }}"
                       id="input-tipo_despesa_id-{{ $despesa->id }}"
                >
            </td>

            <td class="d-flex justify-content-between">
                R$
                <span>
                    {{ number_format($despesa->valor, 2, ',', '.')  }}
                    <input type="hidden"
                           value="{{ number_format($despesa->valor, 2, ',', '.') }}"
                           id="input-valor-{{ $despesa->id }}"
                    >
                </span>

            </td>

            <td>{{ $despesa->historico }}
                <input type="hidden"
                       value="{{ $despesa->historico }}"
                       id="input-historico-{{ $despesa->id }}"
                >
            </td>

            <td>{{ $despesa->tipo_despesa->planoConta->conta_contabil }}</td>

            <td>
                <div class="d-sm-flex justify-content-end ">

                    <div class="btn-group dropleft dropdown ">
                        <a class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm dropdown-toggle no-arrow" id="opcoes" href="#" aria-haspopup="true" aria-expanded="false" role="button" data-toggle="dropdown">
                            <i class="far fa-edit fa-sm mr-2"></i>Opções
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu shadow" aria-labelledby="opcoes">
                            <button class="dropdown-item" onclick="preencheEditar({{ $despesa->id }})">
                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                Editar
                            </button>
                            <button class="dropdown-item" onclick="confirmarExcluir({{ $despesa->id }})">
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
    Adicionar Despesa
@endsection

@section('bodyModalAdicionar')
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col ">
                <label for="data_cadastro" class="col-form-label">Data</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control data" autocomplete="off" name="data_cadastro" id="data_cadastro-adicionar">
                    <div class="invalid-feedback" id="data_cadastro-adicionar-validacao">
                        A data deve conter no mínimo três caracteres.
                    </div>
                </div>
            </div>
            <div class="col">
                <label for="tipo_despesa_id" class="col-form-label">Contas</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="tipoDespesas-adicionar"><i class="fas fa-university"></i></label>
                    </div>
                    <input type="hidden" id="tipo_despesa_id-adicionar-hidden">
                    <select class="custom-select" name="tipo_despesa_id" id="tipo_despesa_id-adicionar" ></select>
                    <div class="invalid-feedback" id="tipo_despesa_id-adicionar-validacao">
                        Escolha ao menos uma conta contábil.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-3 ">
                <label for="valor" class="col-form-label">Valor</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <input type="text" class="form-control moeda" name="valor" id="valor-adicionar">
                    <div class="invalid-feedback" id="valor-adicionar-validacao">
                        o valor é um campo necessário.
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <label for="historico" class="col-form-label">Histórico</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-list"></i></span>
                    </div>
                    <input type="text" class="form-control text-uppercase" name="historico" id="historico-adicionar">
                    <div class="invalid-feedback" id="historico-adicionar-validacao">
                        O histórico é um campo necessário.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="empresa_id" value="{{session()->get('empresaAtual')}}">
@endsection
<!-- End Modal Adicionar-->

<!-- Modal Editar-->
@section('tamanho-modal')
    modal-lg
@endsection
@section('titleModalEditar')
    Editar Despesa
@endsection
@section('bodyModalEditar')
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col ">
                <label for="data_cadastro" class="col-form-label">Data</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control data" autocomplete="off" name="data_cadastro" id="data_cadastro-editar">
                    <div class="invalid-feedback" id="data_cadastro-editar-validacao">
                        A data deve conter no mínimo três caracteres.
                    </div>
                </div>
            </div>
            <div class="col">
                <label for="tipo_despesa_id" class="col-form-label">Contas</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="tipoDespesas-editar"><i class="fas fa-university"></i></label>
                    </div>
                    <input type="hidden" id="tipo_despesa_id-editar-hidden">
                    <select class="custom-select" name="tipo_despesa_id" id="tipo_despesa_id-editar" ></select>
                    <div class="invalid-feedback" id="tipo_despesa_id-editar-validacao">
                        Escolha ao menos uma conta contábil.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-3 ">
                <label for="valor" class="col-form-label">Valor</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <input type="text" class="form-control moeda" name="valor" id="valor-editar">
                    <div class="invalid-feedback" id="valor-editar-validacao">
                        o valor é um campo necessário.
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <label for="historico" class="col-form-label">Histórico</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-list"></i></span>
                    </div>
                    <input type="text" class="form-control text-uppercase" name="historico" id="historico-editar">
                    <div class="invalid-feedback" id="historico-editar-validacao">
                        O histórico é um campo necessário.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="empresa_id" value="{{session()->get('empresaAtual')}}">
    @method('PUT')
@endsection
<!-- End Modal Editar-->

<!-- Modal Excluir-->
@section('titleModalExcluir')
    Excluir Despesa?
@endsection
@section('bodyModalExcluir')
    @csrf
    Tem certeza que deseja escluir a despesa do dia:
    <span id="bodyModalExcluir"></span>
    @method('DELETE')
@endsection
<!-- End Modal Excluir-->

@section('script')
    <script>

        // preenche os campos do modal editar
        function preencheEditar(id){
            const data_cadastro = document.querySelector(`#input-data_cadastro-${id}`).value;
            const tipo_despesa_id = document.querySelector(`#input-tipo_despesa_id-${id}`).value;
            const valor = document.querySelector(`#input-valor-${id}`).value;
            const historico = document.querySelector(`#input-historico-${id}`).value;


            document.querySelector('#data_cadastro-editar').value = data_cadastro;
            document.querySelector('#tipo_despesa_id-editar-hidden').value = tipo_despesa_id;
            //document.querySelector('#tipo_despesa_id-editar').value = tipo_despesa_id;
            document.querySelector('#valor-editar').value = valor;
            document.querySelector('#historico-editar').value = historico;

            retornaTiposDespesas('editar');
            document.querySelector('#formModalEditar').setAttribute("action", `/despesas/${id}`);

            $("#modalEditar").modal("show");
        }



        //confirmaexclusao de usuario
        function confirmarExcluir(id){
            const data = document.querySelector(`#input-data_cadastro-${id}`).value;

            document.querySelector("#bodyModalExcluir").textContent = data;
            document.querySelector('#formModalExcluir').setAttribute("action", `despesas/${id}`);

            $("#modalExcluir").modal("show");

        }

        function retornaTiposDespesas(origem){

            elementSelect = document.querySelector(`#tipo_despesa_id-${origem}`);
            elementSelect.innerHTML = '';
            criaOption(`#tipo_despesa_id-${origem}`,'','Carregando...');

            fetch('/tipo-despesas/retorna-tipo-despesas', {
                method: 'GET'
            })
                .then(response => response.json())
                .then(tipoDespesas => {
                    elementSelect.innerHTML = '';
                    tipoDespesas.map((tipoDespesa)=>{
                        //console.log(tipoDespesa['plano_conta'].conta_contabil);
                        criaOption(`#tipo_despesa_id-${origem}`,tipoDespesa.id,`${tipoDespesa['plano_conta'].conta_contabil} - ${tipoDespesa.descricao}`);
                    });
                }).then(()=>{
                    if(origem === 'adicionar' ){
                        var tipoDespesa = document.querySelector(`#tipo_despesa_id-${origem}>option`).value
                        document.querySelector(`#tipo_despesa_id-${origem}`).value = tipoDespesa;
                        return;
                    }
                    var tipoDespesa = document.querySelector("#tipo_despesa_id-editar-hidden").value;
                    document.querySelector(`#tipo_despesa_id-${origem}`).value = tipoDespesa;
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
            const dataElement = document.querySelector(`#data_cadastro-${form}`);
            const tipoDespesaElement = document.querySelector(`#tipo_despesa_id-${form}`);
            const valorElement = document.querySelector(`#valor-${form}`);
            const historicoElement = document.querySelector(`#historico-${form}`);

            var retorno = true;

            if(!validaData(dataElement)){
                dataElement.classList.add('is-invalid');
                retorno = validaData(dataElement);
            }

            if(tipoDespesaElement.value === ""){
                tipoDespesaElement.classList.add('is-invalid');
                retorno = false;
            }

            if(!validaMoeda(valorElement)){
                valorElement.classList.add('is-invalid');
                retorno = validaMoeda(valorElement);
            }

            if(historicoElement.value === ""){
                historicoElement.classList.add('is-invalid');
                retorno = false;
            }

            return retorno;
        }

        function validaMoeda(id){
            var RegExPattern = /^([1-9]{1}[\d]{0,2}(\.[\d]{3})*(\,[\d]{0,2})?|[1-9]{1}[\d]{0,}(\,[\d]{0,2})?|0(\,[\d]{0,2})?|(\,[\d]{1,2})?)$/;
            if (!((id.value.match(RegExPattern)) && (id.value !== ''))) {
                return false;
            }
            return true;
        }

        function validaData(id) {
            var RegExPattern = /^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/;

            if (!((id.value.match(RegExPattern)) && (id.value !==''))) {
                return false;
            }
            return true;
        }

        document.querySelector('#btn-top-adicionar').addEventListener("click", function(){
            retornaTiposDespesas('adicionar');
        });

        document.querySelector('#btn-pesquisar-intervalo').addEventListener("click", function(){
            loader(true);
        });



        window.onload = function() {
            //exibe botões pertinentes a esta tela
            document.querySelector("#form-intervalo-datas").classList.remove('d-none');
            document.querySelector("#btn-top-excel").classList.remove('d-none');

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
