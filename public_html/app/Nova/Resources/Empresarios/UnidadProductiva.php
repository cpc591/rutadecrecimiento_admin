<?php

namespace App\Nova\Resources\Empresarios;

use App\Models\Sector;
use App\Models\UnidadProductivaPersona;
use App\Models\UnidadProductivaTamano;
use App\Nova\Actions\ExportCompanies;
use App\Nova\Resources\Resource;
use App\Nova\Resources\Diagnosticos\DiagnosticoResultado;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;

class UnidadProductiva extends Resource {

    public static $model = \App\Models\UnidadProductiva::class;
    public static $title = 'business_name';
    public static $search = [
        'unidadproductiva_id', 
        'business_name', 
        'nit', 
        'registration_number',
        'name_legal_representative',
        'registration_email'
    ];

    public static function label() {
        return 'Unidades productivas y Empresarios';
    }

    public static function singularLabel(){
        return 'Unidad productiva';
    }

    public function fields(Request $request) {
        return [
            ID::make('id', 'unidadproductiva_id'),
            
            Date::make('Fecha de Registro', 'fecha_creacion')
                ->rules('required')
                ->format('YYYY-MM-DD'),
            
            Text::make('Tipo de Registro', 'tipo_registro_rutac')
                ->rules('required'),
            
            Text::make('Razon social', 'business_name')
                ->rules('required'),

            Text::make('NIT', 'nit')
                ->rules('required'),

            Text::make('Nombre del representante legal', 'name_legal_representative'),

            Text::make('Numero de matricula', 'registration_number')
                ->rules('required')->hideFromIndex(),

            Date::make('Fecha de matricula', 'registration_date')
                ->rules('required')->hideFromIndex(),

            Text::make('Email registrado', 'registration_email')
                ->rules('required'),

            Select::make('Tipo de persona', 'tipopersona_id')
                ->options(UnidadProductivaPersona::pluck('tipoPersonaNOMBRE', 'tipopersona_id'))
                ->displayUsingLabels(),

            Select::make('Sector', 'sector_id')
                ->options(Sector::pluck('sectorNOMBRE', 'sector_id'))
                ->displayUsingLabels(),


            Select::make('Tamaño', 'tamano_id')
                ->options(UnidadProductivaTamano::pluck('tamanoNOMBRE', 'tamano_id'))
                ->displayUsingLabels(),

            //Para mostrar usamos los campos de Stack Line, ya que puede haber valores en null
            Stack::make('Tipo de persona', [
                Line::make(null, function () {
                    return $this->tipoPersona ? $this->tipoPersona->tipoPersonaNOMBRE : null;
                }),
            ])->hideFromIndex(),

            Stack::make('Sector', [
                Line::make(null, function () {
                    return $this->sector ? $this->sector->sectorNOMBRE : null;
                }),
            ])->hideFromIndex(),

            Stack::make('Tamaño', [
                Line::make(null, function () {
                    return $this->tamano ? $this->tamano->tamanoNOMBRE : null;
                }),
            ])->hideFromIndex(),

            Text::make('Actividad económica', 'comercial_activity')
                ->hideFromIndex(),

            Boolean::make('Afiliado', 'affiliated')
                ->hideFromIndex(),

            Stack::make('Grafico araña', [
               Line::make(null, function () {
                   if($this->complete_diagnostic == 0)
                       return 'No tiene diagnostico';

                   $url_domain = route('company.graph.radial', ['id' => $this->unidadproductiva_id]);
                   return '<a class="btn btn-xs mr-1 btn-primary" style="line-height: 1.5rem" target="_blank" href="' . $url_domain . '">Visualizar gráfico</a>';
               })->asHtml()
            ]),

            new Panel('Información complementaria', $this->information()),

            new Panel('Redes sociales', $this->social()),

            new Panel('Georeferenciación', $this->location()),

            new Panel('Forzar diagnostico', $this->forceDiagnostic()),

            HasMany::make('Diagnosticos', 'diagnosticos', DiagnosticoResultado::class),

            HasMany::make('Inscripciones a programas', 'inscripciones', DiagnosticoResultado::class),
        ];
    }

    protected function information() {

        $municipios = \App\Models\Municipio::orderBy('municipionombreoficial', 'asc')
            ->pluck('municipionombreoficial', 'municipio_id');

        $departamentos = \App\Models\Departamento::orderBy('departamentonombreoficial', 'asc')
        ->pluck('departamentonombreoficial', 'departamento_id');

        return [
            Select::make('Departamento', 'department_id')
                ->options($departamentos)->displayUsingLabels()->rules('required'),

            Select::make('Municipio', 'municipality_id')
                ->searchable()
                ->options($municipios)->displayUsingLabels()->rules('required'),

            Text::make('Dirección', 'address')
                ->hideFromIndex(),

            Text::make('Teléfono', 'telephone')->hideFromIndex(),

            Text::make('Celular', 'mobile')->hideFromIndex(),

            Text::make('Sitio web', 'website')->hideFromIndex(),

            Text::make('Persona de contacto', 'contact_person')
                ->rules('required')->hideFromIndex(),

            Text::make('Cargo de contacto', 'contact_position')
                ->rules('required')->hideFromIndex(),

            Text::make('Email de contacto', 'contact_email')
                ->hideFromIndex(),

            Text::make('Celular de contacto', 'contact_phone')
                ->hideFromIndex(),
        ];
    }

    protected function social() {
        return [
            Text::make('Instagram', 'social_instagram')->hideFromIndex(),

            Text::make('Facebook', 'social_facebook')->hideFromIndex(),

            Text::make('Linkedin', 'social_linkedin')->hideFromIndex(),
        ];
    }

    protected function location() {
        return [
            Text::make('Ubicación geografica', 'geolocation')
                ->help('Utlice latitud y longitud')->hideFromIndex(),

            Stack::make('Ubicación', [
               Line::make(null, function (){
                   if($this->geolocation == null)
                       return 'No se ha capturado georeferenciación';

                   return "<img src='https://maps.googleapis.com/maps/api/staticmap?center=".$this->geolocation."&zoom=17&size=800x300&markers=color:red|".$this->geolocation."&key=AIzaSyCPqpt_YwJzrvm0CuQndesni_zZ_8GTDUA' width='100%' />";
               })->asHtml()
            ])->hideFromIndex(),
        ];
    }

    protected function forceDiagnostic() {
        return [
            Select::make('Forzar diagnostico', 'complete_diagnostic')
                ->options([
                    0 => 'Forzar un nuevo diagnostico al momento de ingresar',
                    1 => 'La empresa ha completado su diagnostico',
                ])->displayUsingLabels()->hideFromIndex(),
        ];
    }

    public function actions(Request $request) {
        return [
            new ExportCompanies(),
        ];
    }
}
