<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="titulo">Titulo</label>
        <input class="form-control" type="text" id="titulo" name="titulo" value="{{ old('titulo', $musica->titulo ?? '') }}" required maxlength="120">
    </div>

    <div class="col-md-6">
        <label class="form-label" for="artista">Artista</label>
        <input class="form-control" type="text" id="artista" name="artista" value="{{ old('artista', $musica->artista ?? '') }}" required maxlength="120">
    </div>

    <div class="col-md-6">
        <label class="form-label" for="album">Album</label>
        <input class="form-control" type="text" id="album" name="album" value="{{ old('album', $musica->album ?? '') }}" required maxlength="120">
    </div>

    <div class="col-md-3">
        <label class="form-label" for="genero">Genero</label>
        <select class="form-select" id="genero" name="genero" required>
            @foreach (['Pop', 'Rock', 'Rap', 'MPB', 'Sertanejo', 'Eletronica', 'Jazz', 'Indie', 'Outro'] as $genero)
                <option value="{{ $genero }}" @selected(old('genero', $musica->genero ?? '') === $genero)>{{ $genero }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label" for="duracao">Duracao</label>
        <input class="form-control" type="text" id="duracao" name="duracao" value="{{ old('duracao', isset($musica) ? substr($musica->duracao, 0, 8) : '') }}" placeholder="00:03:45" inputmode="numeric" maxlength="8" pattern="([0-9]{1,2}:)?[0-5]?[0-9]:[0-5][0-9]" data-duration-mask required>
    </div>

    <div class="col-12">
        <label class="form-label" for="capa">Capa da musica</label>
        <input class="form-control" type="file" id="capa" name="capa" accept="image/*">
        @isset($musica)
            @if ($musica->capa)
                <p class="form-hint">Capa atual: <a href="{{ asset('storage/'.$musica->capa) }}" target="_blank">visualizar imagem</a>. Envie outra apenas se quiser trocar.</p>
            @endif
        @endisset
    </div>
</div>

<div class="form-actions">
    <a class="btn btn-outline-light" href="{{ route('musicas.index') }}">Cancelar</a>
    <button class="btn btn-accent" type="submit">
        <i class="bi bi-save"></i> Salvar musica
    </button>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('[data-duration-mask]').forEach((input) => {
                    const formatDuration = (value, padGroups = false) => {
                        const digits = value.replace(/\D/g, '').slice(0, 6);

                        if (digits.length <= 2) {
                            return digits;
                        }

                        if (digits.length <= 4) {
                            const minutes = digits.slice(0, -2);
                            const seconds = digits.slice(-2);

                            return `${padGroups ? minutes.padStart(2, '0') : minutes}:${seconds}`;
                        }

                        const hours = digits.slice(0, -4);
                        const minutes = digits.slice(-4, -2);
                        const seconds = digits.slice(-2);

                        return `${padGroups ? hours.padStart(2, '0') : hours}:${minutes}:${seconds}`;
                    };

                    const applyMask = (padGroups = false) => {
                        input.value = formatDuration(input.value, padGroups);
                    };

                    input.addEventListener('input', () => applyMask());
                    input.addEventListener('blur', () => applyMask(true));
                    input.addEventListener('keydown', (event) => {
                        if (event.key === 'Enter') {
                            applyMask(true);
                        }
                    });
                    input.form?.addEventListener('submit', () => applyMask(true));

                    applyMask(true);
                });
            });
        </script>
    @endpush
@endonce
