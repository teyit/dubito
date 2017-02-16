<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    
    protected $fillable = ['title','case_id','source','created_at','updated_at'];
}
