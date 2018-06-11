<?php
function get_curl() {
    global $app_hostname;
    global $names_ip_list;
    $names_ip = $names_ip_list[mt_rand(0, count($names_ip_list) - 1)];
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
        CURLOPT_HTTPHEADER     => array("Host: " . $app_hostname)
    );
    $names_url = "http://" . $names_ip . "/api/names";
    $ch = curl_init($names_url);
    curl_setopt_array($ch, $options);
    $raw_names = curl_exec($ch);
    curl_close($ch);
    return($ran_names);
}
?>
