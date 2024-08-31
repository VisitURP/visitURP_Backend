<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class visitorsP_URP extends Model
{
    use SoftDeletes;
    protected $table='visitors_p__u_r_p_s';
    protected $primaryKey='id_visitorP';
    protected $fillable=['fk_docType_id','name','lastName','docNumber','email','visitDateP','fk_id_Province','fk_id_District','educationalInstitution'];

    public function setVisitDateAttribute($value)
    {
        $this->atributes['visitDateP']=Carbon::createFromFormat('d/m/y',$value)->format('Y-m-d H:i:s');

    }

}
