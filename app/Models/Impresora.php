<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impresora extends Model
{
    use HasFactory;

    protected $table = 'impresora';
    protected $primaryKey = 'id_impresora';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = ['modelo','numero_serie','fecha_entrada','fecha_salida'];
    
    // Relación con Venta
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_impresora', 'id_impresora');
    }
}
