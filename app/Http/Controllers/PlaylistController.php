<?php

namespace App\Http\Controllers;

use App\Models\Musica;
use App\Models\Playlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlaylistController extends Controller
{
    public function index(): View
    {
        $playlists = Playlist::with('musica')
            ->latest('data_criacao')
            ->paginate(10);

        return view('playlists.index', compact('playlists'));
    }

    public function create(): View|RedirectResponse
    {
        $musicas = Musica::orderBy('titulo')->get();

        if ($musicas->isEmpty()) {
            return redirect()->route('musicas.create')
                ->with('warning', 'Cadastre uma musica antes de montar playlists.');
        }

        return view('playlists.create', compact('musicas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['usuario'] = $request->user()->name;

        $playlist = Playlist::create($data);

        return redirect()->route('playlists.show', $playlist)
            ->with('success', 'Playlist cadastrada com sucesso.');
    }

    public function show(Playlist $playlist): View
    {
        $playlist->load('musica');

        return view('playlists.show', compact('playlist'));
    }

    public function edit(Playlist $playlist): View
    {
        $musicas = Musica::orderBy('titulo')->get();

        return view('playlists.edit', compact('playlist', 'musicas'));
    }

    public function update(Request $request, Playlist $playlist): RedirectResponse
    {
        $playlist->update($this->validatedData($request));

        return redirect()->route('playlists.show', $playlist)
            ->with('success', 'Playlist atualizada com sucesso.');
    }

    public function destroy(Playlist $playlist): RedirectResponse
    {
        $playlist->delete();

        return redirect()->route('playlists.index')
            ->with('success', 'Playlist excluida com sucesso.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nome_playlist' => ['required', 'string', 'max:120'],
            'musica_id' => ['required', 'exists:musicas,id'],
            'data_criacao' => ['required', 'date'],
            'descricao' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:publica,privada,colaborativa'],
        ]);
    }
}
