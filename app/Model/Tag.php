<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected  $table = 'tags';

    
    protected  $fillable = ['title','created_at','updated_at'];
}
