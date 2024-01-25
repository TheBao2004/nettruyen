<?php

function setSession($key, $value=''){
    if(!empty(session_id())){
        $_SESSION[$key] = $value;
        return true;
    }
    return false;
}


function getSession($key=''){

if(!empty($key)){
 if(!empty($_SESSION[$key])){
        return $_SESSION[$key];
    }else{
        return false;
    }
}else{

    return $_SESSION;

}
    return false;
}

function removeSession($key=''){

    if(!empty($key)){
        unset($_SESSION[$key]);
        return true;
    }else{
        session_destroy();
        return true;
    }
    return false;

}

function setFlashData($key='', $value=''){
    $key = 'flash_'.$key;

    if($key){
        setSession($key, $value);
        return true;
    }

    return false;

}

function getFlashData($key=''){
    $key = 'flash_'.$key;
    $data = getSession($key);
    removeSession($key);
    return $data;

}



?>