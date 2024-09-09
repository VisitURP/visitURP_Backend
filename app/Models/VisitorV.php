<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VisitorV extends Model
{
    use SoftDeletes;
    const TYPE1 = 'V';
    const TYPE2 = 'P';
    const TYPE3 = 'I';

    protected $table = 'visitor_v_s';
    protected $primaryKey = 'id_visitorV';
    
    protected $fillable = [
        'name', 
        'email', 
        'lastName', 
        'fk_docType_id', 
        'documentNumber', 
        'phone',
        'fk_id_Ubigeo',
        'educationalInstitution',
        'birthDate',
        'gender'
    ];

    public function docType()
    {
        return $this->hasMany(docType::class, 'fk_docType_id');
    }

    public function visitV()
    {
        return $this->hasMany(visitV::class, 'fk_id_visitorV','id_visitorV');
    }

    //Falta agregar Ubigeo
}
