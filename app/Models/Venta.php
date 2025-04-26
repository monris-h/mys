<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'venta';
    protected $primaryKey = 'id_venta';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $estado_pago;
    protected $fecha_venta;
    protected $metodo_pago;
    protected $monto_total;
    protected $id_cliente;
    protected $id_empleado;
    protected $id_impresora;
    protected $fillable = ['estado_pago','fecha_venta','metodo_pago','monto_total','id_cliente','id_empleado','id_impresora'];

    // Relaciones
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }

    public function impresora()
    {
        return $this->belongsTo(Impresora::class, 'id_impresora', 'id_impresora');
    }

    public function detallesVenta()
    {
        return $this->hasMany(DetalleVentaServicio::class, 'id_venta', 'id_venta');
    }

    public function factura()
    {
        return $this->hasOne(Factura::class, 'id_venta', 'id_venta');
    }
}



