<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use SoftDeletes;

    protected $table = 'visits';
    protected $primaryKey = 'id_visit';
    
    protected $fillable = [
        'name', 
        'lastName', 
        'email', 
        'fk_visitorP_id', 
        'fk_visitorV_id',
        'fk_docType_id', 
        'docNumber', 
        'phone', 
        'visitDateP', 
        'visitDateV',
        'interestCareer',
        'educationalInstitution', 
        'residentDistrict', 
        'virtualVisit'
    ];
}
