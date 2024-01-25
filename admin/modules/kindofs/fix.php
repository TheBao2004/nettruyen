<?php

echo $_SERVER['REQUEST_METHOD'];    

if(!empty($_GET['id'])){
    $kindofId = $_GET['id'];
    $detailKindOf = getFirstRow("SELECT * FROM book_kind_of WHERE id='$kindofId'");
    if(!empty($detailKindOf)){

    }else{
        setFlashData("msg", "Couldn't be fix, ERORR DATABASE!!!");
        setFlashData("type", "danger");
        redirect('?module=kindofs');
        die();
    }
}else{
    setFlashData("msg", "Couldn't be fix, ERORR URL!!!");
    setFlashData("type", "danger");
    redirect('?module=kindofs');
    die();
}

if(is_Post()){

    $data = getRequest();

    $kindofId = $data['id'];

    $erorrs = [];

    if(empty($data['name'])){
        $erorrs['name'] = 'Please enter name !!!';
    }else{
         if(strlen($data['name']) < 5) $erorrs['name'] = "Name can't be less 5 char !!!";
    }


    if(empty($erorrs)){

        $dataUpdate = [
            'name' => $data['name'],
            'createAt' => date("Y-m-d H:i:s")
        ];

        $statusUpdate = update('book_kind_of', $dataUpdate, "id='$kindofId'");

        if($statusUpdate){
            setFlashData('msg', 'Fix kindof success !!!');
            setFlashData('type', 'success');
            redirect('?module=kindofs');
        }

    }else{
        setFlashData('msg', 'Check your form !!!');
        setFlashData('type', 'danger');
        setFlashData('erorrs', $erorrs);
        setFlashData('old', $data);
    }

    redirect("?module=kindofs&view=fix&id=$kindofId");

}


$msg = getFlashData('msg');
$type = getFlashData('type');
$erorrs = getFlashData('erorrs');
$old = getFLashData('old');
if(empty($old)){
    $old = $detailKindOf;
}

?>

    <h3>Fix</h3>

    <form action="" method="post">

    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" placeholder="Enter" name="name" value="<?php echo !empty($old['name'])?$old['name']:''; ?>">
    <?php if(!empty($erorrs['name'])) formErorr($erorrs['name']); ?>
    </div>

    <input type="hidden" name="id" value="<?php echo $kindofId; ?>">


    <div class="form-group">
    <hr>
    <input type="submit" value="submit" class="form-control btn btn-success">
    </div>


    </form>

    <button type="button" class="btn btn-warning mb-5"><a href="?module=kindofs&view=add" class="text-light">Re-enter</a></button>
    <button type="button" class="btn btn-success mb-5"><a href="?module=kindofs&view=add" class="text-light">Add</a></button>



