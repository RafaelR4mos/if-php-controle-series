@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">

            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Entrar na Plataforma</h2>
                <h4>Tasks tracker</h4>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" required autofocus
                        value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Lembrar-me
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>

                <div class="text-center">
                    <a href="{{ route('register') }}">Ainda não tem uma conta? Cadastre-se</a>
                </div>
            </form>

        </div>
    </div>
@endsection
