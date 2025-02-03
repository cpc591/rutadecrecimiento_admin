<?php

namespace App\Nova\Resources\Generales;

use App\Nova\Resources\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;

class History extends Resource {
    public static $model = \App\Models\History::class;

    public static function label() {
        return 'Historias';
    }

    public function fields(Request $request) {
        return [
            Text::make('Nombre', 'name'),

            Text::make('URL Video', 'video_url'),

            Image::make('Imagen', 'image')
                ->disk('public')->path('history')
                ->help('Tamaño recomendado: 275 x 350 pixeles'),
        ];
    }
}
