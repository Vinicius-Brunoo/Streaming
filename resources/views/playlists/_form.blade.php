<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="nome_playlist">Nome da playlist</label>
        <input class="form-control" type="text" id="nome_playlist" name="nome_playlist" value="{{ old('nome_playlist', $playlist->nome_playlist ?? '') }}" required maxlength="120">
    </div>

    <div class="col-md-3">
        <label class="form-label" for="usuario">Usuario</label>
        <input class="form-control" type="text" id="usuario" value="{{ old('usuario', $playlist->usuario ?? auth()->user()->name) }}" readonly>
    </div>

    <div class="col-md-3">
        <label class="form-label" for="status">Status</label>
        <select class="form-select" id="status" name="status" required>
            @foreach (['publica' => 'Publica', 'privada' => 'Privada', 'colaborativa' => 'Colaborativa'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $playlist->status ?? 'publica') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-8">
        <label class="form-label" for="musica_id">Musica</label>
        <select class="form-select" id="musica_id" name="musica_id" required>
            @foreach ($musicas as $musica)
                <option value="{{ $musica->id }}" @selected((int) old('musica_id', $playlist->musica_id ?? 0) === $musica->id)>
                    {{ $musica->titulo }} - {{ $musica->artista }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="data_criacao">Data de criacao</label>
        <input class="form-control" type="date" id="data_criacao" name="data_criacao" value="{{ old('data_criacao', isset($playlist) ? $playlist->data_criacao->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
    </div>

    <div class="col-12">
        <label class="form-label" for="descricao">Descricao</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="4" maxlength="255" placeholder="Ex.: musicas para estudar, treinar ou viajar">{{ old('descricao', $playlist->descricao ?? '') }}</textarea>
    </div>
</div>

<div class="form-actions">
    <a class="btn btn-outline-light" href="{{ route('playlists.index') }}">Cancelar</a>
    <button class="btn btn-accent" type="submit">
        <i class="bi bi-save"></i> Salvar playlist
    </button>
</div>
