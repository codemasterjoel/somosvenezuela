<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles -->
        <style>
            @import url(https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap);

            body {
                background: #f5f5f5;
            }

            @media only screen and (max-width: 767px) {
                .hide-on-mobile {
                    display: none;
                }
            }

            .login-box {
                /* background: url({{ asset('img/fondo.png') }}); */
                /* background-size: cover;
                background-position: center; */
                padding: 50px;
                margin: 50px auto;
                min-height: 700px;
                -webkit-box-shadow: 0 2px 60px -5px rgba(0, 0, 0, 0.1);
                box-shadow: 0 2px 60px -5px rgba(0, 0, 0, 0.1);
            }

            .logo {
                font-family: "Script MT";
                font-size: 54px;
                text-align: center;
                color: #888888;
                margin-bottom: 50px;
            }

            .logo .logo-font {
                color: #ffffff;
            }

            @media only screen and (max-width: 767px) {
                .logo {
                    font-size: 34px;
                }
            }

            .header-title {
                text-align: center;
                margin-bottom: 50px;
            }

            .login-form {
                max-width: 300px;
                margin: 0 auto;
            }

            .login-form .form-control {
                border-radius: 0;
                margin-bottom: 30px;
            }

            .login-form .form-group {
                position: relative;
            }

            .login-form .form-group .forgot-password {
                position: absolute;
                top: 6px;
                right: 15px;
            }

            .login-form .btn {
                border-radius: 0;
                -webkit-box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                margin-bottom: 30px;
            }

            .login-form .btn.btn-primary {
                background: #3BC3FF;
                border-color: #31c0ff;
            }

            .slider-feature-card {
                background: #fff;
                max-width: 280px;
                margin: 0 auto;
                padding: 30px;
                text-align: center;
                -webkit-box-shadow: 0 2px 25px -3px rgba(0, 0, 0, 0.1);
                box-shadow: 0 2px 25px -3px rgba(0, 0, 0, 0.1);
            }

            .slider-feature-card img {
                height: 80px;
                margin-top: 30px;
                margin-bottom: 30px;
            }

            .slider-feature-card h3,
            .slider-feature-card p {
                margin-bottom: 30px;
            }

            .carousel-indicators {
                bottom: -50px;
            }

            .carousel-indicators li {
                cursor: pointer;
            }

            .gradient-custom {
                /* fallback for old browsers */
                background: #001580;
            
                /* Chrome 10-25, Safari 5.1-6 */
                background: -webkit-linear-gradient(to right, rgba(0,21,128,1), rgba(37,117,252,1));
            
                /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                background: linear-gradient(to right, rgba(0,21,128,1), rgba(37,117,252,1))
            }
        </style>
    </head>
    <body class="">
        <section class="body">
            <div class="container">
                <div class="login-box gradient-custom">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <img src="{{ asset('img/logo.png') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <br>
                            <div class="logo">
                                <span class="logo-font">Bienvenidos</span>
                            </div>
                            <x-auth-session-status class="text-center" :status="session('status')" />
                            <form class="login-form" wire:submit="login">
                                <div class="">
                                    {{-- <input type="text" class="form-control" placeholder="Correo"> --}}
                                    <flux:input wire:model="email" type="email" required autofocus autocomplete="email" placeholder="email@example.com"/>
                                </div>
                                <div class="relative mt-4">
                                    <flux:input
                                        wire:model="password"
                                        type="password"
                                        required
                                        autocomplete="current-password"
                                        :placeholder="__('Password')"
                                    />
                                </div>
                                <div class="form-group mt-4">
                                    <input type="submit" value="Ingresar" class="btn btn-danger btn-block">
                                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Log in') }}</flux:button>
                                    {{-- <button class="btn btn-danger btn-block">Ingresar</button> --}}
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6 hide-on-mobile">
                            <div id="demo" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ul class="carousel-indicators">
                                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo" data-slide-to="1"></li>
                                </ul>
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="slider-feature-card">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="{{ asset('img/boton_registro.png') }}" alt=""></a>
                                            {{-- <button type="button" class="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="{{ asset('img/REGISTRO-01.png') }}" alt=""></button> --}}
                                            <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><h3 class="slider-title">Registrate Aqui</h3></a>
                                            <p class="slider-description">Registro de Militantes del Movimiento Somos Venezuela.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="slider-feature-card">
                                            <img src="https://i.imgur.com/Yi5KXKM.png" alt="">
                                            <h3 class="slider-title">Title Here</h3>
                                            <p class="slider-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, debitis?</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> --}}

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
        </div>
        </div>
    </div>
    </div>

</html>
