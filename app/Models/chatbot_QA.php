<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class chatbot_QA extends Model
{
    use SoftDeletes;
    protected $connection = 'visitAll'; // Use the visitAll connection
    protected $table = 'chatbot_question_answers'; // Specify the table name
    protected $primaryKey = 'QA_id';
    // Specify the fillable attributes
    protected $fillable = [ 
        'question',
        'answer', 
        'fk_category_id',
    ];
}
