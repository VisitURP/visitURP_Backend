<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class chatbot_inquiry extends Model
{
    protected $connection = 'visitAll'; // Use the visitAll connection
    protected $table = 'chat_bot__consultas'; // Specify the table name
    protected $primaryKey = 'consulta_id';
    // Specify the fillable attributes
    protected $fillable = [ 
        'fk_visitor_id',
        'detalle',
        'estado',         
    ];
}
