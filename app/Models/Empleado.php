<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'empleado';
    protected $primaryKey = 'id_empleado';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $nombre;
    protected $activo;
    protected $fecha_ingreso;
    protected $telefono;
    protected $rol;
    public $timestamps = false;
    protected $fillable = ['nombre','estado','fecha_ingreso','telefono','rol',];
}
