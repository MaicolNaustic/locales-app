<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $table = 'locals';

    protected $fillable = [
        'nombre',
        'direccion',
        'estado',
        'latLong',
        'tipo_documento',
        'nro_documento',
    ];

    // Si quieres que estado se muestre como booleano en algunos casos
    protected $casts = [
        'estado' => 'boolean',
    ];
}