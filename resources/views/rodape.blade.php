
    </div>
    <!-- End Content Wrapper -->

    </div>
    <!-- End Page Wraper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "sair" para encerrar a sessão atual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="/sair">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/jquery.easing.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('js/Chart.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Date Picker plugins -->
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script src="{{ asset('js/datepicker-locale.js') }}"></script>

    <!-- Jquery Mask plugins -->
    <script src="{{ asset('js/jquery-mask.js') }}"></script>




    @if($tableLayout ?? '' )
        <!-- Page paginacao tables -->
        <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>

        <script>
            // Call the dataTables jQuery plugin
            $(document).ready(function() {
                $('#dataTable').DataTable( {
                    "language": {
                        "lengthMenu": "Ver _MENU_ linha por paginas",
                        "zeroRecords": "Lista Vazia",
                        "info": "Pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "Nenhum usuarios disponível",
                        "infoFiltered": "(Filtrado do _MAX_  registros)",
                        "paginate": {
                            "previous": "Anterior",
                            "next": "Próximo"
                        }
                    }
                } );
            });


        </script>
    @endif
    <script>
        $('.data').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
        })
        $('.data').mask('00/00/0000');
        $('.moeda').mask('#.##0,00', {reverse: true});

        window.addEventListener('load', () =>{
            loader(false);
        })

        //atualiza empresa atual
        function trocaEmpresaAtual(empresaId){
            loader(true);
            let formData = new FormData();
            const token = document.querySelector('input[name="_token"]  ').value;
            //coloca empresa atual dentro do form temporario
            formData.append('empresaId', empresaId);
            //token laravel
            formData.append('_token', token);
            // loader(true);
            fetch('/empresas/troca-empresa-atual', {
                body: formData,
                method: 'POST'
            }).then((response)=>{
                if (response.status === 200){
                    document.location.reload();
                }
            });

        }

        //exibe/esconde loader
        function loader(status){
            if(status){
                document.querySelector("#preloader").classList.remove('d-none');
                return;
            }
            document.querySelector("#preloader").classList.add('d-none');
        }
    </script>

</body>

</html>
