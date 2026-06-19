@extends('layouts.app')

@section('title', 'Playlists | Streaming Music')

@section('content')
    <section class="page-hero page-hero-alt">
        <div>
            <span class="eyebrow">Colecoes</span>
            <h1>Playlists conectadas ao catalogo</h1>
            <p>Cada playlist referencia uma musica cadastrada, demonstrando o relacionamento obrigatorio entre as tabelas.</p>
        </div>
        <div class="hero-actions">
            @auth
                <a class="btn btn-accent" href="{{ route('playlists.create') }}">
                    <i class="bi bi-plus-circle"></i> Nova playlist
                </a>
            @else
                <a class="btn btn-outline-light" href="{{ route('login') }}">
                    <i class="bi bi-lock"></i> Entrar para gerenciar
                </a>
            @endauth
            <a class="btn btn-soft" href="{{ route('musicas.index') }}">
                <i class="bi bi-disc"></i> Ver musicas
            </a>
        </div>
    </section>

    @if ($playlists->isEmpty())
        <section class="empty-state">
            <i class="bi bi-collection"></i>
            <h2>Nenhuma playlist cadastrada</h2>
            <p>Entre no sistema para criar uma playlist relacionada a uma musica.</p>
        </section>
    @else
        <div class="table-shell">
            <div class="table-responsive">
                <table class="table align-middle app-table">
                    <thead>
                        <tr>
                            <th>Playlist</th>
                            <th>Musica relacionada</th>
                            <th>Usuario</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th class="text-end">Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($playlists as $playlist)
                            <tr>
                                <td>
                                    <strong>{{ $playlist->nome_playlist }}</strong>
                                    @if ($playlist->descricao)
                                        <small>{{ $playlist->descricao }}</small>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('musicas.show', $playlist->musica) }}">{{ $playlist->musica->titulo }}</a>
                                    <small>{{ $playlist->musica->artista }}</small>
                                </td>
                                <td>{{ $playlist->usuario }}</td>
                                <td><span class="status-badge status-{{ $playlist->status }}">{{ ucfirst($playlist->status) }}</span></td>
                                <td>{{ $playlist->data_criacao->format('d/m/Y') }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a class="btn btn-sm btn-outline-light" href="{{ route('playlists.show', $playlist) }}">Detalhes</a>
                                        @auth
                                            <a class="btn btn-sm btn-soft" href="{{ route('playlists.edit', $playlist) }}">Editar</a>
                                            <form action="{{ route('playlists.destroy', $playlist) }}" method="POST" onsubmit="return confirm('Excluir esta playlist?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger-subtle" type="submit">Excluir</button>
                                            </form>
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $playlists->links() }}
        </div>
    @endif
@endsection
