<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['titulo', 'artista', 'album', 'genero', 'duracao', 'capa'])]
class Musica extends Model
{
    public function playlists(): HasMany
    {
        return $this->hasMany(Playlist::class);
    }
}
