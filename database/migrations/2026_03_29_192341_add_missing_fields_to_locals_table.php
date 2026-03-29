<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('locals', function (Blueprint $table) {
            // Hacemos nullable el campo telefono (para no perder datos existentes)
            if (Schema::hasColumn('locals', 'telefono')) {
                $table->string('telefono')->nullable()->change();
            }

            // Agregamos los campos nuevos requeridos por la prueba
            if (!Schema::hasColumn('locals', 'estado')) {
                $table->integer('estado')->default(1)->after('direccion');
            }
            if (!Schema::hasColumn('locals', 'latLong')) {
                $table->string('latLong')->nullable()->after('estado');
            }
            if (!Schema::hasColumn('locals', 'tipo_documento')) {
                $table->string('tipo_documento')->nullable()->after('latLong');
            }
            if (!Schema::hasColumn('locals', 'nro_documento')) {
                $table->string('nro_documento')->nullable()->after('tipo_documento');
            }
        });
    }

    public function down()
    {
        Schema::table('locals', function (Blueprint $table) {
            $table->dropColumn(['estado', 'latLong', 'tipo_documento', 'nro_documento']);
            // Si quieres volver telefono a NOT NULL:
            // $table->string('telefono')->nullable(false)->change();
        });
    }
};