<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VisitorInfo extends Model
{
    use SoftDeletes;
    protected $table = 'visitor_p_s';
    protected $primaryKey = 'id_visitorInfo';
    protected $fillable = ['name', 'lastName', 'email','fk_docType_id', 'documentNumber', 'phone', 'fk_id_visitor','visitor_type', 'typeOfVisitor'];

    public function docType()
    {
        return $this->belongsTo(docType::class, 'fk_docType_id');
    }

    public function visitor()
    {
        if ($this->visitor_type == 'V') {
            return $this->belongsTo(VisitorV::class, 'fk_id_visitor');
        } elseif ($this->visitor_type == 'P') {
            return $this->belongsTo(VisitorP::class, 'fk_id_visitor');
        } elseif ($this->visitor_type == 'B') {
            
        }
        return null;
    }
}
