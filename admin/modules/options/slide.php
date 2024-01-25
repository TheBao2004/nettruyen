<?php 

$data = [
    'nameTitle' => 'Slide'
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

$allBooks = getRows("SELECT * FROM book ORDER BY view_number DESC");

$jsonSlide = getFirstRow("SELECT value_option FROM options WHERE name_option='slides'");

$allSlides = json_decode($jsonSlide['value_option'], true);

$arrId = [];

if(!empty($allSlides) && is_array($allSlides)){
foreach ($allSlides as $key => $value) {
    $arrId[] = $value['id'];
}
}



if(is_Post()){

    $data = $_POST;

    if(!empty($data)){


    $arrId = $data['slide'];

    $allSlides = [];

    foreach ($allBooks as $key => $value) {
        if(in_array($value['id'], $arrId)){
            $allSlides[$key] = [
                'title' => $value['title'],
                'description' => $value['description'],
                'image_slide_1' => $value['image_slide_1'],
                'image_slide_2' => $value['image_slide_2'],
                'id' => $value['id']
            ]; 
        }
    }


    $jsonSlide = json_encode($allSlides);

    $statusInsert = update('options', ['value_option' => $jsonSlide], "name_option='slides'");

    if(!empty($statusInsert)){
        setFlashData('msg', 'Update slide success !!!');
        setFlashData('type', 'success');
    }


    }else{

        setFlashData('msg', 'Please choose books !!!');
        setFlashData('type', 'danger');

    }

    redirect('?module=options&active=slide');
}

$msg = getFlashData('msg');
$type = getFlashData('type');

?>

<div class="container-fluid px-5">

<h1 class="text-center text-success mb-4">CHOOSE BOOK TO SLIDE</h1>

<?php getAlert($msg, $type); ?>

<form class="row" method="post">

    <?php
    if(!empty($allBooks)):
        foreach ($allBooks as $key => $value):
    ?>

    <div class="col-3 row">
        <div class="col-10 p-3 bor-green text-center">
            <img src="<?php echo $value['image'] ?>" width="90%" alt="<?php echo 'image - '.$value['title']; ?>">
        </div>
        <div class="col-2 bor-green text-center d-flex align-items-center">
            <input type="checkbox" <?php echo in_array($value['id'], $arrId)?'checked':''; ?> name="slide[]" value="<?php echo $value['id']; ?>" id="" class="d-block mx-auto">
        </div>
    </div>

    <?php
    endforeach;
    endif;    
    ?>

    <div class="col-12 form-group my-5">
        <input type="submit" value="Submit" class="btn btn-success w-100">
    </div>

</form>


</div>

<?php

layout('footer', 'admin', $data);

?>