<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

    protected $table = 'categories';


    protected $fillable = ['title','created_at','updated_at'];


    protected static $logAttributes = ['title', 'created_at','updated_at'];




    public function cases(){
        return $this->hasMany('App\Model\Cases','category_id','id');
    }
}
