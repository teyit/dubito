<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CaseFile extends Model
{
    protected $table = 'case_files';


    protected $fillable = ['case_id','file_id'];


}
