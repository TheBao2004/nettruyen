<?php

$data = [
    'nameTitle' => 'Fix user'
];

if(!empty($_GET['id'])){
    $userId = $_GET['id'];
    $detailUser = getFirstRow("SELECT * FROM users WHERE id='$userId'");
    if(!empty($detailUser)){

    }else{
        setFlashData("msg", "Couldn't be fix, ERORR DATABASE!!!");
        setFlashData("type", "danger");
        redirect('?module=users');
        die();
    }
}else{
    setFlashData("msg", "Couldn't be fix, ERORR URL!!!");
    setFlashData("type", "danger");
    redirect('?module=users');
    die();
}

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

echo $_SERVER['REQUEST_METHOD'];  



if(is_Post()){

    $data = getRequest();

    $userId = $data['id'];

    $erorrs = [];

    if(empty($data['fullname'])){
        $erorrs['fullname'] = 'Plase enter fullname !!!';
    }else{
         if(strlen($data['fullname']) < 5) $erorrs['fullname'] = "Fullname can't be less 5 char !!!";
    }

    if(empty($data['email'])){
        $erorrs['email'] = 'Please enter email !!!';
    }

    if(empty($data['status'])){
        $erorrs['status'] = 'Please choose status !!!';
    }

    if(empty($data['admin'])){
        $erorrs['admin'] = 'Please choose pormission !!!';
    }

    if(empty($erorrs)){

        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        if($data['status'] == 1){
            $status = 1;
        }else{
            $status = 0;
        }


        $dataUpdate = [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'status' => $status,
            'createAt' => date("Y-m-d H:i:s")
        ];

        if(!empty($data['password'])){
            $dataUpdate['password'] = $password;
        }

        $statuUpdate = update('users', $dataUpdate, "id='$userId'");

        if($statuUpdate){
            setFlashData('msg', 'Fix user success !!!');
            setFlashData('type', 'success');
            redirect('?module=users');
        }

    }else{
        setFlashData('msg', 'Check your form !!!');
        setFlashData('type', 'danger');
        setFlashData('erorrs', $erorrs);
        setFlashData('old', $data);
    }

    redirect("?module=users&active=fix&id=$userId#add");

}


$msg = getFlashData('msg');
$type = getFlashData('type');
$erorrs = getFlashData('erorrs');
$old = getFLashData('old');
if(empty($old)){
    $old = $detailUser;
    unset($old['password']);

    if($old['status'] == 0){
        $status = 2;
    }
}


?>

<div class="container mb-5" id="add">

    <form action="" method="post">

    <div class="form-group">
    <label for="exampleInputEmail1">Fullname</label>
    <input type="text" class="form-control" placeholder="Enter" name="fullname" value="<?php echo !empty($old['fullname'])?$old['fullname']:''; ?>">
    <?php if(!empty($erorrs['fullname'])) formErorr($erorrs['fullname']); ?>
    </div>

    <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="text" class="form-control" placeholder="Enter" name="email" value="<?php echo !empty($old['email'])?$old['email']:''; ?>">
    <?php if(!empty($erorrs['email'])) formErorr($erorrs['email']); ?>
    </div>
    
    <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input type="password" class="form-control" placeholder="If don't want change password, don't need to enter password" name="password" value="<?php echo !empty($old['password'])?$old['password']:''; ?>">
    <?php if(!empty($erorrs['password'])) formErorr($erorrs['password']); ?>
    </div>
    
    <div class="form-group">
    <label for="exampleInputEmail1">Status</label>
        <select name="status" id="" class="form-control">
            <option value="0">Choose</option>
            <option <?php echo !empty($status) && $status==1?'selected':''; ?> value="1">Status</option>
            <option <?php echo !empty($status) && $status==2?'selected':''; ?> value="2">No status</option>
        </select>
        <?php if(!empty($erorrs['status'])) formErorr($erorrs['status']); ?>
    </div>
    

    <input type="hidden" name="id" value="<?php echo $userId; ?>">

    <div class="form-group">
    <hr>
    <input type="submit" value="submit" class="form-control btn btn-success">
    </div>


    </form>

    <button type="button" class="btn btn-primary mb-5"><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="text-light">Lists users</a></button>


</div>


<?php

layout('footer', 'admin', $data);

?>