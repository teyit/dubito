<?php



function isUrl($url){
    if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
        return true;
    } else {
        return false;
    }
}




function ConverterFileLink($url){
        if(isUrl($url)){
            return $url;
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($url);
    }

