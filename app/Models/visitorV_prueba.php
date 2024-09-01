<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class visitorV_prueba extends Model
{
    use SoftDeletes;

    protected $table = 'visitor_v_pruebas';
    protected $primaryKey = 'id_visitorV';

    protected $fillable = [
        'name', 
        'email', 
        'lastName', 
        'fk_docType_id', 
        'documentNumber', 
        'phone',
        'fk_id_Province',
        'fk_id_District',
        'educationalInstitution'
    ];
    public function docType()
    {
        //return $this->hasMany(docType::class, 'fk_docType_id');
    }

    public function visitV()
    {
        return $this->hasMany(visitV::class, 'fk_id_visitorV','id_visitorV');
    }

    public function inquiry()
    {
        return $this->hasMany(ChatbotInquiry::class, 'fk_id_visitorV','id_visitorV');
    }

    public function province()
    {
        //return $this->belongsTo(Province::class, 'fk_id_Province','');
    }

    public function district()
    {
        //return $this->belongsTo(District::class, 'fk_id_District','');
    }
}
