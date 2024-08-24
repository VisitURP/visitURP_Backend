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
        'residenceDistrict',
        'educationalInstitution'
    ];

    public function docType()
    {
        return $this->hasMany(docType::class, 'fk_docType_id');
    }

    public function visitV()
    {
        return $this->hasMany(visitV::class, 'fk_id_visitorV','id_visitorV');
    }

    public function inquiry()
    {
        return $this->hasMany(ChatbotInquiry::class, 'fk_id_visitorV','id_visitorV');
    }

}
