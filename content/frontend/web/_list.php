<?php
require_once('./_config.php');
require_once('./_curl.php');

function list_names() {
    $raw_names = get_curl();
    # list all names
    if ($raw_names == '') {
        return(list_names());
    } else {
        $raw_names = str_replace('[', '', $raw_names);
        $raw_names = str_replace(']', '', $raw_names);
        $raw_names = str_replace('"', '', $raw_names);
        $names = explode(',', $raw_names);
        return $names;
    }
}
?>
