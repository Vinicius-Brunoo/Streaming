<?php

namespace Database\Seeders;

use App\Models\Musica;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@streaming.test'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('123456'),
            ],
        );

        $musicas = [
            [
                'titulo' => 'Noite Neon',
                'artista' => 'Lia Prado',
                'album' => 'Cidade Ligada',
                'genero' => 'Pop',
                'duracao' => '00:03:42',
            ],
            [
                'titulo' => 'Linha de Baixo',
                'artista' => 'Vetor Norte',
                'album' => 'Ao Vivo no Terminal',
                'genero' => 'Rock',
                'duracao' => '00:04:18',
            ],
            [
                'titulo' => 'Cafe sem Pressa',
                'artista' => 'Mar Alto',
                'album' => 'Domingo Lento',
                'genero' => 'MPB',
                'duracao' => '00:02:57',
            ],
        ];

        foreach ($musicas as $musica) {
            Musica::updateOrCreate(
                ['titulo' => $musica['titulo'], 'artista' => $musica['artista']],
                $musica,
            );
        }

        Playlist::updateOrCreate(
            ['nome_playlist' => 'Favoritas da Semana'],
            [
                'musica_id' => Musica::where('titulo', 'Noite Neon')->value('id'),
                'usuario' => 'Administrador',
                'data_criacao' => now()->toDateString(),
                'descricao' => 'Selecao principal para abrir a apresentacao.',
                'status' => 'publica',
            ],
        );

        Playlist::updateOrCreate(
            ['nome_playlist' => 'Trabalho e Foco'],
            [
                'musica_id' => Musica::where('titulo', 'Cafe sem Pressa')->value('id'),
                'usuario' => 'Administrador',
                'data_criacao' => now()->subDays(2)->toDateString(),
                'descricao' => 'Faixas leves para estudar e programar.',
                'status' => 'colaborativa',
            ],
        );
    }
}
