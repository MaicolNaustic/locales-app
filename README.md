# Gestión de Locales Comerciales - Prueba Técnica Full Stack

## Descripción
Proyecto desarrollado como **prueba técnica** que consiste en un sistema de gestión de locales comerciales utilizando **Laravel 12** (Backend + Frontend Web) y preparado para **Flutter** (Cliente Móvil).

Se cumple con los requerimientos solicitados:
- API REST (`GET /api/locales` y `PUT /api/locales/{id}`)
- Frontend Web en Blade que consume la API
- Edición de locales mediante modal
- 12 locales de prueba mediante seeder

## Tecnologías utilizadas

**Backend & Web:**
- Laravel 12
- PHP 8.2
- Blade + Bootstrap 5
- SQLite

**Móvil:**
- Flutter + Dart

## Instalación (Laravel)

```bash
# Clonar repositorio
git clone https://github.com/MaicolNaustic/locales-app.git
cd locales-app

# Instalar dependencias
composer install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Migraciones + datos de prueba
php artisan migrate:fresh --seed

# Iniciar servidor
php artisan serve
