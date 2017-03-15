<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $table = 'cases';


    protected $fillable = ['title','user_id','topic_id','description','category_id','created_at','updated_at'];


    public function topic(){
      return $this->belongsTo(Topic::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function reports(){
        return $this->hasMany('App\Model\Report','case_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function tags(){
        return $this->belongsToMany('App\Model\Tag','case_tag','case_id','tag_id');
    }

    public function links(){
        return $this->hasMany('App\Model\CaseLink','case_id','id');
    }

}
