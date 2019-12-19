<?php

use App\Logs;
use App\Linkstats;
use App\Userroles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

function add_log($data)
{
    $log = new Logs;
    $log->data = $data;
    $log->save();
}

function json_viewer($data)
{
    $json = str_replace('{', '', $data);
    $json = str_replace('}', '', $json);
    $json = str_replace(',', '<br>', $json);
    $json = str_replace(':', ' => ', $json);
    $json = str_replace('"', '', $json);
    return $json;
}

function sef_link($text){
    $find = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
    $degis = array("G","U","S","I","O","C","g","u","s","i","o","c");
    $text = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$text);
    $text = preg_replace($find,$degis,$text);
    $text = preg_replace("/ +/"," ",$text);
    $text = preg_replace("/ /","-",$text);
    $text = preg_replace("/\s/","",$text);
    $text = strtolower($text);
    $text = preg_replace("/^-/","",$text);
    $text = preg_replace("/-$/","",$text);
    return $text;
}

function lang_get($data)
{
    $data = str_replace(';', ',', $data);
    $data = explode(',', $data);
    return $data[0];
}

function link_stats(Request $request,$id)
{
    $link_stat = new Linkstats();
    $link_stat->links_id = $id;
    $link_stat->ip_address = $request->ip();
    $link_stat->browser = $request->headers->get('User-Agent');
    $link_stat->language = lang_get($request->server('HTTP_ACCEPT_LANGUAGE'));
    $link_stat->referer = $request->headers->get('referer') ?? "none";
    $link_stat->save();
}

function isRole($role_name)
{
    if (Auth::check()) {
        $role_check = Userroles::where('user_id', Auth::id())->where('role_name', $role_name)->first();

        if (!empty($role_check)) {
            return true;
        } else {
            return false;
        }

    } else {

        return false;

    }

}
