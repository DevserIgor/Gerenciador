@extends('table')
<!-- Page Heading -->
@section('titulo-page')
    Usuários
@endsection
<!-- Page Heading -->

<!-- DataTales Example -->
@section('largura-table')
    col-md-10
@endsection
@section('titulo-table')
    Usuários
@endsection
@section('thead')
    <th scope="col" width="20%">Nome</th>
    <th scope="col" width="25%">Email</th>
    <th scope="col" width="10%">Tipo</th>
    <th scope="col" width="30%">Empresa</th>
    <th scope="col" width="15%" class="text-right">Opções</th>
@endsection
@section('tfooter')
    <th>Nome</th>
    <th>Email</th>
    <th>Tipo</th>
    <th>Empresa</th>
    <th class="text-right">Opções</th>
@endsection
@section('tbody')
    @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->name }} <input type="hidden" nome="name" value="{{ $usuario->name }}" id="input-nome-{{ $usuario->id }}"></td>
            <td>{{ $usuario->email }} <input type="hidden" nome="email" value="{{ $usuario->email }}" id="input-email-{{ $usuario->id }}"></td>
            <td>
                @if($usuario->tipo === 'admin')
                    Admin
                @endif
                @if($usuario->tipo === 'fun')
                        Funcionário
                @endif
                @if($usuario->tipo === 'user')
                        Usuário(cliente)
                @endif
                <input type="hidden" nome="tipo" value="{{ $usuario->tipo }}" id="input-tipo-{{ $usuario->id }}">
            </td>
            <td>
                @if($usuario->empresa && $usuario->tipo === 'user')
                    {{ $usuario->empresa->nome }}
                    <input type="hidden" nome="empresa" value="{{ $usuario->empresa->id }}" id="select-empresa-{{ $usuario->id }}">
                @elseif ($usuario->tipo === 'fun')
                    <a href="usuarios/{{ $usuario->id }}/empresas"><i class="fas fa-external-link-alt"></i>&nbsp;&nbsp;Ver empresas</a>
                @else
                    Permissão Total
                @endif
            </td>
            <td>
                <div class="d-sm-flex justify-content-end ">

                    <div class="btn-group dropleft dropdown ">
                        <a class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm dropdown-toggle no-arrow" id="opcoesUsuario" href="#" aria-haspopup="true" aria-expanded="false" role="button" data-toggle="dropdown">
                            <i class="far fa-edit fa-sm mr-2"></i>Opções
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu shadow" aria-labelledby="opcoesEmpresa">
                            <button class="dropdown-item" onclick="preencheEditarUsuario({{ $usuario->id }})">
                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>

                                Editar
                            </button>
                            <button class="dropdown-item" onclick="confirmarExcluirUsuario({{ $usuario->id }})">
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
    Adicionar Usuário
@endsection

@section('bodyModalAdicionar')
    @csrf
    <div class="form-group">
        <label for="nome" class="col-form-label">Nome</label>
        <input type="text" class="form-control" name="name" id="nome-adicionar" required >
        <div class="invalid-feedback" id="nome-adicionar-validacao">
            O nome deve conter no mínimo três caracteres.
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-form-label">E-mail</label>
        <input type="e-mail" class="form-control" name="email" id="email-adicionar" required >
        <div class="invalid-feedback" id="email-adicionar-validacao">
            O e-mail deve ser um válido.
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col">
                <label for="senha" class="col-form-label">Senha</label>
                <input  type="password" class="form-control senha-validacao-adicionar" name="password" id="password-adicionar" required onkeyup="confirmaSenha('adicionar');" >
                <div class="invalid-feedback" id="password-adicionar-validacao-invalid" >
                    Senhas diferentes.
                </div>
                <div class="valid-feedback"  id="password-adicionar-validacao-invalid">
                    Senhas conferem.
                </div>
            </div>
            <div class="col">
                <label for="senha-confirma" class="col-form-label">Confirmar senha</label>
                <input  type="password" class="form-control senha-validacao-adicionar" id="password-adicionar-confirma" required onkeyup="confirmaSenha('adicionar');" >
                <div class="invalid-feedback" id="password-confirmacao-adicionar-validacao-invalid">
                    Senhas diferentes.
                </div>
                <div class="valid-feedback" id="password-confirmacao-adicionar-validacao-invalid">
                    Senhas conferem.
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="tipo-adicionar">Tipos</label>
            </div>
            <select class="custom-select" name="tipo" id="tipo-adicionar" required onchange="verificaTipoUser(this.value, 'adicionar');">
                <option value="admin">Admin</option>
                <option value="fun">Funcionário</option>
                <option value="user">Usuário</option>
            </select>
            <div class="invalid-feedback" id="tipo-adicionar-validacao">
                Escolha ao menos um tipo de usuário
            </div>
        </div>
    </div>
    <div class="form-group d-none" id="formGroupEmpresa-adicionar">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="empresa-adicionar">Empresa</label>
            </div>
            <select class="custom-select" name="empresa_id" id="empresa-adicionar" required disabled></select>
            <div class="invalid-feedback" id="nome-adicionar-validacao">
                Escolha ao menos uma empresa.
            </div>
        </div>
    </div>
