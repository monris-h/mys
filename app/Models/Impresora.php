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
    protected $modelo;
    protected $numero_serie;
    protected $fecha_entrada;
    protected $fecha_salida;
    protected $fillable = ['modelo','numero_serie','fecha_entrada','fecha_salida'];

}
