@extends('layouts.app')

@section('title', $playlist->nome_playlist.' | Streaming Music')

@section('content')
    <section class="detail-grid playlist-detail">
        <div class="detail-cover playlist-cover">
            @if ($playlist->musica->capa)
                <img src="{{ asset('storage/'.$playlist->musica->capa) }}" alt="Capa de {{ $playlist->musica->titulo }}">
            @else
                <span class="cover-placeholder cover-placeholder-lg"><i class="bi bi-collection-play"></i></span>
            @endif
        </div>

        <div class="detail-panel">
            <span class="status-badge status-{{ $playlist->status }}">{{ ucfirst($playlist->status) }}</span>
            <h1>{{ $playlist->nome_playlist }}</h1>
            <p class="lead">{{ $playlist->descricao ?: 'Playlist sem descricao.' }}</p>

            <dl class="info-list">
                <div>
                    <dt>Musica relacionada</dt>
                    <dd><a href="{{ route('musicas.show', $playlist->musica) }}">{{ $playlist->musica->titulo }}</a></dd>
                </div>
                <div>
                    <dt>Artista</dt>
                    <dd>{{ $playlist->musica->artista }}</dd>
                </div>
                <div>
                    <dt>Usuario</dt>
                    <dd>{{ $playlist->usuario }}</dd>
                </div>
                <div>
                    <dt>Data de criacao</dt>
                    <dd>{{ $playlist->data_criacao->format('d/m/Y') }}</dd>
                </div>
            </dl>

            <div class="actions-row">
                <a class="btn btn-outline-light" href="{{ route('playlists.index') }}">Voltar</a>
                @auth
                    <a class="btn btn-soft" href="{{ route('playlists.edit', $playlist) }}">Editar</a>
                    <form action="{{ route('playlists.destroy', $playlist) }}" method="POST" onsubmit="return confirm('Excluir esta playlist?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger-subtle" type="submit">Excluir</button>
                    </form>
                @endauth
            </div>
        </div>
    </section>
@endsection
