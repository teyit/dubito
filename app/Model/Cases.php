<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $table = 'cases';


    protected $fillable = ['title','topic_id','category_id','created_at','updated_at'];


    public function topic(){
      return $this->belongsTo(Topic::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function reports(){
        return $this->hasMany('App\Model\Report','case_id','id');
    }

}
