<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VisitorInfoXapplicant extends Model
{
    use SoftDeletes;
    protected $table = 'visitor_info_xapplicants'; 
    protected $primaryKey = 'id_visitorInfoXapplicant';
    // Specify the fillable attributes
    protected $fillable = [
        'fk_applicant_id', 
        'fk_visitorInfo_id', 
        'fk_docType_id',
        'documentNumber',  
        'name', 
        'lastName',         
        'email',         
        'phone',         
        'educationalInstitution',         
        'residenceDistrict',         
        'studentCode',         
        'admitted', 
    ];

    public function docType()
    {
        return $this->belongsTo(docType::class, 'fk_docType_id');
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'fk_applicant_id');
    }
    public function visitorInfo()
    {
        return $this->belongsTo(VisitorInfo::class, 'fk_visitorInfo_id');
    }
}