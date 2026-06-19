<?php

namespace App\Http\Controllers;

use App\Models\Musica;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MusicaController extends Controller
{
    public function index(): View
    {
        $musicas = Musica::withCount('playlists')
            ->latest()
            ->paginate(8);

        return view('musicas.index', compact('musicas'));
    }

    public function create(): View
    {
        return view('musicas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('capa')) {
            $data['capa'] = $request->file('capa')->store('capas', 'public');
        }

        Musica::create($data);

        return redirect()->route('musicas.index')
            ->with('success', 'Musica cadastrada com sucesso.');
    }

    public function show(Musica $musica): View
    {
        $musica->load('playlists');

        return view('musicas.show', compact('musica'));
    }

    public function edit(Musica $musica): View
    {
        return view('musicas.edit', compact('musica'));
    }

    public function update(Request $request, Musica $musica): RedirectResponse
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('capa')) {
            if ($musica->capa) {
                Storage::disk('public')->delete($musica->capa);
            }

            $data['capa'] = $request->file('capa')->store('capas', 'public');
        }

        $musica->update($data);

        return redirect()->route('musicas.show', $musica)
            ->with('success', 'Musica atualizada com sucesso.');
    }

    public function destroy(Musica $musica): RedirectResponse
    {
        if ($musica->capa) {
            Storage::disk('public')->delete($musica->capa);
        }

        $musica->delete();

        return redirect()->route('musicas.index')
            ->with('success', 'Musica excluida com sucesso.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:120'],
            'artista' => ['required', 'string', 'max:120'],
            'album' => ['required', 'string', 'max:120'],
            'genero' => ['required', 'string', 'max:60'],
            'duracao' => ['required', 'regex:/^(\d{1,2}:)?[0-5]?\d:[0-5]\d$/'],
            'capa' => ['nullable', 'image', 'max:2048'],
        ], [
            'duracao.regex' => 'Informe a duracao no formato MM:SS ou HH:MM:SS.',
        ]);

        $durationParts = array_map('intval', explode(':', $data['duracao']));

        if (count($durationParts) === 2) {
            $data['duracao'] = sprintf('00:%02d:%02d', $durationParts[0], $durationParts[1]);
        }

        if (count($durationParts) === 3) {
            $data['duracao'] = sprintf('%02d:%02d:%02d', $durationParts[0], $durationParts[1], $durationParts[2]);
        }

        return $data;
    }
}
