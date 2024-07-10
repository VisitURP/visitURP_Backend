<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserAreaVisit extends Model
{
    use SoftDeletes;
    protected $table = 'user_area_visits';
    protected $primaryKey = 'id_AreaVisit';
    protected $fillable = ['fk_id_userV', 'fk_id_builtArea', 'entered_at', 'exited_at', 'duration_seconds'];

    public function userV()
    {
        return $this->belongsTo(userV::class, 'fk_id_userV');
    }

    public function builtArea()
    {
        return $this->belongsTo(BuiltArea::class, 'fk_id_builtArea');
    }
}
