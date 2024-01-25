<?php

if(!empty($_GET['id'])){
    $userId = $_GET['id'];
    $detailUser = getFirstRow("SELECT * FROM users WHERE id='$userId'");
    if(!empty($detailUser)){
        $delete = delete('users', "id=$userId");
        if(!empty($delete)){
        setFlashData("msg", "Delete success !!!");
        setFlashData("type", "success");
        redirect('?module=users');    
        }

    }else{
        setFlashData("msg", "Couldn't be delete, ERORR DATABASE!!!");
        setFlashData("type", "danger");
        redirect('?module=users');
        die();
    }
}else{
    setFlashData("msg", "Couldn't be delete, ERORR URL!!!");
    setFlashData("type", "danger");
    redirect('?module=users');
    die();
}










?>