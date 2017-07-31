<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\Google\GoogleDocument;
use App\Model\CaseLink;
use App\Model\Category;
use App\Model\PressReview;
use App\Model\Link;
use App\Model\Evidence;
use App\Model\Message;
use App\Model\Report;
use App\Model\Tag;
use App\Model\Topic;
use App\Traits\GoogleCreateDocumentTrait;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cases;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{


    protected $redirect = 'cases';
    public function press_review($case_id,Request $request){
        if(!$request->has(['id','status','url'])){
            return '0';
        }
        $pr = PressReview::where('case_id',$case_id)->where('press_id',$request->get('id'))->first();
        if(!$pr){
            $pr = new PressReview();
        }

        $pr->case_id = $case_id;
        $pr->press_id = $request->get('id');
        $pr->status = $request->get('status');
        $pr->save();

        if($pr->status == 1){
            $case = Cases::with('links')->where('id',$case_id)->first();
            if(!$case){
                return "0";
            }
            $url = $request->get('url');
            $title = $request->get('title');

            $l= $case->whereHas('links', function ($query) use ($url){
                $query->where('link', $url);
            })->first();

            if(!$l){
                $link = new Link();
                $link->link = $url;
                $link->meta_title = $title;
                $link->save();
                $case->links()->attach($link->id);
            }

        }

        return '1';
    }
    public function press($case_id,Request $request){

        if($request->has(['text','daterange'])){
            $pressReviews = PressReview::where('case_id',$case_id)->get()->pluck('press_id')->toArray();

            $range = explode("-",$request->get('daterange'));

            $from = trim($range[0]);
            $to = trim($range[1]);

            $fullResults = $this->pressQuery($request->get('text'),$from,$to);
            $finalResults = [];
            foreach($fullResults as $r){
                if(!in_array($r['id'],$pressReviews)){
                    $finalResults[] = $r;
                }
            }

            return view('case.sections.press-results',['results' => $finalResults]);
        }
    }
    private function pressQuery($text,$from,$to){
        $client = \Elasticsearch\ClientBuilder::create()
            ->setHosts([
                'https://search-rss-service-2k5fqi4v7p6k6j44pdese5vagu.eu-central-1.es.amazonaws.com:443'
            ])
            ->build();

        $params = [
            'index' => 'rss_feed',
            'type' => 'rss_item',
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'multi_match' => [
                                    'query' => $text,
                                    'fuzziness' => 10,
                                    'fields' => ['doc.title^10','doc.description']
                                ]
                            ],[
                                'range' => [
                                    'doc.date' => [
                                        'gt' => $from,
                                        'lt' => $to,
                                        'format' => 'MM/dd/yyyy'
                                    ]
                                ]
                            ]

                        ]
                    ]
                ]
            ],
            'sort' => [
                '_score'
            ],
            'size' => 100
        ];

        $response = $client->search($params);
        $hits = array_get($response,'hits.hits');
        $pressResults = [];
        foreach($hits as $h){
            $data = $h['_source']['doc'];
            $data['score'] = $h['_score'];
            $data['id'] = $h['_id'];
            $pressResults[] = $data;
        }
        return $pressResults;

    }
    public function index($is_archived){

        $topics = Topic::latest()->get();
        $is_archived = $is_archived == "backlog" ? 'is_in_backlog' : $is_archived;
        $cases = Cases::where('is_archived',$is_archived)->orderBy("created_at","DESC")->get();
        $categories = Category::latest()->get();

        return view("case.index",compact("cases",'topics','categories'));
    }

    public function create(){
        $topics = Topic::latest()->get();
        $cases = Cases::latest()->get();
        return view("case.create",compact("cases",'topics'));
    }

    public function store(Request $request){

    	//$request['user_id'] = Auth::user()->id;

        $store = $request->all();
        $case = Cases::create($store);
        $case->save();


        return redirect('/cases/' . $case->id);

    }


    public function edit($id){

        $case = Cases::find($id);
        $categories = Category::latest()->get();
        $topics = Topic::latest()->get();

        return [
            'case' => $case,
            'categories' => $categories,
            'topics' => $topics
        ];
    }



    public function show($id){

        $case = Cases::with('reports','evidences','user')->find($id);

        $links = $case->links()->get();
        $selectedTags= array_pluck($case->tags()->get()->toArray(),'id');
        $allTags  = Tag::latest()->get();
        $users = User::latest()->get();
        return view('case.show',compact('users','case','selectedTags','allTags','links','evidences'));
    }

    public function update($id,Request $request){

        $case = Cases::find($id);
        $case->update($request->all());
        return response()->json('true',200);
    }




    public function destroy($id){
        $case = Cases::find($id);
        $case->delete();
        return response()->json(true,200);


    }


    public function addCaseTag(Request $request,$caseID){

        $case = Cases::find($caseID);
        $tags = $request->input('tags');
        if(!is_array($tags)){
            $tags = [];
        }

        $case->tags()->sync($tags);
        return response()->json(true,200);

    }

    public function addCaseFile(Request $request,$caseID){
        $case = Cases::find($caseID);
        $file = $request->input('file_id');

        if(!$case->files->contains($file)){
           $case->files()->attach($file);
            return response()->json(true,200);
        }
        return response()->json(false,200);

    }


    public function removeCaseFile(Request $request,$caseID){
        $case = Cases::find($caseID);
        $file = $request->input('file_id');
        $case->files()->detach($file);
        return response()->json(true,200);

    }


    public function caseStatusUpdate(Request $request,$caseID){
        $case = Cases::find($caseID);
        $status = $request->input('status');
        $case->status = $status;
        $case->save();

        return response()->json(true,200);

    }
    
    public function assignUserToCase(Request $request,$caseID){
        $case = Cases::find($caseID);
        $case->user_id = $request->input('value');
        $case->save();
        return response()->json($case->user,200);

    }

    public function changeTitle(Request $request,$caseID){
        $case = Cases::find($caseID);
        $case->title = $request->input('value');
        $case->save();
        return response()->json($case,200);

    }



    public function caseSendToArchive(Request $request,$caseID){
        $case = Cases::find($caseID);
        $case->is_archived = $request->input('is_archived');
        $case->save();
        return response()->json(true,200);
    }


}
