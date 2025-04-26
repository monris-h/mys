<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentaServicio extends Model
{
    use HasFactory;

    protected $table = 'detalleventaservicio';
    protected $primaryKey = 'id_detalle';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $subtotal;
    protected $id_CatalogoServicio;
    protected $id_venta;
    protected $fillable = ['subtotal', 'id_CatalogoServicio', 'id_venta'];

    // Relaciones
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }

    public function catalogoServicio()
    {
        return $this->belongsTo(CatalogoServicio::class, 'id_CatalogoServicio', 'id_CatalogoServicio');
    }
}
