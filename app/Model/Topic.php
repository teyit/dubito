<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Topic extends Model
{
    use LogsActivity;


    protected $table = "topics";



    protected $fillable = ["title","created_at","updated_at"];


    protected static $logAttributes = ["title","created_at","updated_at"];


    public function cases(){
        return $this->hasMany(Cases::class);
    }
}
