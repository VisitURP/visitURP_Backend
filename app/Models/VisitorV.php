<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VisitorV extends Model
{
    use SoftDeletes;

    protected $table = 'visitor_v_s';
    protected $primaryKey = 'id_visitorV';
    
    protected $fillable = [
        'name', 
        'email', 
        'lastName', 
        'fk_docType_id', 
        'documentNumber', 
        'phone',
    ];
}
