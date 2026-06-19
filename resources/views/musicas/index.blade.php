@extends('layouts.app')

@section('title', 'Musicas | Streaming Music')

@section('content')
    <section class="page-hero">
        <div>
            @auth
                <span class="eyebrow">Painel de musicas</span>
                <h1>Ola, {{ auth()->user()->name }}</h1>
                <p>Gerencie o catalogo, cadastre novas musicas e organize as playlists do streaming.</p>
            @else
                <span class="eyebrow">Catalogo publico</span>
                <h1>Trilhas prontas para entrar na fila</h1>
                <p>Liste e consulte musicas. Para cadastrar, alterar ou excluir, entre com sua conta.</p>
            @endauth
        </div>
        <div class="hero-actions">
            @auth
                <a class="btn btn-accent" href="{{ route('musicas.create') }}">
                    <i class="bi bi-plus-circle"></i> Nova musica
                </a>
            @else
                <a class="btn btn-outline-light" href="{{ route('login') }}">
                    <i class="bi bi-lock"></i> Entrar para gerenciar
                </a>
            @endauth
            <a class="btn btn-soft" href="{{ route('playlists.index') }}">
                <i class="bi bi-collection-play"></i> Ver playlists
            </a>
        </div>
    </section>

    @if ($musicas->isEmpty())
        <section class="empty-state">
            <i class="bi bi-music-note-list"></i>
            <h2>Nenhuma musica cadastrada</h2>
            @auth
                <p>Cadastre a primeira faixa do catalogo para comecar.</p>
            @else
                <p>Entre no sistema para inserir a primeira faixa do catalogo.</p>
            @endauth
        </section>
    @else
        <div class="row g-4">
            @foreach ($musicas as $musica)
                <div class="col-md-6 col-xl-4">
                    <article class="music-card h-100">
                        <a class="cover-link" href="{{ route('musicas.show', $musica) }}">
                            @if ($musica->capa)
                                <img src="{{ asset('storage/'.$musica->capa) }}" alt="Capa de {{ $musica->titulo }}">
                            @else
                                <span class="cover-placeholder"><i class="bi bi-vinyl"></i></span>
                            @endif
                        </a>
                        <div class="music-card-body">
                            <span class="tag">{{ $musica->genero }}</span>
                            <h2>{{ $musica->titulo }}</h2>
                            <p class="artist">{{ $musica->artista }} - {{ $musica->album }}</p>
                            <div class="meta-row">
                                <span><i class="bi bi-clock"></i> {{ $musica->duracao }}</span>
                                <span><i class="bi bi-list-stars"></i> {{ $musica->playlists_count }} playlist(s)</span>
                            </div>
                            <div class="actions-row">
                                <a class="btn btn-sm btn-outline-light" href="{{ route('musicas.show', $musica) }}">Detalhes</a>
                                @auth
                                    <a class="btn btn-sm btn-soft" href="{{ route('musicas.edit', $musica) }}">Editar</a>
                                    <form action="{{ route('musicas.destroy', $musica) }}" method="POST" onsubmit="return confirm('Excluir esta musica? As playlists relacionadas tambem serao removidas.');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger-subtle" type="submit">Excluir</button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $musicas->links() }}
        </div>
    @endif
@endsection
