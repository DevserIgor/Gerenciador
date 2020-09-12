@extends('table')
<!-- Page Heading -->
@section('titulo-page')
    Usuáro {{ $usuario->name }}
@endsection
<!-- Page Heading -->

<!-- DataTales Example -->
@section('titulo-table')
    Permissões Empresas
@endsection
@section('thead')
    <th scope="col" width="70%">Empresas</th>
    <th scope="col" width="20%">
        <span class="d-sm-flex align-items-center justify-content-between">
            Permite
            <input type="checkbox" onclick="toggleCheckTotasEmpresas(this.checked);">
        </span>

    </th>
@endsection
@section('tfooter')
    <th>Empresas</th>
    <th>Permite</th>
@endsection

@section('tbody')
        @foreach($empresas as $empresa)
            <tr>
                <td>{{ $empresa->nome }} </td>
                <td class="d-sm-flex justify-content-end mr-3php">
                    <input
                        type="checkbox"
                        name="empresas[]"
                        value="{{ $empresa->id }}"
                        {{ $usuario->hasEmpresa($empresa->id) ? 'checked': ''  }}
                    >

                </td>
            </tr>
        @endforeach
@endsection
@csrf
@section('script')
    <script>
        document.querySelector('#btn-top-salvar').addEventListener("click", function(){
            enviaform();
        });

        function toggleCheckTotasEmpresas(marcar){
            const itens = document.querySelectorAll('input[name="empresas[]"]')
            var i = 0;
            for(i=0; i<itens.length;i++){
                itens[i].checked = marcar;
            }
        }

        function enviaform(){
            document.querySelector('#form-table').submit();
            {{--let formData = new FormData();--}}
            {{--const empresas = document.querySelectorAll('input[name="empresas[]"]');--}}
            {{--const token = document.querySelector('input[name="_token"]').value;--}}
            {{--for(var i = 0; i < empresas.length ; i++ ){--}}
            {{--    formData.append('empresas[]',empresas[i].value);--}}
            {{--}--}}
            {{--formData.append('_token', token);--}}

            {{--const url = `/usuarios/{{ $usuario->id }}/empresas`;--}}
            {{--fetch(url, {--}}
            {{--    body: formData,--}}
            {{--    method: 'POST'--}}
            {{--}).then(() =>{--}}
            {{--    window.location.href = '/usuarios/{{ $usuario->id }}/empresas';--}}
            {{--});--}}
        }
    </script>
@endsection
