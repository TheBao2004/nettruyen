<?php

$data = getRequest('get');

if(!empty($data['id_book']) && !empty($data['id'])){
    $bookId = $data['id_book'];
    $userId = $data['id'];
    
    $detailFollwor = getFirstRow("SELECT * FROM follwor WHERE id_book='$bookId' AND id_user='$userId'");

    if(!empty($detailFollwor)){
        delete('follwor', " id_book='$bookId' AND id_user='$userId'");
    }else{
        $dataInsert = [
            'id_user' => $userId,
            'id_book' => $bookId,
            'createAt' => date("Y-m-s H:i:s")
        ];
        insert('follwor', $dataInsert);
    }

    redirect('?module=books&active=detail&id='.$bookId);

}else{
    setFlashData('msg', "Counldn't be see, ERORR URL");
    setFlashData('type', 'danger');
    redirect(_WEB_HOST_ROOT);
}





?>