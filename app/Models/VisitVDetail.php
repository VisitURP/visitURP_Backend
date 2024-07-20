<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VisitVDetail extends Model
{
    use SoftDeletes;
    
    protected $table = 'visit_v_details';

    public $incrementing = false;

    // Deshabilitar la clave primaria por defecto (id)
    protected $primaryKey = null;

    protected $primaryKeyColumns = ['id_visitorV', 'id_visitV'];
    protected $fillable = ['id_visitorV','id_visitV','fk_id_builtArea','kindOfEvent','get','DateTime'];


    public function visitV()
    {
        return $this->belongsTo(VisitV::class, 'id_visitV');
    }

    public function visitor()
    {
        return $this->belongsTo(VisitorV::class, 'id_visitorV');
    }

    public function builtArea()
    {
        return $this->belongsTo(BuiltArea::class, 'fk_id_builtArea');
    }
    
    // Métodos personalizados para manejar la clave primaria compuesta
    public static function find($id_visitor, $id_visit)
    {
        return self::where('id_visitorV', $id_visitor)->where('id_visitV', $id_visit)->first();
    }
}
