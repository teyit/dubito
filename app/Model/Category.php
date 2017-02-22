<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';


    protected $fillable = ['title','created_at','updated_at'];



    public function cases(){
        return $this->hasMany('App\Model\Cases','category_id','id');
    }
}
