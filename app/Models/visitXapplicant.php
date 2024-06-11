<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class visitXapplicant extends Model
{
    use SoftDeletes;

    protected $table = 'visit_xapplicants';
    protected $primaryKey = 'id_visitXapplicant';
    
    protected $fillable = [
        'fk_applicant_id', 
        'fk_visit_id', 
        'fk_docType_id', 
        'docNumber', 
        'name', 
        'lastName', 
        'email', 
        'phone', 
        'visitDateP', 
        'visitDateV',
        'interestCareer',
        'educationalInstitution', 
        'residentDistrict', 
        'meritOrder',
        'studentCode',
        'admitted',
    ];
}
