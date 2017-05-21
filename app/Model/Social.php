<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{

    protected $table = 'social_logins';

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
}
