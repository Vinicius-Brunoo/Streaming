@extends('layouts.app')

@section('title', 'Editar playlist | Streaming Music')

@section('content')
    <section class="form-shell">
        <div class="section-heading">
            <span class="eyebrow">Edicao</span>
            <h1>Editar playlist</h1>
            <p>Atualize os dados de {{ $playlist->nome_playlist }}.</p>
        </div>

        <form action="{{ route('playlists.update', $playlist) }}" method="POST" class="app-form">
            @csrf
            @method('PUT')
            @include('playlists._form')
        </form>
    </section>
@endsection
