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


    if(empty($erorrs)){

        $dataInsert = [
            'name' => $data['name'],
            'createAt' => date("Y-m-d H:i:s")
        ];

        $statuInsert = insert('book_kind_of', $dataInsert);

        if($statuInsert){
            setFlashData('msg', 'Add kindof success !!!');
            setFlashData('type', 'success');
            redirect('?module=kindofs');
        }

    }else{
        setFlashData('msg', 'Check your form !!!');
        setFlashData('type', 'danger');
        setFlashData('erorrs', $erorrs);
        setFlashData('old', $data);
    }

    redirect("?module=kindofs&view=add#add");

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
    <hr>
    <input type="submit" value="submit" class="form-control btn btn-success">
    </div>


    </form>

    <button type="button" class="btn btn-warning mb-5"><a href="?module=kindofs&active=add#add" class="text-light">Re-enter</a></button>



