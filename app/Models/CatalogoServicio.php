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
    protected $cantidad_cobrada;
    protected $diagnostico;
    protected $estado_pago;
    public $timestamps = true;
    protected $fillable = ['cantidad_cobrada','diagnostico','estado_pago',];
}
