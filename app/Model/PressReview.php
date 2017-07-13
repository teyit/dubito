<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PressReview extends Model
{
	use LogsActivity;


	protected $table = 'press_reviews';

	protected $fillable = ['case_id','press_id','status'];

	protected static $logAttributes = ['case_id','press_id','status'];
}
