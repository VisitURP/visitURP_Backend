<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class chatbot_categories extends Model
{
    use SoftDeletes;
    protected $connection = 'visitAll'; // Use the visitAll connection
    protected $table = 'chatbot_categories'; // Specify the table name
    protected $primaryKey = 'category_id';
    // Specify the fillable attributes
    protected $fillable = [
        'categoryName', 
        'categoryCod', 
    ];
}
