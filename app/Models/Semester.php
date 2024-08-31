<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use SoftDeletes;
    protected $table = 'semesters';
    protected $primaryKey = 'id_semester';
    protected $fillable = ['semesterName', 'until', ];

    public function visitV()
    {
        return $this->hasMany(visitV::class, 'fk_id_visitorV','id_visitorV');
    }

}
