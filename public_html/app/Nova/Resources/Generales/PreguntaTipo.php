<?php

namespace App\Nova\Resources\Generales;

use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class PreguntaTipo extends Resource
{
    public static $model = \App\Models\PreguntaTipo::class;
    public static $title = 'preguntatipo_nombre';
    public static $search = ['preguntatipo_id', 'preguntatipo_nombre'];

    public static function label() {
        return 'Tipos de preguntas';
    }

    public function fields(Request $request) {
        return [
            ID::make('preguntatipo_id'),

            Text::make('Nombre', 'preguntatipo_nombre')
                ->rules('required'),

            Boolean::make('Permitir opciones', 'preguntatipo_opciones')
                ->rules('required')
                ->trueValue(1)
                ->falseValue(0) 
                ->sortable(), 
        ];
    }
}
