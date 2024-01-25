<?php

$filter = '';
$strFilter = '';

if(!empty($_GET['id_book'])){
    $bookId = $_GET['id_book'];
    $detaiBook = getFirstRow("SELECT * FROM book WHERE id='$bookId'");
    if(!empty($detaiBook)){
        $strFilter .= "&id_book=$bookId";
    }else{
        setFlashData("msg", "Couldn't be see, ERORR DATABASE!!!");
        setFlashData("type", "danger");
        redirect('?module=books');
        die();
    }
}else{
    setFlashData("msg", "Couldn't be see, ERORR URL!!!");
    setFlashData("type", "danger");
    redirect('?module=books');
    die();
}


$data = [
    'nameTitle' => 'Chap - '.shortStr($detaiBook['title'], 50)
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);




$data = getRequest('get');

$check = null;

if(!empty($data['check'])){
    $check = $data['check'];
    $filter .= "AND `name` LIKE '%$check%'";
    $strFilter .= "&check=$check";
}

if(!empty($data['stt_chap'])){
    $stt_chap = $data['stt_chap'];
        $filter .= "AND stt_chap='$stt_chap'";
    $strFilter .= "&stt_chap=$stt_chap";
}
    

$numberChaps = getCountRows("SELECT c.* FROM chap AS c INNER JOIN book AS b ON c.id_book = b.id WHERE id_book = '$bookId' $filter");

$numberItem = ceil($numberChaps/_COUNT_ITEM);

if(!empty($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$limitStart = ($page-1)*_COUNT_ITEM;    

$limitEnd = _COUNT_ITEM;

$allChaps = getRows("SELECT c.*, b.title AS 'name_book' FROM chap AS c INNER JOIN book AS b ON c.id_book = b.id WHERE id_book = '$bookId' $filter ORDER BY `stt_chap` DESC LIMIT $limitStart, $limitEnd");

$msg = getFlashData('msg');
$type = getFlashData('type');

$allNumber = getRows("SELECT id, `stt_chap` FROM chap WHERE id_book = '$bookId'");

?>

<div class="container-fluid">

<?php getAlert($msg, $type); ?>

<div class="row">

<div class="col-12 mb-3"><a href="<?php echo '?module=books'; ?>" class=" btn btn-danger">Back</a></div>

<div class="col-4">

    <?php

    if(!empty($_GET['view'])){
        $view = $_GET['view'];
        require $view.'.php';
    }else{
        require 'add.php';
    }

    ?>

</div>

<div class="col-8">

<h3>Lists</h3>

<form action="" method="get">

    <div class="row py-3 px-2 my-2 mx-1 rounded border border-success">

    <input type="hidden" name="module" value="chaps">

    <input type="hidden" name="id_book" value="<?php echo $bookId; ?>">

    <div class="form-group col-4 my-auto">
    <input type="text" name="check" class="form-control" placeholder="Enter" value="<?php echo !empty($check)?$check:$check; ?>">
    </div>  

    <div class="form-group col-4 my-auto">
        <select name="stt_chap" id="" class="form-control">
            <option value="0">Choose</option>

            <?php
                if(!empty($allNumber)):
                    foreach ($allNumber as $key => $value):
            ?>
                <option <?php echo (!empty($stt_chap) && $stt_chap==$value['id'])?'selected':''; ?> value="<?php echo $value['stt_chap']; ?>"><?php echo 'Chap - '.$value['stt_chap']; ?></option>
            <?php
                    endforeach;
            endif;
            ?>

        </select>
    </div> 

    <div class="form-group col-4 my-auto">
        <input type="submit" value="Submit" class="btn btn-success d-block form-control">
    </div>

    </div>

</form>


<table class="w-100">


<thead>
    <tr class="">
    <th class="">Id</th>
    <th class="col-4">Name</th>
    <th class="col-1">Stt chap</th>
    <th class="col-4">Book</th>
    <th class="col-1">Fix</th>
    <th class="col-1">Remove</th>
    </tr>
</thead>

<tbody>
    <?php
        if(!empty($allChaps)):
            foreach ($allChaps as $key => $value):
    ?>
    <tr>
    <td class=""><?php echo $value['id']; ?></td>
    <td class=""><a class="text-success" href="?module=chap_imgs&id_book=<?php echo $bookId; ?>&id_chap=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
    <td class=""><?php echo $value['stt_chap']; ?></td>
    <td class=""><?php echo $value['name_book']; ?></td>
    <td class=""><button type="button" class="btn btn-warning"><a class="text-light" href="?module=chaps&view=fix&id_book=<?php echo $bookId; ?>&id=<?php echo $value['id']; ?>"><i class="fa fa-wrench"></i></a></button></td>
    <td class=""><button type="button" class="btn btn-danger"><a class="text-light" onclick="return alert('do you relly want remove !!!');" href="?module=chaps&active=delete&id_book=<?php echo $bookId; ?>&id=<?php echo $value['id']; ?>"><i class="fa fa-trash-alt "></i></a></button></td>
    </tr> 

    <?php
        endforeach;
        else:        
    ?>
    <tr>
        <td class="text-danger" colspan="8">No data</td>
    </tr>
    <?php
        endif;        
    ?>

</tbody>



</table>

<?php

        $back = $page-1;
        $next = $page+1;

        if($back<=0){
            $back=1;
        }
        if($next>=$numberItem){
            $next = $numberItem; 
        }

?>

<nav aria-label="Page navigation example" class="my-3">
  <ul class="pagination ml-auto">
    <li class="page-item border-success">
      <a class="page-link text-success border-success d-<?php echo $page==1?'none':''; ?>" href="?module=chaps<?php echo $strFilter; ?>&page=<?php echo $back; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>

    <?php

$backPage = $page-1;
$nextPage = $page+1;

if($backPage<=0){
    $backPage=1;
}
if($nextPage>=$numberItem){
    $nextPage = $numberItem; 
}


    if(!empty($numberItem)):
        for ($i=$backPage; $i <= $nextPage; $i++):
    ?>

    <li class="page-item border-success"><a class="page-link border-success bg-<?php echo $page==$i?'success':''; ?> text-<?php echo $page==$i?'light':'success'; ?>" href="?module=chaps<?php echo $strFilter; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

    <?php
    
        endfor;
        endif;
    ?>

    <li class="page-item border-success">
      <a class="page-link text-success border-success d-<?php echo $page==$numberItem?'none':''; ?>" href="?module=chaps<?php echo $strFilter; ?>&page=<?php echo $next; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>

</div>

</div>
















</div>


<?php

layout('footer', 'admin', $data);

?>