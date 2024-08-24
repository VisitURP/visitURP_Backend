<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VisitorInfo extends Model
{
    use SoftDeletes;
    protected $table = 'visitor_infos';
    protected $primaryKey = 'id_visitorInfo';
    protected $fillable = ['name', 'lastName', 'email','fk_docType_id', 'documentNumber', 'phone', 'fk_id_visitor','visitor_type', 'typeOfVisitor'];

    public function docType()
    {
        return $this->belongsTo(docType::class, 'fk_docType_id');
    }
}
