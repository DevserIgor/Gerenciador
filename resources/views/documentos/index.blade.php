@extends('table')
<!-- Page Heading -->
@section('titulo-page')
    Documentos
@endsection
<!-- Page Heading -->

<!-- Rota de download de excel -->
@section('rota-download-doc')
    /documentos/download-doc
@endsection

<!-- intervalo datas -->
@section('action-intervalo-table')
    /documentos/seta-intervalo-table
@endsection
@section('data-inicio')
    {{ date('d/m/Y',session()->get('tableDataInicio')) }}
@endsection
@section('data-fim')
    {{ date('d/m/Y',session()->get('tableDataFim')) }}
@endsection

<!-- DataTales Example -->
@section('largura-table')
    col-md-8
@endsection
@section('titulo-table')
    Documentos
@endsection
@section('thead')
    <th scope="col" width="20%">Data</th>
    <th scope="col" width="50%">Descrição</th>
    <th scope="col" width="30%" class="text-right">Opções</th>
@endsection
@section('tfooter')
    <th>Data</th>
    <th>Descrição</th>
    <th class="text-right">Opções</th>
@endsection
@section('tbody')
    @foreach($documentos as $documento)
        <tr>
            <td>{{ date('d/m/Y', strtotime($documento->data_cadastro) ) }}
                <input type="hidden"
                       value="{{ date('d/m/Y', strtotime($documento->data_cadastro) ) }}"
                       id="input-data_cadastro-{{ $documento->id }}"
                >
            </td>

            <td><a href="/storage/{{ $documento->documento }}">{{ strtoupper($documento->descricao) }}</a>
                <input type="hidden"
                       value="{{ $documento->id }}"
                       id="input-nome-{{ $documento->id }}"
                >
                <input type="hidden"
                       value="{{ $documento->descricao }}"
                       id="input-descricao-{{ $documento->id }}"
                >
            </td>
            <td>
                <div class="d-sm-flex justify-content-end ">
                    <span>
                        <button class="btn btn-danger btn-sm text-white" onclick="confirmarExcluir({{ $documento->id }})">
                        <i class="fas fa-trash-alt fa-sm fa-fw mr-2 text-white-400"></i>
                        Excluir
                    </button>
                    </span>

                </div>
            </td>
        </tr>
    @endforeach
@endsection

<!-- Modal Adicionar-->
@section('titleModalAdicionar')
    Adicionar Documento
@endsection

@section('bodyModalAdicionar')
    @section('upload-form-adicionar')
        enctype="multipart/form-data"
    @endsection
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col">
                <label for="documento" class="col-form-label">Documento</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-file-alt"></i></span>
                    </div>
                    <input type="file" class="form-control text-uppercase" name="documento" id="documento-adicionar">
                    <div class="invalid-feedback" id="documento-adicionar-validacao">
                        Você precisa selecionar ao menos um documento.
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label for="descricao" class="col-form-label">Descrição</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-list"></i></span>
                    </div>
                    <input type="text" class="form-control text-uppercase" name="descricao" id="descricao-adicionar">
                    <div class="invalid-feedback" id="descricao-adicionar-validacao">
                        A descrição é um campo necessário.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="data_cadastro" value="">
    <input type="hidden" name="empresa_id" value="{{session()->get('empresaAtual')}}">
@endsection
<!-- End Modal Adicionar-->

<!-- Modal Excluir-->
@section('titleModalExcluir')
    Excluir Documento?
@endsection
@section('bodyModalExcluir')
    @csrf
    Tem certeza que deseja escluir o documento:
    <span id="bodyModalExcluir"></span>
    @method('DELETE')
@endsection
<!-- End Modal Excluir-->

@section('script')
    <script>

        // preenche os campos do modal editar
        function preencheEditar(id){
            const data_cadastro = document.querySelector(`#input-data_cadastro-${id}`).value;
            const nome = document.querySelector(`#input-nome-${id}`).value;
            const descricao = document.querySelector(`#input-descricao-${id}`).value;


            document.querySelector('#data_cadastro-editar').value = data_cadastro;
            document.querySelector('#nome-editar').value = nome;
            document.querySelector('#descricao-editar').value = descricao;

            document.querySelector('#formModalEditar').setAttribute("action", `/documentos/${id}`);

            $("#modalEditar").modal("show");
        }



        //confirmaexclusao de usuario
        function confirmarExcluir(id){
            const data = document.querySelector(`#input-data_cadastro-${id}`).value;
            const descricao = document.querySelector(`#input-descricao-${id}`).value;

            document.querySelector("#bodyModalExcluir").textContent = data+' '+descricao;
            document.querySelector('#formModalExcluir').setAttribute("action", `documentos/${id}`);

            $("#modalExcluir").modal("show");

        }

        function validaform(form){
            const documentoElement = document.querySelector(`#documento-${form}`);
            const descricaoElement = document.querySelector(`#descricao-${form}`);

            var retorno = true;

            if(documentoElement.value === ""){
                documentoElement.classList.add('is-invalid');
                retorno = false;
            }

            if(descricaoElement.value === ""){
                descricaoElement.classList.add('is-invalid');
                retorno = false;
            }

            return retorno;
        }

        function validaData(id) {
            var RegExPattern = /^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/;

            if (!((id.value.match(RegExPattern)) && (id.value !==''))) {
                return false;
            }
            return true;
        }

        document.querySelector('#btn-pesquisar-intervalo').addEventListener("click", function(){
            loader(true);
        });



        window.onload = function() {
            //exibe botões pertinentes a esta tela
            document.querySelector("#form-intervalo-datas").classList.remove('d-none');
            //document.querySelector("#btn-top-download").classList.remove('d-none');

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
