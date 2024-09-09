<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VisitorPreference extends Model
{
    use SoftDeletes;
    
    protected $table = 'visitor_preferences';
    
    const TYPE1 = 'V';
    const TYPE2 = 'P';

    protected $primarykey = 'id_visitorPreference';

    protected $fillable = [
        'fk_id_visitor', 
        'fk_id_academicInterested', 
        'visitor_type',
    ];
}
