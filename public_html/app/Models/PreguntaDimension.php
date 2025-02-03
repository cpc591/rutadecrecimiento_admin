<?php

namespace App\Models;

use App\Models\Traits\DatosAuditoriaTrait;
use App\Models\Traits\UsuarioTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PreguntaDimension extends Model
{
    use SoftDeletes, DatosAuditoriaTrait, UsuarioTrait;
    
    protected $table = 'preguntas_dimensiones';
    protected $primaryKey = 'preguntadimension_id';

    protected $fillable = [
        'preguntadimension_nombre'
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';
}
