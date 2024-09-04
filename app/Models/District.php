<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use SoftDeletes;
    protected $table = 'districts';
    protected $primaryKey = 'id_district';
    protected $fillable = ['districtName', 'fk_province_id'];
}
