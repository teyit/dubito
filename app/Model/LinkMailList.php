<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class LinkMailList extends Model
{
    use LogsActivity;

	protected  $table = 'link_mail_list';

	protected $fillable = ['id','link','name','email','created_at','updated_at'];

    protected static $logAttributes = ['id','link','name','email','created_at','updated_at'];

}
