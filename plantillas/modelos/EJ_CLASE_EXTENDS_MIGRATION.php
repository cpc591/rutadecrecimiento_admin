<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjemploTable extends Migration
{
    /**
     * Ejecutar la migraci�n.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejemplo', function (Blueprint $table) {
            // Definici�n del ID personalizado
            $table->unsignedBigInteger('ejemplo_id')->primary(); // ID personalizado
                        
            // Clave for�nea
            $table->unsignedBigInteger('padre_id'); // Relaci�n con Tabla Padre
            $table->foreign('padre_id')->references('padre_id')->on('TablaPadre')->onDelete('restrict');
            
            // Otros campos de la tabla...
            $table->string('nombre', 100); // Ejemplo de otro campo

            // Campos de auditor�a
            $table->unsignedBigInteger('usuario_creo')->nullable(); // ID del usuario que cre�
            $table->timestamp('fecha_creacion')->useCurrent(); // Fecha de creaci�n
            $table->unsignedBigInteger('usuario_actualizo')->nullable(); // ID del usuario que actualiz�
            $table->timestamp('fecha_actualizacion')->nullable(); // Fecha de actualizaci�n
            $table->unsignedBigInteger('usuario_elimino')->nullable(); // ID del usuario que elimin�
            $table->timestamp('fecha_eliminacion')->nullable(); // Fecha de eliminaci�n

            // Soft deletes para eliminaci�n l�gica
            $table->softDeletes(); // Agrega la columna deleted_at
            
             // Para incluir created_at y updated_at 
            $table->timestamps();aunque aqu� ya tenemos campos personalizados // aunque aqu� ya tenemos campos personalizados
            
        });
    }

    /**
     * Revertir la migraci�n.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ejemplo');
    }
}

?>