@endsection
<!-- End Modal Adicionar-->

<!-- Modal Editar-->
@section('titleModalEditar')
    Editar Usuário
@endsection
@section('bodyModalEditar')
    @csrf
    <div class="form-group">
        <label for="nome" class="col-form-label">Nome</label>
        <input type="text" class="form-control" name="name" id="nome-editar" required >
        <div class="invalid-feedback" id="nome-editar-validacao">
            Por favor, escolha um nome de usuário.
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-form-label">E-mail</label>
        <input type="e-mail" class="form-control" name="email" id="email-editar" required >
        <div class="invalid-feedback" id="email-editar-validacao">
            O e-mail deve ser um válido.
        </div>
    </div>


    <div class="form-group">
        <div class="row">
            <div class="col">
                <label for="senha" class="col-form-label">Senha</label>
                <input  type="password" class="form-control senha-validacao-editar" name="password" id="password-editar"  onkeyup="confirmaSenha('editar');" placeholder="******" >
                <div class="invalid-feedback" id="password-editar-validacao-invalid" >
                    Senhas diferentes.
                </div>
                <div class="valid-feedback" id="password-editar-validacao-valid" >
                    Senhas conferem.
                </div>
            </div>

            <div class="col">
                <label for="senha-confirma" class="col-form-label">Confirmar senha</label>
                <input  type="password" class="form-control senha-validacao-editar" id="password-editar-confirma"  onkeyup="confirmaSenha('editar');" placeholder="******" >
                <div class="invalid-feedback" id="password-confirmacao-editar-validacao-invalid" >
                    Senhas diferentes.
                </div>
                <div class="valid-feedback" id="password-confirmacao-editar-validacao-valid" >
                    Senhas conferem.
                </div>
            </div>
            <small class="px-3 pt-3">Obs: para manter a senha atual do usuário, apenas deixe o campo 'Senha' em branco.</small>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="tipo-editar">Tipos</label>
            </div>
            <select class="custom-select" name="tipo" id="tipo-editar" required onchange="verificaTipoUser(this.value, 'editar');">
                <option value="admin">Admin</option>
                <option value="fun">Funcionário</option>
                <option value="user">Usuário</option>
            </select>
            <div class="invalid-feedback" id="tipo-editar-validacao">
                Escolha ao menos um tipo de usuário
            </div>
        </div>
    </div>
    <div class="form-group d-none" id="formGroupEmpresa-editar">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="empresa-editar">Empresa</label>
            </div>
            <input type="hidden" disabled value="" id="empresa-editar-hidden">
            <select class="custom-select" name="empresa_id" id="empresa-editar" required disabled></select>
            <div class="invalid-feedback" id="nome-editar-validacao">
                Escolha ao menos uma empresa.
            </div>
        </div>
    </div>
    @method('PUT')
@endsection
<!-- End Modal Editar-->

<!-- Modal Excluir-->
@section('titleModalExcluir')
    Excluir Usuário?
@endsection
@section('bodyModalExcluir')
    @csrf
    Tem certeza que deseja escluir o usuario:<br>
    <span id="bodyModalExcluir"></span>
    @method('DELETE')
@endsection
<!-- End Modal Excluir-->

