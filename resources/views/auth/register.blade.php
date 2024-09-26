@extends('layouts.login')
@section('title','Registro')
{{-- @section('content')
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
                <p class="login-box-msg">Registrarte</p>

                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="name" name="name" value="{{ old('name') }}" type="text"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" required
                            autocomplete="name" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Correo electrónico" required
                            autocomplete="email">
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
                        <input id="password" type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" required
                            autocomplete="new-password">
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

                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control"
                            placeholder="Confirmar contraseña" name="password_confirmation" required
                            autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                <label for="agreeTerms">
                                    Acepto los <a href="#">términos</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="mt-3 mb-1 text-center">
                    <a href="{{ route('login') }}">Ya tengo una cuenta</a>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection --}}