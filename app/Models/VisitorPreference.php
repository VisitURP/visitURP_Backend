<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VisitorPreference extends Model
{
    use SoftDeletes;
    
    protected $table = 'visitor_preferences';

    protected $primaryKey = 'id_visitorPreference';

    protected $fillable = ['fk_id_visitorV', 'fk_id_visitorP', 'fk_id_academicInterested', 'visitor_type'];

    public function visitor()
    {
        if ($this->visitor_type == 'V') {
            return $this->belongsTo(VisitorV::class, 'fk_id_visitorV');
        } elseif ($this->visitor_type == 'P') {
            return $this->belongsTo(VisitorP::class, 'fk_id_visitorP');
        }
        return null;
    }

    public function academicInterest()
    {
        return $this->belongsTo(AcademicInterest::class, 'fk_id_academicInterest', 'id_academicInterest');
    }
}
