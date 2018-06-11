<?php
require_once('./_config.php');

function list_names($app_ip) {
    global $app_hostname;
    $options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "frontend", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 1,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
        CURLOPT_RESOLVE        => array($app_hostname:80:$app_ip);
    ); 
    $names_url = "http://" . $app_hostname . "/api/names";
    $ch = curl_init($names_url);
    curl_setopt_array($ch, $options);
    $raw_names = curl_exec($ch);
    curl_close($ch);
    # list all names
    $raw_names = str_replace('[', '', $raw_names);
    $raw_names = str_replace(']', '', $raw_names);
    $raw_names = str_replace('"', '', $raw_names);
    $names = explode(',', $raw_names);
    return $names;
}
?>
