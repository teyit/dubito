<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table ='links';

    protected $fillable = ['id','link','meta_title','meta_description','image','teyitlink_slug','created_at','updated_at'];

    protected static $logAttributes = ['link','created_at','updated_at'];

}