@section('script')
    <script>

        // preenche os campos do modal editar
        function preencheEditarUsuario(usuarioId){
            const nome = document.querySelector(`#input-nome-${usuarioId}`).value;
            const email = document.querySelector(`#input-email-${usuarioId}`).value;
            const tipo = document.querySelector(`#input-tipo-${usuarioId}`).value;
            let empresa = '';
            if(document.querySelector(`#select-empresa-${usuarioId}`)){
                empresa = document.querySelector(`#select-empresa-${usuarioId}`).value;
            }
            document.querySelector('#empresa-editar-hidden').value = empresa;

            document.querySelector('#nome-editar').value = nome;
            document.querySelector('#email-editar').value = email;
            document.querySelector('#tipo-editar').value = tipo;

            //preenhe as empresas no combo
            verificaTipoUser(tipo, 'editar')

            document.querySelector('#formModalEditar').setAttribute("action", `/usuarios/${usuarioId}`);
            // input-userId-empresa-editar
            $("#modalEditar").modal("show");
        }

        function confirmaSenha(acao){
            // const passValid = document.queryString(`#password-${acao}-validacao-valid`);
            // const passValidConfirm = document.queryString(`#password-confirmacao-${acao}-validacao-valid`);
            //
            // const passInvalid = document.queryString(`#password-${acao}-validacao-invalid`);
            // const passInvalidConfirm = document.queryString(`#password-confirmacao-${acao}-validacao-invalid`);

            const elements = document.querySelectorAll(`.senha-validacao-${acao}`);
            const senha = elements[0];
            const confirmacao = elements[1];
            //valida se algum deles está vazio, então não compara nada

            if(!senha.value || !confirmacao.value){
                elements.forEach((element)=>{
                    element.classList.remove('is-invalid');
                    element.classList.remove('is-valid');
                });
                return;
            }
            //se eles são iguais faz a validacao

            if(senha.value !== confirmacao.value){
                elements.forEach((element)=>{
                    element.classList.remove('is-valid');
                    // Senhas conferem.
                    element.classList.add('is-invalid');
                    // Senhas diferentes.

                });
            }else{
                elements.forEach((element)=>{
                    element.classList.remove('is-invalid');
                    element.classList.add('is-valid');
                });
            }
        }

        //confirmaexclusao de usuario
        function confirmarExcluirUsuario(usuarioId){
            const nome = document.querySelector(`#input-nome-${usuarioId}`).value;

            document.querySelector("#bodyModalExcluir").textContent = nome;
            document.querySelector('#formModalExcluir').setAttribute("action", `usuarios/${usuarioId}`);

            $("#modalExcluir").modal("show");

        }

        //verifica se é do tipo user para exibir a empresa á qual adicionar
        function verificaTipoUser(user, origem){
            if(user !== 'user' ){
                document.querySelector(`#formGroupEmpresa-${origem}`).classList.add('d-none');
                document.querySelector(`#formGroupEmpresa-${origem}`).value = "";
                document.querySelector(`#empresa-${origem}`).disabled = true;
                return;
            }
            document.querySelector(`#empresa-${origem}`).disabled = false;
            document.querySelector(`#formGroupEmpresa-${origem}`).classList.remove('d-none');
            retornaEmpresas(user, origem);
        }

        function retornaEmpresas(usuario, origem){
            if(usuario !== 'user'){
                return;
            }

            elementSelect = document.querySelector(`#empresa-${origem}`);
            elementSelect.innerHTML = '';
            criaOption(`#empresa-${origem}`,'','Carregando...');

            fetch('/empresas/retorna-empresas', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(empresas => {
                elementSelect.innerHTML = '';
                empresas.map((empresa)=>{
                    criaOption(`#empresa-${origem}`,empresa.id,`${empresa.nro_empresa} - ${empresa.nome}`);
                });
            }).then(()=>{
                let empresa = document.querySelector('#empresa-editar-hidden').value;
                document.querySelector('#empresa-editar').value = empresa;
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
            const nomeElement = document.querySelector(`#nome-${form}`);
            // const nomeValidacao = document.querySelector(`#nome-${form}-validacao`);
            const emailElement = document.querySelector(`#email-${form}`);
            // const emailValidacao = document.querySelector(`#email-${form}-validacao`);
            const passwordElement = document.querySelector(`#password-${form}`);
            const passwordConfirmaElement = document.querySelector(`#password-${form}-confirma`);
            const tipoElement = document.querySelector(`#tipo-${form}`);
            // const tipoValidacao = document.querySelector(`#tipo-${form}-validacao`);
            const empresaElement = document.querySelector(`#empresa-${form}`);
            // const empresaValidacao = document.querySelector(`#empresa-${form}-validacao`);
            var retorno = true;

            if(nomeElement.value.length < 3){
                nomeElement.classList.add('is-invalid');
                retorno = false;
            }

            if(!isEmail(emailElement.value)){
                emailElement.classList.add('is-invalid');
                retorno = false;
            }

            if( (passwordElement.value !== "" || passwordConfirmaElement.value !== "")
                && (passwordElement.value !== passwordConfirmaElement.value)
                && (passwordElement.value.length < 6)){

                passwordElement.classList.add('is-invalid');
                passwordConfirmaElement.classList.add('is-invalid');
                retorno = false;
            }

            if (tipoElement.value === ""){
                tipoElement.classList.add('is-invalid');
                retorno = false;
            }

            if (empresaElement.value === "" && tipoElement.value === "user"){
                empresaElement.classList.add('is-invalid');
                retorno = false;
            }

            return retorno;
        }

        function isEmail(email){
            var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            return reg.test(email);
        }

        window.onload = function() {
            //adiciona submit no formulario de edicao para validações
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
