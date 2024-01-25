<?php

$data = [
    'nameTitle' => 'Profile'
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

if(is_Post()){

$erorrs = [];

$data = getRequest();

$email = $data['email'];
$userId = _MY_DATA['id']; 

if(empty($data['email'])){
    $erorrs['email'] = 'Please enter email !!!';
}else{
    if(getFirstRow("SELECT id FROM users WHERE email='$email' AND id<>'$userId'")){
        $erorrs['email'] = "Email already exsist in database !!!";
    }
}

if(empty($data['fullname'])){
    $erorrs['fullname'] = 'Please enter fullname !!!';
}else{
    if(strlen($data['fullname']) < 5){
    $erorrs['fullname'] = "Fullname can not less 5 char !!!";
    }
}

if(empty($erorrs)){

    $dataUpdate = [
        'email' => $email,
        'fullname' => $data['fullname'],
        'avatar' => $data['avatar'],
        'updateAt' => date('Y-m-d H:i:s')
    ];

    $statusUpdate = update('users', $data, "id='$userId'");

    if(!empty($statusUpdate)){
        setFlashData('msg', 'Update information success !!!');
        setFlashData('type', 'success');
    }

}else{
    setFlashData('msg', 'Check your form !!!');
    setFlashData('type', 'danger');
    setFlashData('erorrs', $erorrs);
    setFlashData('old', $data);
}

redirect('?module=users&active=profile');

}

$old = getFlashData('old');
if(empty($old)){
    $old = _MY_DATA;
}

$msg = getFlashData('msg');
$type = getFlashData('type');
$erorrs = getFlashData('erorrs');

?>

<div class="container-fluid">

<?php getAlert($msg, $type); ?>

<form action="" method="post" class="row">

<div class="col-8">

<h3>Account information</h3>

    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" name="email" placeholder="Enter" value="<?php echo $old['email']; ?>">
        <?php echo !empty($erorrs['email'])?formErorr($erorrs['email']):''; ?>
    </div>

    <div class="form-group">
        <label>Fullname</label>
        <input type="text" class="form-control" name="fullname" placeholder="Enter" value="<?php echo $old['fullname']; ?>">
        <?php echo !empty($erorrs['fullname'])?formErorr($erorrs['fullname']):''; ?>
    </div>

    <div class="form-group">
        <label>Permission</label>
        <span class="btn btn-<?php echo _MY_DATA['admin']==1?'danger':'primary'; ?> btn-block w-100"><?php echo _MY_DATA['admin']==1?'Admin':'User'; ?></span>
    </div>

    <div class="form-group">
        <label>Time create account:</label> <span><?php echo formatDate(_MY_DATA['createAt'], 'Y/m/d'); ?></span>
    </div>


</div>


<div class="col-4">

<h3>Avatar</h3>

<div class="form-group">
        <label>Avatar</label>
        <input type="text" name="avatar" class="form-control my-2 post_profile_img" placeholder="Enter" value="<?php echo $old['avatar']; ?>">
        <span class="btn btn-warning btn-block w-100 text-light mb-2 save_profile_img">Save image</span>
        <img class="input_profile_img" src="<?php echo $old['avatar']; ?>" alt="User image" width="100%">

</div>

</div>

        <input type="submit" class="form-control btn btn-success b-block w-100 text-light mx-2"  value="Submit">

</form>

<button type="submit" class="text-success border border-success btn bg-light my-2 mx-auto d-block"><a class="text-success" href="?module=auth&active=forgot">Forget password</a></button>

</div>

<?php

layout('footer', 'admin', $data);

?>