<?php

namespace App\Nova\Actions;

use App\Models\Answer;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class CreateAnswer extends Action {
    public $name = 'Crear respuesta';

    public function handle(ActionFields $fields) {
        $answer = New Answer();
        $answer->company_id = $fields->company;
        $answer->variable_id = $fields->variable;
        $answer->save();
    }

    public function fields() {
        return [
            Select::make('Empresa', 'company')
                ->options(\App\Models\UnidadProductiva::all()->pluck('business_name', 'unidadproductiva_id')),

            Select::make('Variable', 'variable')
                ->options(\App\Models\DiagnosticoPregunta::all()->pluck('pregunta_titulo', 'pregunta_id')),
        ];
    }
}
