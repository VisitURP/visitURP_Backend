<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AcademicInterest extends Model
{
    use SoftDeletes;
    protected $table = 'academic_interests';
    protected $primaryKey = 'id_academicInterest';
    protected $fillable = ['academicInterestName', 'academicInterestCod'];
}
