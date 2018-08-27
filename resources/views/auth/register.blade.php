@extends('layouts.app')

@section('content')
    <div class="container-scroller">
        <div class="page-body-wrapper full-page-wrapper auth-page">
            <div class="w-100 d-flex align-items-center auth register-bg-1 theme-one">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auto-form-wrapper">
                            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                @csrf
                                <div class="form-group">
                                    <h5 class="text-center">Datos personales</h5>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="nombre" type="text" placeholder="Ingrese sus nombres"
                                               class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}"
                                               name="nombre" value="{{ old('nombre') }}" required autofocus>
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                        @if ($errors->has('nombre'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="apellido" type="text" placeholder="Ingrese sus apellidos"
                                               class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}"
                                               name="apellido" value="{{ old('apellido') }}" required>
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                        @if ($errors->has('apellido'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="celular" type="number" placeholder="Ingrese su # de celular"
                                               class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}"
                                               name="celular" value="{{ old('celular') }}" required>
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                        @if ($errors->has('celular'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('celular') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="email" type="email" placeholder="Ingrese su correo"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}" required>
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="password" type="password" placeholder="Ingrese una contraseña"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" required>
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="password-confirm" type="password" class="form-control"
                                               placeholder="Confirmar contraseña"
                                               name="password_confirmation" required>
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <h5 class="text-center">Datos de la institución</h5>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="nombre" type="password" class="form-control"
                                               placeholder="Nombre de la institución"
                                               name="nombre" required>
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="nit" type="password" class="form-control"
                                               placeholder="Nit de la institución"
                                               name="nit" required>
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group d-flex justify-content-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" required name="condiciones" class="custom-control-input"
                                               id="condiciones">
                                        <label class="custom-control-label" for="condiciones">Acepto los terminos y
                                            condiciones</label>
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrarme') }}
                                    </button>
                                </div>
                                <div class="text-block text-center my-3">
                                    <span class="text-small font-weight-semibold">Ya tienes una cuenta ?</span>
                                    <a href="{{route('login')}}" class="text-black text-small">Ingresa aquí</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
