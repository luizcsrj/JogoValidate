<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'letra', 'preco', 'avaliacao', 'usabilidade'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
