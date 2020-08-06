@extends('layout')

@section('conteudo')
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-9 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-9    ">
                            <div class="p-5">
                                <div class="text-center">
                                    <span class="sidebar-brand d-flex align-items-center justify-content-center mb-5">
                                        <div class="sidebar-brand-icon">
                                            <img src="{{ asset('img/sistema/logo-aprocont-64.png') }}" alt="Logo">
                                            <h1>Aprocont</h1>
                                        </div>
                                    </span>

                                </div>
                                <form class="user" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" aria-describedby="email" name="email" placeholder="Entrar com usuário" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Senha" min="6" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Entrar
                                    </button>
                                    <div class="text-center">
                                        <a class="small" href="/registrar">Registrar-se</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
