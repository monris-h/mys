<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoServicio extends Model
{
    use HasFactory;
    protected $table = 'catalogoservicio';
    protected $primaryKey = 'id_CatalogoServicio';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = ['cantidad_cobrada','diagnostico','estado_pago',]; //comentario

    public function detallesVenta()
    {
        return $this->hasMany(DetalleVentaServicio::class, 'id_CatalogoServicio');
    }
}
