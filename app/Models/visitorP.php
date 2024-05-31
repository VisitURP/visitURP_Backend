<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class visitorP extends Model
{
    use SoftDeletes;
    protected $table = 'visitor_p_s';
    protected $primaryKey = 'id_visitorP';
    protected $fillable = ['name', 'lastName', 'email','fk_docType_id', 'docNumber', 'phone', 'visitDate', 'residentDistrict', 'educationalInstitution','interestCareer'];
}
