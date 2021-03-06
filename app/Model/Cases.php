<?php

namespace App\Model;

use App\Traits\GoogleCreateDocumentTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Cases extends Model
{


    use LogsActivity;


    protected $table = 'cases';

    protected $fillable = ['title','folder','user_id','topic_id','description','category_id','created_at','updated_at','google_document_id'];


    protected static $logAttributes = ['title', 'user_id','topic_id','description','category_id','created_at','updated_at','google_document_id'];

    public $folderLabels = [
	    'news_feed' => 'News Feed',
	    'cold_cases' => 'Cold Cases',
	    'archive' => 'Archive'
    ];

    public $statusLabels = [
	    'pending' => 'Pending',
		'in_progress' => 'In progress',
		'no_analysis' => 'No Analysis',
		'verified' => 'Verified',
    ];

    public function getStatusLabelAttribute(){
        return $this->statusLabels[$this->status];
    }

    protected $dates = ['created_at', 'updated_at'];

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
        return $this->belongsToMany('App\Model\Tag','case_tags','case_id','tag_id');
    }

    public function evidences(){
        return $this->hasMany('App\Model\Evidence','case_id','id')->orderBy('created_at','desc');
    }

    public function activities(){
        return $this->hasMany('App\Model\Activity','case_id','id')->orderBy('created_at','asc');
    }

    public function files(){
        return $this->belongsToMany('App\Model\File','case_files','case_id','file_id')->withTimestamps();
    }


    public function links(){
        return $this->belongsToMany('App\Model\Link','case_links','case_id','link_id')->withTimestamps();
    }



}
