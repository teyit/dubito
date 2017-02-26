<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = "topics";

    protected $fillable = ["title","created_at","updated_at"];


    public function cases(){
        return $this->hasMany(Cases::class);
    }
}
