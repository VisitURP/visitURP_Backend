<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class visitorP extends Model
{
    use SoftDeletes;
    const TYPE1 = 'V';
    const TYPE2 = 'P';
    const TYPE3 = 'I';
    
    protected $table = 'visitor_p_s';
    protected $primaryKey = 'id_visitorP';
    protected $fillable = ['name', 'lastName', 'email','fk_docType_id', 'docNumber', 'phone', 'visitDate', 'cod_Ubigeo', 
    'educationalInstitution', 'birthDate', 'gender'];

    public function setVisitDateAttribute($value)
    {
        $this->attributes['visitDate'] = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d H:i:s');
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birthDate'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function docType()
    {
        return $this->hasMany(docType::class, 'fk_docType_id');
    }
}
