@extends('layouts.app')

@section('content')
    <div class="container-scroller">
        <div class="page-body-wrapper full-page-wrapper auth-page">
            <div class="w-100 d-flex align-items-center auth auth-bg-1 theme-one">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auto-form-wrapper">
                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="label">Correo</label>
                                    <div class="input-group">
                                        <input id="email" placeholder="nombre@domain.com" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-account"></i>
                      </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">Contraseña</label>
                                    <div class="input-group">
                                        <input id="password" placeholder="************" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-lock-outline"></i>
                      </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary submit-btn btn-block">Login</button>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember"
                                               name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                               for="remember">{{ __('Recordarme') }}</label>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-12 text-center">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Olvidaste tu contraseña?') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="text-block text-center my-3">
                                    <span class="text-small font-weight-semibold">No tienes cuenta ?</span>
                                    <a href="{{route('register')}}" class="text-black text-small">Registrate
                                        aquí</a>
                                </div>
                            </form>
                        </div>
                        <ul class="auth-footer">
                            <li>
                                <a href="#!">Condiciones</a>
                            </li>
                            <li>
                                <a href="#!">Ayuda</a>
                            </li>
                            <li>
                                <a href="#!">Terminos</a>
                            </li>
                        </ul>
                        <p class="footer-text text-center">copyright © {{date('Y')}} todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
