<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VisitorInfoxapplicant extends Model
{
    use SoftDeletes;
    protected $table = 'visitor_info_xapplicants'; 
    protected $primaryKey = 'id_visitorInfoXapplicant';
    // Specify the fillable attributes
    protected $fillable = [
        'fk_id_applicant', 
        'fk_id_visitorInfo', 
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'fk_id_applicant');
    }

    public function visitorInfo()
    {
        return $this->belongsTo(VisitorInfo::class, 'fk_id_visitorInfo');
    }
}
