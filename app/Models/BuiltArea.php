<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BuiltArea extends Model
{
    use SoftDeletes;
    protected $table = 'built_areas';
    protected $primaryKey = 'id_builtArea';
    protected $fillable = ['fk_id_academicInterest', 'builtAreaName','builtAreaCod', 'builtAreaDescription'];

    public function academicInterest()
    {
        return $this->belongsTo(AcademicInterest::class, 'fk_id_academicInterest', 'id_academicInterest');
    }
}


