<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\

class VisitorV extends Model
{
    use SoftDeletes;
    protected $connection = 'visitAll'; // Use the visitAll connection
    protected $table = 'visitors'; // Specify the table name
    protected $primaryKey = 'id_visitor';
    // Specify the fillable attributes
    protected $fillable = [
        'nombre', 
        'apellido', 
        'correo', 
        'dni', 
        'celular', 
        'carreraDeInteres', 
    ];

}
