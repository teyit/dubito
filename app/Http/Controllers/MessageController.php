<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Model\Report;
use App\Model\ReportFile;
class MessageController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function facebook(Request $request)
    {

        foreach($request->get('entry') as $e){
            foreach($e['messaging'] as $m){
                $r = new Report;
                $r->source = 'facebook';
                $r->external_user_id = $m['sender']['id'];
                $r->external_message_id = $m['message']['mid'];
                $r->text = $m['message']['text'];
                $r->account_name = 'Placeholder';
                $r->status = 'not_resulted';
                $r->save();
                foreach($m['message']['attachments'] as $a){
                    $rf = new ReportFile;
                    $rf->report_id = $r->id;
                    $rf->file_url = $a['type'];
                    $rf->file_type = $a['file']['url'];
                    $rf->save();
                }

            }

        }
        return "OK";
    }
    public function twitter()
    {
        return "OK";   
    }
}
