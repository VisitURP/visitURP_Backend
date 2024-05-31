<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class visitorP extends Model
{
    use SoftDeletes;
    protected $table = 'visitor_p_s';
    protected $primaryKey = 'id_visitorP';
    protected $fillable = ['name', 'lastName', 'email','fk_docType_id', 'docNumber', 'phone', 'visitDate', 'residentDistrict', 'educationalInstitution','interestCareer'];

    public function setVisitDateAttribute($value)
    {
        $this->attributes['visitDate'] = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d H:i:s');
    }
}
