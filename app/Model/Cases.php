<?php

namespace App\Model;

use App\Traits\GoogleCreateDocumentTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Elasticsearch\ClientBuilder;

class Cases extends Model
{


    use LogsActivity;
    use GoogleCreateDocumentTrait;


    protected $table = 'cases';

    protected $fillable = ['title','user_id','topic_id','description','category_id','created_at','updated_at','google_document_id'];


    protected static $logAttributes = ['title', 'user_id','topic_id','description','category_id','created_at','updated_at','google_document_id'];

    public $statusLabels = [
        'in_progress' => 'In Progress',
        'no_analysis' => 'No Analysis',
        'cancelled' => 'Cancelled',
        'suspended' => 'Suspended',
        'to_be_tweeted' => 'To be Tweeted',
        'pending' => 'Pending'
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
        return $this->hasMany('App\Model\Evidence','case_id','id');
    }


    public function files(){
        return $this->belongsToMany('App\Model\File','case_files','case_id','file_id')->withTimestamps();
    }


    public function links(){
        return $this->belongsToMany('App\Model\Link','case_links','case_id','link_id')->withTimestamps();
    }

    public function press(){
        $client = ClientBuilder::create()
            ->setHosts([
                'https://search-rss-service-2k5fqi4v7p6k6j44pdese5vagu.eu-central-1.es.amazonaws.com:443'
            ])
            ->build();

        $params = [
            'index' => 'rss_feed',
            'type' => 'rss_item',
            'body' => [
                'query' => [
                    'match' => [
                        'doc.title' => $this->title
                    ]
                ]
            ],
            'size' => 100
        ];

        $response = $client->search($params);
        $hits = array_get($response,'hits.hits');
        $pressResults = [];
        foreach($hits as $h){
            $data = $h['_source']['doc'];
            $data['score'] = $h['_score'];
            $pressResults[] = $data;
        }
        return $pressResults;

    }

}
