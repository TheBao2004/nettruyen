<?php


if(!empty($_GET['id_chap']) && !empty($_GET['id_book'])){
    $id_chap = $_GET['id_chap'];
    $id_book = $_GET['id_book'];
    $allImg = getRows("SELECT ci.*, c.name AS 'name_c', b.title AS 'name_b' FROM chap_img AS ci INNER JOIN chap AS c ON ci.id_chap = c.id LEFT JOIN book AS b ON c.id_book = b.id WHERE id_chap='$id_chap'");

    if(!empty($allImg)){

    }else{
        // setFlashData("msg", "Couldn't be see, ERORR DATABASE!!!");
        // setFlashData("type", "danger");
        // redirect('?module=books');
        // die();
    }
}else{
    setFlashData("msg", "Couldn't be see, ERORR URL!!!");
    setFlashData("type", "danger");
    redirect('?module=books');
    die();
}

$nameChap = !empty($allImg[0]['name_c'])?$allImg[0]['name_c']:'';
$nameBook = !empty($allImg[0]['name_b'])?$allImg[0]['name_b']:'';
$nameChap = $nameChap.' - '.shortStr($nameBook, 15);

$data = [
    'nameTitle' => 'Image '.$nameChap
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);




echo $_SERVER['REQUEST_METHOD'];

if(is_Post()){

    $data = $_POST;

    $arrLinkImg = $data['chap']['link_img'];
    $arrSttImg = $data['chap']['stt_img'];

    $check = null;
    $arrCheck = $arrSttImg;

    foreach ($arrCheck as $key => $value) {
        $count = 0;
        $check = $value;
        foreach ($arrSttImg as $key => $value) {
            if($check == $value){
                $count++;
                if($count >= 2){
                    break;
                }
            }
        }
        if($count >= 2){
            break;
        }
    }

    if($count >= 2){
        setFlashData('msg', "Couldn't for STT to be duplicate !!!");
        setFlashData('type', 'danger');
    }else{


        $arrData = [];

        foreach ($arrLinkImg as $key => $value) {
            $arrData[]=[
                'link_img' => $arrLinkImg[$key],
                'stt_img' => $arrSttImg[$key],
                'id_chap' => $id_chap
            ];
        }
    
        delete('chap_img', "id_chap='$id_chap'");
    
        $status = null;
    
        foreach ($arrData as $key => $value) {
            $status = insert('chap_img', $value);
        }
    
        if(!empty($status)){
            update('book', ['updateAt' => date('Y-m-d H:i:s')], "id=$id_book");
            setFlashData('type', 'success');
            setFlashData('msg', "Update image success !!!");
            redirect('?module=chap_imgs&id_book='.$id_book.'&id_chap='.$id_chap.'#place');
        }


    }


}

$msg = getFlashData('msg');
$type = getFlashData('type');



?>

<div class="container-fluid">
<form action="" method="post" class="">

<div class="box_chap_img">

<?php

if(!empty($allImg)):
    $count = 0;
foreach ($allImg as $key => $value):
    $count++;

?>

<div class="item_chap_img row mb-black">
   
<div class="col-7">

    <div class="form-group">
    <label >Link image</label>
    <textarea class="form-control inputLink" name="chap[link_img][]" rows="5"><?php echo $value['link_img']; ?></textarea>
    </div>

    <span class="btn btn-warning text-light p-2 w-100 save_chap_img">Save image</span>

    <div class="form-group my-5">
    <label for="">Stt image: <span class="text-success"><?php echo $count; ?></span></label>
    <input type="text" value="<?php echo $value['stt_img']; ?>" class="form-control" name="chap[stt_img][]">
    </div>

</div>

<div class="col-4 text-center">

<img src="<?php echo $value['link_img']; ?>" alt="erorr image <?php echo $value['stt_img'].' - '.$allImg[0]['name_c'] ?>" width="80%" class="b-shadow inputImage">

</div>

<div class="col-1">
    <div class="form-group">
    <span class="btn btn-danger text-light p-2 w-100 remove_chap_img"><i class="fa fa-times"></i></span>
    </div>
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

<span id="place" class="add_chap_img btn btn-primary text-light p-2 w-25 mb-3">Add image</span>

<?php getAlert($msg, $type); ?>

    <div class="form-group">
    <input type="submit" onclick="" class="form-control col-12 bg-success">
    </div>

</form>

    <a type="button" class="form-control btn col-1 bg-danger" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Back</a>


</div>

<?php

    layout('footer', 'admin', $data);

?>