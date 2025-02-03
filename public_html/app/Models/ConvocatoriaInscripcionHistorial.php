<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConvocatoriaInscripcionHistorial extends Model
{
    use HasFactory, SoftDeletes;

    // Nombre de la tabla
    protected $table = 'convocatorias_inscripciones_historial';

    // Clave primaria personalizada
    protected $primaryKey = 'historial_id';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'inscripcion_id',
        'inscripcionestado_id',
        'comentarios',
        'archivo',
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    const DELETED_AT = 'fecha_eliminacion';

    public function inscripcion()
    {
        return $this->belongsTo(ConvocatoriaInscripcion::class, 'inscripcion_id', 'inscripcion_id');
    }

    public function estado()
    {
        return $this->belongsTo(InscripcionEstado::class, 'inscripcionestado_id', 'inscripcionestado_id');
    }
}
