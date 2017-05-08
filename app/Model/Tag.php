<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Tag extends Model
{
    use LogsActivity;


    protected  $table = 'tags';

    
    protected  $fillable = ['title','created_at','updated_at'];

    protected static $logAttributes = ['title','created_at','updated_at'];


}
