@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 text-center">
                <h1>Bem-vindo ao Laravel!</h1>
                <p class="lead mt-3">Este é um exemplo de página utilizando o layout <code>app.blade.php</code>.</p>

                @guest
                    <p class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">Registrar</a>
                    </p>
                @else
                    <p class="mt-4">Você está logado como <strong>{{ Auth::user()->name }}</strong>.</p>
                    <a href="{{ route('home') }}" class="btn btn-success">Ir para o Dashboard</a>
                @endguest
            </div>
        </div>
    </div>
@endsection
