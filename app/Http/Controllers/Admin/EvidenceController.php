<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Model\Evidence;
use App\Model\EvidenceFile;
use App\Model\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvidenceController extends Controller
{
    public function store(Request $request){

      $case_id = $request->input('case_id');

       $evidence =  Evidence::create($request->all());
        if($request->hasFile('file')){
            $files = $request->file('file');



            $filePrefix = date("Y/m/d") . '/'."files";

            foreach ($files as $index => $file) {

                $file =  File::create([
                    'file_url' =>$file->storeAs($filePrefix,$file->getClientOriginalName(),'s3'),
                    'file_type' => explode('/',$file->getMimeType())[0]
                ]);

                if(!$evidence->files->contains($file->id)){
                    $evidence->files()->attach($file->id);
                  }
            }

        }

         return response()->json(true,200);
    }
}
