<?php

$data = [
    'nameTitle' => 'Add author'
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

echo $_SERVER['REQUEST_METHOD'];    

if(is_Post()){

    $data = getRequest();

    $erorrs = [];

    if(empty($data['fullname'])){
        $erorrs['fullname'] = 'Please enter fullname !!!';
    }else{
         if(strlen($data['fullname']) < 5) $erorrs['fullname'] = "Fullname can't be less 5 char !!!";
    }

    if(empty($data['image'])){
        $erorrs['image'] = 'Please enter link image !!!';
    }

    if(empty($data['id_country'])){
        $erorrs['id_country'] = 'Please choose country !!!';
    }



    if(empty($erorrs)){

        $dataInsert = [
            'fullname' => $data['fullname'],
            'image' => $data['image'],
            'description' => $data['description'],
            'id_country' => $data['id_country'],
            'createAt' => date("Y-m-d H:i:s")
        ];

        $statuInsert = insert('author', $dataInsert);

        if($statuInsert){
            setFlashData('msg', 'Add author success !!!');
            setFlashData('type', 'success');
            redirect('?module=authors');
        }

    }else{
        setFlashData('msg', 'Check your form !!!');
        setFlashData('type', 'danger');
        setFlashData('erorrs', $erorrs);
        setFlashData('old', $data);
    }

    redirect("?module=authors&active=add#add");

}


$msg = getFlashData('msg');
$type = getFlashData('type');
$erorrs = getFlashData('erorrs');
$old = getFLashData('old');

$allCountrys = getRows("SELECT id, `name` FROM country"); 

?>

<div class="container mb-5" id="add">

    <form action="" method="post">

    <div class="form-group">
    <label for="exampleInputEmail1">Fullname</label>
    <input type="text" class="form-control" placeholder="Enter" name="fullname" value="<?php echo !empty($old['fullname'])?$old['fullname']:''; ?>">
    <?php if(!empty($erorrs['fullname'])) formErorr($erorrs['fullname']); ?>
    </div>

    <div class="form-group">
    <label for="exampleInputEmail1">Image</label>
    <input type="text" class="form-control" placeholder="Enter" name="image" value="<?php echo !empty($old['image'])?$old['image']:''; ?>">
    <?php if(!empty($erorrs['image'])) formErorr($erorrs['image']); ?>
    </div>

    
    <div class="form-group">
    <label for="exampleInputEmail1">Country</label>
        <select name="id_country" id="" class="form-control">
            <option value="0">Choose</option>

            <?php
                if(!empty($allCountrys)):
                    foreach ($allCountrys as $key => $value):
            ?>
                <option <?php echo (!empty($old['id_country']) && $old['id_country']==$value['id'])?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['id'].' - '.$value['name']; ?></option>
            <?php
            endforeach;
            endif;
            ?>

        </select>
        <?php if(!empty($erorrs['id_country'])) formErorr($erorrs['id_country']); ?>
    </div>

    <div class="form-group">
    <label>Description</label>
    <textarea class="form-control" placeholder="Could no enter"  rows="3" name="description"><?php echo !empty($old['description'])?$old['description']:''; ?></textarea>
    </div>


    <div class="form-group">
    <hr>
    <input type="submit" value="submit" class="form-control btn btn-success">
    </div>


    </form>

    <button type="button" class="btn btn-primary mb-5"><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="text-light">Lists authors</a></button>

</div>


<?php

layout('footer', 'admin', $data);

?>