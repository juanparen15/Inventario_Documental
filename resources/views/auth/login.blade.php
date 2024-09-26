@extends('layouts.login')
@section('title', 'Login Inventario')
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
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Iniciar sesión en tu cuenta</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
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
                            name="password" required autocomplete="current-password" placeholder="Contraseña">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                        </div>
                    </div>
                </form>

                @if (Route::has('password.request'))
                    <p class="mt-3 mb-1 text-center">
                        <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
                    </p>
                @endif

                {{-- <p class="mt-3 mb-1 text-center">
                    <a href="{{ route('register') }}">Crear una cuenta nueva</a>
                </p> --}}
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
