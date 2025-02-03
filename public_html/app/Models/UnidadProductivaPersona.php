<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadProductivaPersona extends Model
{
    protected $table = 'unidadesproductivas_personas';
    protected $primaryKey = 'tipopersona_id';

    protected $fillable = [
        'tipoPersonaCODIGO',
        'tipoPersonaNOMBRE',
    ];
}
