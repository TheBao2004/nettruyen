<?php

$data = [
    'nameTitle' => 'Register'
];

layout('header_login', 'client', $data);


if(is_Post()){

    $data = getRequest();

    $erorrs = [];

    if(empty($data['fullname'])){
        $erorrs['fullname'] = 'Plase enter fullname !!!';
    }else{
         if(strlen($data['fullname']) < 5) $erorrs['fullname'] = "Fullname can't be less 5 char !!!";
    }

    if(empty($data['email'])){
        $erorrs['email'] = 'Please enter email !!!';
    }else{
        $pattern = '~^[a-z][\w]+\@[\w\.]+\.[a-z]{2,}$~';
        if(!preg_match($pattern, $data['email'])){
            $erorrs['email'] = "This isn't email !!!";
        }
    }

    if(empty($data['password'])){
        $erorrs['password'] = 'Please enter password !!!';
    }

    if(!empty($data['password'] && ($data['password'] != $data['comfirm']))){
        $erorrs['comfirm'] = 'Comfirm not alike password !!!';
    }


    if(empty($erorrs)){

        $password = password_hash($data['password'], PASSWORD_DEFAULT);

            $status = 0;
            $permission = 0;

        $dataInsert = [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => $password,
            'status' => $status,
            'admin' => $permission,
            'createAt' => date("Y-m-d H:i:s")
        ];

        $statuInsert = insert('users', $dataInsert);

        if($statuInsert){
            setFlashData('msg', 'Register success !!!');
            setFlashData('type', 'success');
            redirect("?module=auth&active=login");
        }

    }else{
        setFlashData('msg', 'Check your form !!!');
        setFlashData('type', 'danger');
        setFlashData('erorrs', $erorrs);
        setFlashData('old', $data);
    }

    redirect("?module=auth&active=register");

}


$msg = getFlashData('msg');
$type = getFlashData('type');
$erorrs = getFlashData('erorrs');
$old = getFLashData('old');

echo '<pre>';
print_r($old);
echo '</pre>';

?>

<div class="container mb-5" id="add">

<h1 class="text-center text-success">Register</h1>

<?php getAlert($msg, $type); ?>

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
    <input type="password" class="form-control" placeholder="Enter" name="password" value="<?php echo !empty($old['password'])?$old['password']:''; ?>">
    <?php if(!empty($erorrs['password'])) formErorr($erorrs['password']); ?>
    </div>

    <div class="form-group">
    <label for="exampleInputEmail1">Comfirm</label>
    <input type="password" class="form-control" placeholder="Enter" name="comfirm" value="<?php echo !empty($old['comfirm'])?$old['comfirm']:''; ?>">
    <?php if(!empty($erorrs['comfirm'])) formErorr($erorrs['comfirm']); ?>
    </div>
    

    <div class="form-group">
    <hr>
    <input type="submit" value="submit" class="form-control btn btn-success">
    </div>


    </form>

    <button type="button" class="btn btn-warning mb-5"><a href="?module=auth&active=register" class="text-light">Re-enter</a></button>
    <button type="button" class="btn btn-primary mb-5"><a href="?module=auth&active=    login" class="text-light">Login</a></button>

</div>


<?php

layout('footer_login', 'client', $data);

?>