<?php

function get_dir_url_code($gender = GENDER_BOY, $m = 2949, $t=null)
{
    return get_dir_url($gender, from_code($m, $t));
}

function get_dir_url($gender, $prefix, $sub = '')
{
    return site_url("prefix/".$sub.$prefix."/$gender");
}

function get_url_of_page($url, $page_id, $gender = null)
{
    $url = preg_replace('@\/page\/(.+?)\/@iU', '/page/'.$page_id.'/', $url);

    if (!is_null($gender))
    {
        $url = str_ireplace('/boy', '/'.$gender, $url);
        $url = str_ireplace('/girl', '/'.$gender, $url);
    }
    return $url;
}

?>
