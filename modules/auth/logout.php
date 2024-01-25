<?php

$token = getSession('login');

removeSession('login');

delete('login_token', "token='$token'");

redirect('?module=auth&active=login');

?>