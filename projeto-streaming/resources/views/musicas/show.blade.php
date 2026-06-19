@extends('layouts.app')

@section('title', $musica->titulo.' | Streaming Music')

@section('content')
    <section class="detail-grid">
        <div class="detail-cover">
            @if ($musica->capa)
                <img src="{{ asset('storage/'.$musica->capa) }}" alt="Capa de {{ $musica->titulo }}">
            @else
                <span class="cover-placeholder cover-placeholder-lg"><i class="bi bi-vinyl"></i></span>
            @endif
        </div>

        <div class="detail-panel">
            <span class="tag">{{ $musica->genero }}</span>
            <h1>{{ $musica->titulo }}</h1>
            <p class="lead">{{ $musica->artista }} - {{ $musica->album }}</p>

            <dl class="info-list">
                <div>
                    <dt>Duracao</dt>
                    <dd>{{ $musica->duracao }}</dd>
                </div>
                <div>
                    <dt>Playlists relacionadas</dt>
                    <dd>{{ $musica->playlists->count() }}</dd>
                </div>
                <div>
                    <dt>Cadastrada em</dt>
                    <dd>{{ $musica->created_at->format('d/m/Y H:i') }}</dd>
                </div>
            </dl>

            <div class="actions-row">
                <a class="btn btn-outline-light" href="{{ route('musicas.index') }}">Voltar</a>
                @auth
                    <a class="btn btn-soft" href="{{ route('musicas.edit', $musica) }}">Editar</a>
                    <form action="{{ route('musicas.destroy', $musica) }}" method="POST" onsubmit="return confirm('Excluir esta musica? As playlists relacionadas tambem serao removidas.');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger-subtle" type="submit">Excluir</button>
                    </form>
                @endauth
            </div>
        </div>
    </section>

    <section class="content-block">
        <div class="section-heading compact">
            <span class="eyebrow">Relacionamento</span>
            <h2>Playlists com esta musica</h2>
        </div>

        @if ($musica->playlists->isEmpty())
            <p class="muted-text">Nenhuma playlist usa esta musica ainda.</p>
        @else
            <div class="list-group app-list">
                @foreach ($musica->playlists as $playlist)
                    <a class="list-group-item list-group-item-action" href="{{ route('playlists.show', $playlist) }}">
                        <span>{{ $playlist->nome_playlist }}</span>
                        <small>{{ $playlist->data_criacao->format('d/m/Y') }}</small>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection
