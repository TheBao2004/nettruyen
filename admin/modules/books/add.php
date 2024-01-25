<?php

$data = [
    'nameTitle' => 'Add book'
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

echo $_SERVER['REQUEST_METHOD'];    

if(is_Post()){

    $data = getRequest();

    $erorrs = [];

    if(empty($data['title'])){
        $erorrs['title'] = 'Please enter title !!!';
    }else{
         if(strlen($data['title']) < 5) $erorrs['title'] = "Title can't be less 5 char !!!";
    }

    if(empty($data['image'])){
        $erorrs['image'] = 'Please enter link image !!!';
    }

    if(empty($data['image_slide_1'])){
        $erorrs['image_slide_1'] = 'Please enter link image slide 1 !!!';
    }

    if(empty($data['image_slide_2'])){
        $erorrs['image_slide_2'] = 'Please enter link image slide 2 !!!';
    }

    if(empty($data['status'])){
        $erorrs['status'] = 'Please choose status !!!';
    }

    if(empty($data['id_author'])){
        $erorrs['id_author'] = 'Please choose author !!!';
    }

    if(empty($data['id_kindof'])){
        $erorrs['id_kindof'] = 'Please choose kind of !!!';
    }



    if(empty($erorrs)){

        if($data['status'] == 1){
            $status = 1;
        }else{
            $status = 0;
        }

        $dataInsert = [
            'title' => $data['title'],
            'image' => $data['image'],
            'image_slide_1' => $data['image_slide_1'],
            'image_slide_2' => $data['image_slide_2'],
            'status' => $status,
            'id_author' => $data['id_author'],
            'id_kindof' => $data['id_kindof'],
            'description' => $data['description'],
            'createAt' => date("Y-m-d H:i:s")
        ];

        $statuInsert = insert('book', $dataInsert);

        if($statuInsert){
            setFlashData('msg', 'Add book success !!!');
            setFlashData('type', 'success');
            redirect('?module=books');
        }

    }else{
        setFlashData('msg', 'Check your form !!!');
        setFlashData('type', 'danger');
        setFlashData('erorrs', $erorrs);
        setFlashData('old', $data);
    }

    redirect("?module=books&active=add#add");

}


$msg = getFlashData('msg');
$type = getFlashData('type');
$erorrs = getFlashData('erorrs');
$old = getFLashData('old');

echo '<pre>';
print_r($old);
echo '</pre>';

$allAuthors = getRows("SELECT id, `fullname` FROM author");
$allKindOf = getRows("SELECT id, `name` FROM book_kind_of"); 

?>

<div class="container mb-5" id="add">


    <form action="" method="post" class="row">

    <div class="col-6">

    <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" placeholder="Enter" name="title" value="<?php echo !empty($old['title'])?$old['title']:''; ?>">
    <?php if(!empty($erorrs['title'])) formErorr($erorrs['title']); ?>
    </div>

    <div class="form-group">
    <label for="exampleInputEmail1">Image</label>
    <input type="text" class="form-control" placeholder="Enter" name="image" value="<?php echo !empty($old['image'])?$old['image']:''; ?>">
    <?php if(!empty($erorrs['image'])) formErorr($erorrs['image']); ?>
    </div>

    <div class="form-group">
    <label>Image slide 1</label>
    <textarea class="form-control" placeholder="Enter"  rows="3" name="image_slide_1"><?php echo !empty($old['image_slide_1'])?$old['image_slide_1']:''; ?></textarea>
    <?php if(!empty($erorrs['image_slide_1'])) formErorr($erorrs['image_slide_1']); ?>
    </div>

    <div class="form-group">
    <label>Image slide 2</label>
    <textarea class="form-control" placeholder="Enter"  rows="3" name="image_slide_2"><?php echo !empty($old['image_slide_2'])?$old['image_slide_2']:''; ?></textarea>
    <?php if(!empty($erorrs['image_slide_2'])) formErorr($erorrs['image_slide_2']); ?>
    </div>


    </div>

    <div class="col-6">

    <div class="form-group">
    <label for="exampleInputEmail1">Status</label>
        <select name="status" id="" class="form-control">
            <option value="0">Choose</option>
            <option <?php echo !empty($old['status']) && $old['status']==1?'selected':''; ?> value="1">Over</option>
            <option <?php echo !empty($old['status']) && $old['status']==2?'selected':''; ?> value="2">Not yet</option>
        </select>
        <?php if(!empty($erorrs['status'])) formErorr($erorrs['status']); ?>
    </div>

    <div class="form-group my-auto">
    <label for="exampleInputEmail1">Author</label>
        <select name="id_author" id="" class="form-control">
            <option value="0">Choose</option>

            <?php
                if(!empty($allAuthors)):
                    foreach ($allAuthors as $key => $value):
            ?>
                <option <?php echo (!empty($old['id_author']) && $old['id_author']==$value['id'])?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['id'].' - '.$value['fullname']; ?></option>
            <?php
            endforeach;
            endif;
            ?>
        </select>
        <?php if(!empty($erorrs['id_author'])) formErorr($erorrs['id_author']); ?>
    </div> 

    <div class="form-group mt-2 mb-0">
    <label for="exampleInputEmail1">Kind of</label>
        <select name="id_kindof" id="" class="form-control">
            <option value="0">Choose</option>

            <?php
                if(!empty($allKindOf)):
                    foreach ($allKindOf as $key => $value):
            ?>
                <option <?php echo (!empty($old['id_kindof']) && $old['id_kindof']==$value['id'])?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['id'].' - '.$value['name']; ?></option>
            <?php
            endforeach;
            endif;
            ?>
        </select>
        <?php if(!empty($erorrs['id_kindof'])) formErorr($erorrs['id_kindof']); ?>
    </div> 

    <div class="form-group">
    <label>Description</label>
    <textarea class="form-control" placeholder="Could no enter"  rows="3" name="description"><?php echo !empty($old['description'])?$old['description']:''; ?></textarea>
    </div>

    </div>

    <div class="form-group col-12">
    <hr>
    <input type="submit" value="submit" class="form-control btn btn-success">
    </div>


    </form>

    <button type="button" class="btn btn-warning mb-5"><a href="?module=books&active=add#add" class="text-light">Re-enter</a></button>
    <button type="button" class="btn btn-primary mb-5"><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="text-light">Lists books</a></button>


</div>


<?php

layout('footer', 'admin', $data);

?>