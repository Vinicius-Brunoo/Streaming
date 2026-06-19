@extends('layouts.app')

@section('title', 'Nova musica | Streaming Music')

@section('content')
    <section class="form-shell">
        <div class="section-heading">
            <span class="eyebrow">Cadastro</span>
            <h1>Nova musica</h1>
            <p>Preencha os dados da faixa e envie uma imagem de capa para cumprir o requisito de upload.</p>
        </div>

        <form action="{{ route('musicas.store') }}" method="POST" enctype="multipart/form-data" class="app-form">
            @csrf
            @include('musicas._form')
        </form>
    </section>
@endsection
