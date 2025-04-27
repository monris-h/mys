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
    public $timestamps = false;
    protected $fillable = ['nombre','estado','fecha_ingreso','telefono','rol'];
    
    // Relación con Venta
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_empleado', 'id_empleado');
    }
}
