<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class docType extends Model
{
    use SoftDeletes;
    protected $table = 'doc_types';
    protected $primaryKey = 'id_docType';
    protected $fillable = ['docTypeName', 'docTypeCode'];

    public function VisitorV()
    {
        return $this->belongsTo(VisitorV::class, 'fk_docType_id');
    }

    public function VisitorP()
    {
        return $this->belongsTo(visitorP::class, 'fk_docType_id');
    }
}
