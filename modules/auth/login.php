
<?php


$data = [
    'nameTitle' => 'Login'
];

layout('header_login', 'client', $data);

// echo password_hash('Thimi7002', PASSWORD_DEFAULT);

// var_dump(password_verify('Thimi7002', '$2y$10$ps3bNNBh0e9IbhauurizDOjTFoUhdykGarqHk9KjuwrZw6UyibZUi'));

// die();

if(is_Post()){

    $erorrs = [];

    $data = getRequest();

    $email = $data['email'];

    $checkExsist = getCountRows("SELECT id FROM users WHERE email='$email'");

    $user = getFirstRow("SELECT id, `password`, `status`, `admin` FROM users WHERE email='$email'");

    $pattern = "/^[a-z]+\w+\@([\w+\.*]+)\.[a-z]{2,}$/";

    if(empty($data['email'])){
        $erorrs['email'] = 'Please enter email !!!';
    }else{
        if(!preg_match($pattern, $email)){
            $erorrs['email'] = "This isn't email !!!";
        }else{
            if(empty($checkExsist)){
            $erorrs['email'] = "Email is'nt exsist in database !!!";
            }
        }

    }
    
    if(empty($data['password'])){
        $erorrs['password'] = 'Please enter password !!!';
    }else{
        if(!empty($checkExsist)){
            $checkPass = password_verify($data['password'], $user['password']);
            if(!$checkPass){
                $erorrs['password'] = 'Password is wrong !!!';
            }
        }
    }


    if(empty($erorrs)){
        $token = sha1(uniqid().time());

        setSession('login', $token);

        $dataToken = [
            'id_user' => $user['id'],
            'token' => $token,
            'createAt' => date('Y-m-d H:i:s')
        ];

        $statusInsert = insert("login_token", $dataToken);
        if(!empty($statusInsert)){
            if($user['admin'] == 1){
            redirect(_WEB_HOST_ROOT_ADMIN);
            }else{
                redirect(_WEB_HOST_ROOT);
            }    
        }

    }else{
        setFlashData('msg', 'Check your form !!!');
        setFlashData('type', 'danger');
        setFlashData('email', $email);
        setFlashData('erorrs', $erorrs);
    }

    redirect("?module=auth&active=login");
}

$msg = getFlashData('msg');
$type = getFlashData('type');
$email = getFlashData('email');
$erorrs = getFlashData('erorrs');


?>

<div class="container">

    <h1 class="text-center text-success">LOGIN</h1>

    <?php getAlert($msg, $type); ?>

    <form class="p-1" method="post">
        <div class="form-group my-3">
        <label >Email address</label>
        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
        <?php !empty($erorrs['email'])?formErorr($erorrs['email']):''; ?>
        </div>
        <div class="form-group my-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <?php !empty($erorrs['password'])?formErorr($erorrs['password']):''; ?>
        </div>
        <button type="submit" class="btn btn-success btn-block my-3 d-block w-100">Submit</button>
    </form>

    <hr class="">

    <button type="submit" class="text-success border border-success btn bg-light my-2 mx-auto d-block"><a class="text-success" href="?module=auth&active=forgot">Forget password</a></button>
    <button type="submit" class="text-success border border-success btn bg-light my-2 mx-auto d-block"><a class="text-success" href="?module=auth&active=register">Register</a></button>

</div>



<?php

layout('footer_login', 'client', $data);

?>





