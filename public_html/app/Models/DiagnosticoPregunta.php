<?php

namespace App\Models;

use App\Models\Traits\DatosAuditoriaTrait;
use App\Models\Traits\UsuarioTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoPregunta extends Model
{
    use SoftDeletes, DatosAuditoriaTrait, UsuarioTrait;
    protected $table = 'diagnosticos_preguntas';
    protected $primaryKey = 'pregunta_id';

    protected $fillable = [
        'diagnostico_id',
        'preguntagrupo_id',
        'preguntatipo_id',
        'preguntadimension_id',
        'pregunta_titulo',
        'pregunta_opcionesJSON',
        'pregunta_porcentaje',
        'pregunta_sobreventas',
    ];

    // Relaciones

    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class, 'diagnostico_id', 'diagnostico_id');
    }

    public function grupo()
    {
        return $this->belongsTo(PreguntaGrupo::class, 'preguntagrupo_id');
    }

    public function tipo()
    {
        return $this->belongsTo(PreguntaTipo::class, 'preguntatipo_id', 'preguntatipo_id');
    }

    public function dimension()
    {
        return $this->belongsTo(PreguntaDimension::class, 'preguntadimension_id');
    }

    public function opciones()
    {
        return $this->hasMany(PreguntaOpcion::class, 'pregunta_id', 'pregunta_id');
    }

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';
}
