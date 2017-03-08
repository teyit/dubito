<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CaseTag extends Model
{
    protected $table = 'case_tag';


    protected $fillable = ['case_id','tag_id','created_at','updated_at'];



}
