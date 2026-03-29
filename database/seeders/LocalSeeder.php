<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Local;

/**
 * LocalSeeder - Crea datos de prueba para la prueba técnica
 * 
 * Este seeder cumple con el requerimiento de tener mínimo 10 locales.
 * Se crean 12 locales para tener variedad (activos e inactivos).
 * No incluye el campo 'telefono' porque no es requerido en la prueba.
 */
class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiamos la tabla antes de insertar nuevos registros
        // Esto evita errores de duplicados si ejecutamos el seeder varias veces
        Local::truncate();

        // Array con 12 locales de prueba
        $locales = [
            [
                'nombre'         => 'Supermercado Mi Bodega',
                'direccion'      => 'Av. Quito N34-12 y Amazonas, Santo Domingo',
                'estado'         => 1,
                'latLong'        => '-0.2541, -79.1718',
                'tipo_documento' => 'RUC',
                'nro_documento'  => '1790012345001'
            ],
            [
                'nombre'         => 'Farmacia San Rafael',
                'direccion'      => 'Calle 3 de Julio y 12 de Noviembre',
                'estado'         => 1,
                'latLong'        => '-0.2487, -79.1689',
                'tipo_documento' => 'RUC',
                'nro_documento'  => '1790056789001'
            ],
            [
                'nombre'         => 'Restaurante El Sabor Quiteño',
                'direccion'      => 'Av. Abraham Calazacón Km 2.5',
                'estado'         => 0,        // Inactivo (para probar filtro)
                'latLong'        => null,
                'tipo_documento' => 'CEDULA',
                'nro_documento'  => '1712345678'
            ],
            [
                'nombre'         => 'Tienda de Ropa Moda Joven',
                'direccion'      => 'Centro Comercial El Dorado, Local 45',
                'estado'         => 1,
                'latLong'        => '-0.2523, -79.1705',
                'tipo_documento' => 'RUC',
                'nro_documento'  => '1790087654001'
            ],
            [
                'nombre'         => 'Ferretería El Constructor',
                'direccion'      => 'Av. Las Américas y Río Toachi',
                'estado'         => 1,
                'latLong'        => null,
                'tipo_documento' => 'RUC',
                'nro_documento'  => '1790023456001'
            ],
            [
                'nombre'         => 'Panadería La Esquina',
                'direccion'      => 'Calle Principal y 9 de Octubre',
                'estado'         => 1,
                'latLong'        => '-0.2556, -79.1732',
                'tipo_documento' => 'CEDULA',
                'nro_documento'  => '1709876543'
            ],
            [
                'nombre'         => 'Celulares y Accesorios Tech',
                'direccion'      => 'Plaza Shopping, Local 12',
                'estado'         => 0,        // Inactivo
                'latLong'        => '-0.2498, -79.1694',
                'tipo_documento' => 'RUC',
                'nro_documento'  => '1790034567001'
            ],
            [
                'nombre'         => 'Librería Estudiantil',
                'direccion'      => 'Av. Pichincha entre Sucre y Bolívar',
                'estado'         => 1,
                'latLong'        => null,
                'tipo_documento' => 'CEDULA',
                'nro_documento'  => '1714567890'
            ],
            [
                'nombre'         => 'Gym Power Fitness',
                'direccion'      => 'Km 1 vía a Quevedo',
                'estado'         => 1,
                'latLong'        => '-0.2601, -79.1756',
                'tipo_documento' => 'RUC',
                'nro_documento'  => '1790098765001'
            ],
            [
                'nombre'         => 'Cafetería Dulce Momento',
                'direccion'      => 'Parque Central, frente al Municipio',
                'estado'         => 1,
                'latLong'        => '-0.2539, -79.1721',
                'tipo_documento' => 'CEDULA',
                'nro_documento'  => '1701234567'
            ],
            [
                'nombre'         => 'Auto Repuestos El Mecánico',
                'direccion'      => 'Av. Esmeraldas y Río Baba',
                'estado'         => 1,
                'latLong'        => null,
                'tipo_documento' => 'RUC',
                'nro_documento'  => '1790045678001'
            ],
            [
                'nombre'         => 'Salón de Belleza Estilo',
                'direccion'      => 'Calle 24 de Mayo y Chimborazo',
                'estado'         => 0,        // Inactivo
                'latLong'        => '-0.2512, -79.1708',
                'tipo_documento' => 'CEDULA',
                'nro_documento'  => '1715678901'
            ],
        ];

        // Insertamos todos los locales
        foreach ($locales as $localData) {
            Local::create($localData);
        }

        // Mensaje informativo en la consola
        $this->command->info('✅ Se han creado ' . count($locales) . ' locales de prueba correctamente.');
        $this->command->info('   - Activos: 9');
        $this->command->info('   - Inactivos: 3');
    }
}