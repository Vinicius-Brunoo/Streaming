@extends('layouts.app')

@section('title', 'Editar musica | Streaming Music')

@section('content')
    <section class="form-shell">
        <div class="section-heading">
            <span class="eyebrow">Edicao</span>
            <h1>Editar musica</h1>
            <p>Atualize os dados de {{ $musica->titulo }}.</p>
        </div>

        <form action="{{ route('musicas.update', $musica) }}" method="POST" enctype="multipart/form-data" class="app-form">
            @csrf
            @method('PUT')
            @include('musicas._form')
        </form>
    </section>
@endsection
