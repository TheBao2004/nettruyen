<?php

$data = [
    'nameTitle' => 'Slides'
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);


if(is_Post()){

    $data = $_POST;

    $arrImage1 = $data['slide']['image1'];

    $arrData = [];

    foreach ($arrImage1 as $key => $value) {
        $arrData[]=[
            'image1' => $arrImage1[$key],
            'image2' => $data['slide']['image2'][$key],
            'title' => $data['slide']['title'][$key],
            'description' => $data['slide']['description'][$key],
            'link' => $data['slide']['link'][$key]
        ];
    }


    $jsonData = [
        'value_option' => json_encode($arrData)
    ];

    $statusInsert = update('options', $jsonData, "name_option='slides'");

    if(!empty($statusInsert)){
        setFlashData('msg', 'Save slides success !!!');
    }

    redirect('?module=options&active=slides');


}

$msg = getFlashData('msg');

$jsonSlide = getOption('slides');

$allSlides = json_decode($jsonSlide, true);

?>

<div class="container-fluid">

<?php getAlert($msg); ?>


<form action="" method="post">

<div class="box_slides">



<?php

if(!empty($allSlides)):
foreach ($allSlides as $key => $value):

?>


<div class="item_slide row mb-black">

<div class="col-10">

<div class="form-group">
    <label for="">Image 1</label>
    <input type="text" class="form-control" name="slide[image1][]" placeholder="Enter" value="<?php echo $value['image1']; ?>">
</div>

<div class="form-group">
    <label for="">Image 2</label>
    <input type="text" class="form-control" name="slide[image2][]" placeholder="Enter" value="<?php echo $value['image2']; ?>">
</div>

<div class="form-group">
    <label for="">Title</label>
    <textarea class="form-control" placeholder="Enter" name="slide[title][]" rows="3"><?php echo $value['title']; ?></textarea>
</div>

<div class="form-group">
    <label for="">Description</label>
    <textarea class="form-control" placeholder="Enter" name="slide[description][]" rows="3"><?php echo $value['description']; ?></textarea>
</div>

<div class="form-group">
    <label for="">Link</label>
    <input type="text" class="form-control" name="slide[link][]" placeholder="Enter" value="<?php echo $value['link']; ?>">
</div>


</div>

<div class="col-2 text-center">

    <span class="btn btn-danger text-light p-2 w-75 remove_slide"><i class="fa fa-times"></i></span>

</div>


</div>



<?php

endforeach;
else:

?>

<span class="chap_img_nodata btn border border-danger text-danger my-5 w-100">No date</span>

<?php

endif;

?>


</div>

<span class="btn btn-primary text-light p-2 w-25 mb-5 add_slide">Add slide</span>

<input type="submit" value="Sumit" class="btn btn-success w-100">

</form>


</div>



















<?php

layout('footer', 'admin', $data);

?>