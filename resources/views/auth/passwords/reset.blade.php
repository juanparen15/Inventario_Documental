@extends('layouts.app')
@section('title', 'Restablecer Contraseña')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('welcome') }}">
                <b>Inventario Documental</b>
                <script type="text/javascript">
                    document.write(new Date().getFullYear());
                </script>
            </a>
        </div>
        <!-- /.login-logo -->
        
        <div class="card card-outline card-primary">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Restablecer Contraseña</p>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                            placeholder="Correo electrónico">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" placeholder="Nueva Contraseña">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Confirmar Contraseña">
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Restablecer Contraseña</button>
                        </div>
                    </div>
                </form>

                <p class="mt-3 mb-1 text-center">
                    <a href="{{ route('login') }}">Iniciar sesión</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
