Gestión de Locales Comerciales
Descripción del Proyecto

Sistema de gestión básica de locales comerciales desarrollado como prueba técnica full stack utilizando Laravel 12 para el backend y frontend web, y preparado para consumir la misma API desde una aplicación móvil en Flutter.

Requerimientos Cumplidos
API REST: GET /api/locales y PUT /api/locales/{id}
Frontend Web: Interfaz en Blade que consume la API
Base de datos: 12 locales de prueba con todos los campos requeridos
Actualización: Modal interactivo para editar locales
Sin autenticación (como se solicitó)
Tecnologías Utilizadas
Backend: Laravel 12 (PHP 8.2)
Base de datos: SQLite
Frontend: Blade + Bootstrap 5 + JavaScript (Fetch API)
Estilo: Bootstrap 5 + Font Awesome
Estructura del Proyecto

locales-app/
├── app/
│ ├── Models/Local.php
│ └── Http/Controllers/
│ ├── LocalController.php
│ └── Api/LocalApiController.php
├── routes/
│ ├── web.php
│ └── api.php
├── resources/views/
│ ├── layout.blade.php
│ └── locales/
│ └── index.blade.php
├── database/seeders/LocalSeeder.php
└── README.md

Instalación y Ejecución
Clonar el repositorio
git clone <URL_DEL_REPOSITORIO>
cd locales-app
Instalar dependencias
composer install
Configurar archivo de entorno
cp .env.example .env
php artisan key:generate
Ejecutar migraciones y cargar datos de prueba
php artisan migrate:fresh --seed
Iniciar el servidor
php artisan serve
Accede a la aplicación en: http://127.0.0.1:8000/locales
Funcionalidades Implementadas
Backend API
GET /api/locales → Listado completo de locales
PUT /api/locales/{id} → Actualización de local
Frontend Web
Listado de locales consumiendo la API
Edición mediante modal (experiencia moderna)
Diseño responsive
Indicadores visuales de estado (Activo/Inactivo)
Datos de Prueba
12 locales comerciales de prueba
Incluye locales activos e inactivos
Campos completos según especificación
Decisiones de Desarrollo
Separación clara entre API y Frontend Web
Uso de fetch API para comunicación con el backend
Modal para edición sin recargar la página
Sistema de respaldo en caso de fallo de la API
Código comentado y organizado para facilitar la revisión