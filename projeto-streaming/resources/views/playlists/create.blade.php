@extends('layouts.app')

@section('title', 'Nova playlist | Streaming Music')

@section('content')
    <section class="form-shell">
        <div class="section-heading">
            <span class="eyebrow">Cadastro</span>
            <h1>Nova playlist</h1>
            <p>Escolha uma musica cadastrada para demonstrar o relacionamento entre as tabelas.</p>
        </div>

        <form action="{{ route('playlists.store') }}" method="POST" class="app-form">
            @csrf
            @include('playlists._form')
        </form>
    </section>
@endsection
