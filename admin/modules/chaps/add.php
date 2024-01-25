<?php

echo $_SERVER['REQUEST_METHOD'];    

if(is_Post()){

    $data = getRequest();

    $erorrs = [];

    if(empty($data['name'])){
        $erorrs['name'] = 'Please enter name !!!';
    }else{
         if(strlen($data['name']) < 5) $erorrs['name'] = "Name can't be less 5 char !!!";
    }

    $stt_chap = $data['stt_chap'];

    if(empty($data['stt_chap'])){
        $erorrs['stt_chap'] = 'Please enter stt chap !!!';
    }else{
         if(!preg_match_all('/\d/', $stt_chap)){
            $erorrs['stt_chap'] = "Please enter number int !!!";
         }else{
            if(getCountRows("SELECT id FROM chap WHERE stt_chap='$stt_chap' AND id_book='$bookId'")){
                $erorrs['stt_chap'] = "This number already in the database !!!";
            }
         } 
    }


    if(empty($erorrs)){

        $dataInsert = [
            'name' => $data['name'],
            'stt_chap' => $stt_chap,
            'id_book' => $data['id_book'],
            'createAt' => date("Y-m-d H:i:s")
        ];

        $statuInsert = insert('chap', $dataInsert);

        if($statuInsert){
            setFlashData('msg', 'Add chap success !!!');
            setFlashData('type', 'success');
            redirect('?module=chaps&id_book='.$bookId);
        }

    }else{
        setFlashData('msg', 'Check your form !!!');
        setFlashData('type', 'danger');
        setFlashData('erorrs', $erorrs);
        setFlashData('old', $data);
    }

    redirect("?module=chaps&view=add&id_book=$bookId#add");

}


$msg = getFlashData('msg');
$type = getFlashData('type');
$erorrs = getFlashData('erorrs');
$old = getFLashData('old');


?>

    <h3>Add</h3>

    <form action="" method="post">

    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" placeholder="Enter" name="name" value="<?php echo !empty($old['name'])?$old['name']:''; ?>">
    <?php if(!empty($erorrs['name'])) formErorr($erorrs['name']); ?>
    </div>

    <div class="form-group">
    <label for="exampleInputEmail1">Stt chap</label>
    <input type="text" class="form-control" placeholder="Enter" name="stt_chap" value="<?php echo !empty($old['stt_chap'])?$old['stt_chap']:''; ?>">
    <?php if(!empty($erorrs['stt_chap'])) formErorr($erorrs['stt_chap']); ?>
    </div>

    <input type="hidden" name="id_book" value="<?php echo $bookId; ?>">





    <div class="form-group">
    <hr>
    <input type="submit" value="submit" class="form-control btn btn-success">
    </div>


    </form>




