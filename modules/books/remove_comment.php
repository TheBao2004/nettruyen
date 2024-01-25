<?php

if(!empty($_GET['id'])){
    $commentId = $_GET['id'];
    $detailComment = getFirstRow("SELECT * FROM comments WHERE id='$commentId'");

    if(!empty($detailComment)){
        removeComment($commentId);
        // if(!empty($statusDelete)){
            setFlashData('msg', "Remove comment success !!!");
            setFlashData('type', "success");
            redirect($_SERVER['HTTP_REFERER'].'#comment');
            die();
        // }
    }else{
        setFlashData('msg', "Couldn't be to remove comment, ERORR DATABASE !!!");
        setFlashData('type', "danger");
        redirect($_SERVER['HTTP_REFERER'].'#comment');
        die();
    }
}else{
    setFlashData('msg', "Couldn't be to remove comment, ERORR URL !!!");
    setFlashData('type', "danger");
    redirect($_SERVER['HTTP_REFERER'].'#comment');
    die();
}



?>