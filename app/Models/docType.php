<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class docType extends Model
{
    use SoftDeletes;
    protected $table = 'docTypes';
    protected $primaryKey = 'id_docType';
    protected $fillable = ['docTypeName', 'docTypeCode'];
}
