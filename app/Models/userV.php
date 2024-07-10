<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class userV extends Model
{
    use SoftDeletes;
    protected $table = 'user_v_s';
    protected $primaryKey = 'id_userV';
    protected $fillable = ['name', 'email'];

    public function userAreaVisit()
    {
        return $this->hasMany(UserAreaVisit::class, 'fk_id_userV', 'id_userV');
    }
}
