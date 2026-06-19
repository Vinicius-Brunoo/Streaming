<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['nome_playlist', 'musica_id', 'usuario', 'data_criacao', 'descricao', 'status'])]
class Playlist extends Model
{
    protected function casts(): array
    {
        return [
            'data_criacao' => 'date',
        ];
    }

    public function musica(): BelongsTo
    {
        return $this->belongsTo(Musica::class);
    }
}
