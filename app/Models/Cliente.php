<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $nombre;
    protected $telefono;
    protected $email;
    protected $RFC;
    public $timestamps = false;
    protected $fillable = ['nombre','telefono','email','RFC'];
}
