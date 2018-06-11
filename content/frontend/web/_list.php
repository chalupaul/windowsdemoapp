<?php
require_once('./_config.php');

function list_names($app_hostname) {
    # list all names
    $names_url = "http://" . $app_hostname . "/api/names";
    $raw_names = file_get_contents($names_url);
    $raw_names = str_replace('[', '', $raw_names);
    $raw_names = str_replace(']', '', $raw_names);
    $raw_names = str_replace('"', '', $raw_names);
    $names = explode(',', $raw_names);
    return $names;
}
?>
