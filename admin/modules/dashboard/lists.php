<?php

$data = [
    'nameTitle' => 'Dashboard'
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);


//echo '<pre>';
//print_r(curl_version());
//echo '</pre>';

layout('footer', 'admin', $data);

?>