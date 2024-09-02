<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VisitorInfo extends Model
{
    use SoftDeletes;
    protected $table = 'visitor_infos';
    protected $primaryKey = 'id_visitorInfo';
    protected $fillable = ['id_visitorInfo', 'fk_id_visitor','visitor_type', 'typeOfVisitor'];

}
