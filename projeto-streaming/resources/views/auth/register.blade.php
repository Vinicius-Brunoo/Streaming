@extends('layouts.app')

@section('title', 'Cadastro | Streaming Music')

@section('content')
    <section class="auth-shell">
        <div class="auth-copy">
            <span class="eyebrow">Novo usuario</span>
            <h1>Crie uma conta de administrador</h1>
            <p>Use esta conta para liberar as telas de cadastro, edicao e exclusao do CRUD.</p>
        </div>

        <form action="{{ route('register.store') }}" method="POST" class="app-form auth-form">
            @csrf
            <label class="form-label" for="name">Nome</label>
            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" required autofocus maxlength="120">

            <label class="form-label" for="email">E-mail</label>
            <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required maxlength="150">

            <label class="form-label" for="password">Senha</label>
            <input class="form-control" type="password" id="password" name="password" required minlength="6">

            <label class="form-label" for="password_confirmation">Confirmar senha</label>
            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required minlength="6">

            <button class="btn btn-accent w-100 mt-4" type="submit">Criar conta</button>
            <p class="auth-link">Ja tem conta? <a href="{{ route('login') }}">Entrar</a>.</p>
        </form>
    </section>
@endsection
