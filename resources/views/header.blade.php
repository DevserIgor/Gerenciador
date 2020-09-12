<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Painel de Controle Aprocont</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/template_bootstrap.css') }}" rel="stylesheet">

    @if($tableLayout ?? '')
        <!-- Custom table template-->
        <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    @endif

    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">

</head>

<body id="page-top">
    <div id="preloader">
        <div id="preloader__status">

            <!-- Animation -->
            <div class="preloader__group">
                <div class="preloader__big-square">
                    <div class="preloader__square first"></div>
                    <div class="preloader__square second"></div>
                    <div class="preloader__square third"></div>
                    <div class="preloader__square fourth"></div>
                </div>
                <div class="preloader__text">Carregando</div>
            </div>
            <!-- /Animation -->

        </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">
