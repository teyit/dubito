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




function clickableLink($s){
    //TODO fix links.
    return $s;
    return preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $s);


}


function findLinkFromText($s){
     preg_match('/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', $s,$matches);

     return $matches;
}


function moveToS3Link($filePrefix,$fileName,$link){
    return \Illuminate\Support\Facades\Storage::disk('s3')->put($filePrefix.'/'.$fileName.".jpg", file_get_contents($link));
}

function add_quotes($str) {
    return  '"'.$str.'"';
}

function array_remove_by_value($array, $value)
{
    return array_values(array_diff($array, array($value)));
}

function holds_int($str)
{
    return preg_match("/^-?[0-9]+$/", $str);
}
