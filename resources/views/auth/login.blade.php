@extends('layouts.app')

@section('title', 'Entrar | Streaming Music')

@section('content')
    <section class="auth-shell">
        <div class="auth-copy">
            <span class="eyebrow">Area administrativa</span>
            <h1>Entre para gerenciar o streaming</h1>
            <p>Visitantes podem listar e consultar dados. Inserir, alterar e excluir exige autenticacao, como pedido na atividade.</p>
        </div>

        <form action="{{ route('login.store') }}" method="POST" class="app-form auth-form">
            @csrf
            <label class="form-label" for="email">E-mail</label>
            <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

            <label class="form-label" for="password">Senha</label>
            <input class="form-control" type="password" id="password" name="password" required>

            <label class="form-check mt-3">
                <input class="form-check-input" type="checkbox" name="remember" value="1">
                <span class="form-check-label">Lembrar acesso</span>
            </label>

            <button class="btn btn-accent w-100 mt-4" type="submit">Entrar</button>
            <p class="auth-link">Ainda nao tem conta? <a href="{{ route('register') }}">Cadastre-se</a>.</p>
        </form>
    </section>
@endsection
