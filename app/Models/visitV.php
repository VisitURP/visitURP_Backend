<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class visitV extends Model
{
    use SoftDeletes;
    protected $table = 'visit_v_s';
    protected $primaryKey = 'id_visitV';
    protected $fillable = ['fk_id_visitorV'];


    public function visitorV()
    {
        return $this->belongsTo(VisitorV::class, 'fk_id_visitorV');
    }

    public function visitVDetail()
    {
        return $this->hasMany(VisitVDetail::class, 'fk_id_visitV', 'id_visitV');
    }
}
