<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CaseLink extends Model
{
    protected $table = 'case_links';

    protected $fillable = ['case_id','link','created_at','updated_at'];

}
