<?php

$data = [
    'nameTitle' => 'Books'
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);



$data = getRequest();

$status = null;
$check = null;

$filter = '';
$strFilter = '';

if(!empty($data['check'])){
    $check = $data['check'];
    $filter .= "WHERE b.title LIKE '%$check%'";
    $strFilter .= "&check=$check";
}

if(!empty($data['status'])){
    $selected = $data['status'];
    if($data['status'] == 1){
        $status = 1;
    }else{
        $status = 0;
    }

    if(!empty($filter)){
        $filter .= "AND `status` =  '$status'";
    }else{
        $filter .= "WHERE `status` =  '$status'";
    }
    $strFilter .= "&status=$selected";
}

if(!empty($data['id_author'])){
    $author = $data['id_author'];
    if(!empty($filter)){
        $filter .= "AND `id_author`='$author'";
    }else{
        $filter .= "WHERE `id_author`='$author'";
    }
    $strFilter .= "&id_author=$author";
}

if(!empty($data['id_kindof'])){
    $kindof = $data['id_kindof'];
    if(!empty($filter)){
        $filter .= "AND `id_kindof`='$kindof'";
    }else{
        $filter .= "WHERE `id_kindof`='$kindof'";
    }
    $strFilter .= "&id_kindof=$kindof";
}

$numberBooks = getCountRows("SELECT b.id FROM book AS b LEFT JOIN author AS a ON b.id_author = a.id LEFT JOIN book_kind_of AS k ON b.id_kindof = k.id $filter");

$numberItem = ceil($numberBooks/_COUNT_ITEM);

if(!empty($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$limitStart = ($page-1)*_COUNT_ITEM;

$limitEnd = _COUNT_ITEM;

$allBooks = getRows("SELECT b.*, a.fullname AS 'name_author', k.name AS 'name_k' FROM book AS b LEFT JOIN author AS a ON b.id_author = a.id LEFT JOIN book_kind_of AS k ON b.id_kindof = k.id $filter ORDER BY id DESC LIMIT $limitStart, $limitEnd");

$msg = getFlashData('msg');
$type = getFlashData('type');

$allAuthors = getRows("SELECT id, `fullname` FROM author");
$allKindOf = getRows("SELECT id, `name` FROM book_kind_of");

?>


<div class="container-fluid">

<?php getAlert($msg, $type); ?>

<button type="button" class="btn btn-success "><a href="?module=books&active=add" class="text-light">Add book <i class="fa fa-plus mx-1"></i></a></button>

<form action="" method="get">

    <div class="row py-3 px-2 my-2 mx-1 rounded border border-success">

    <input type="hidden" name="module" value="books">

    <div class="form-group col-4 my-auto">
    <input type="text" name="check" class="form-control" placeholder="Enter" value="<?php echo !empty($check)?$check:$check; ?>">
    </div>  

    <div class="form-group col-4 my-auto">
        <select name="status" id="" class="form-control">
            <option value="0">Choose</option>
            <option <?php echo !empty($selected) && $selected==1?'selected':''; ?> value="1">Over</option>
            <option <?php echo !empty($selected) && $selected==2?'selected':''; ?> value="2">Not yet</option>
        </select>
    </div> 
        
    <div class="form-group col-4 my-auto">
        <select name="id_author" id="" class="form-control">
            <option value="0">Choose</option>

            <?php
                if(!empty($allAuthors)):
                    foreach ($allAuthors as $key => $value):
            ?>
                <option <?php echo (!empty($author) && $author==$value['id'])?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['id'].' - '.$value['fullname']; ?></option>
            <?php
            endforeach;
            endif;
            ?>

        </select>
    </div> 

    <div class="form-group col-4 mt-2 mb-0">
        <select name="id_kindof" id="" class="form-control">
            <option value="0">Choose</option>

            <?php
                if(!empty($allKindOf)):
                    foreach ($allKindOf as $key => $value):
            ?>
                <option <?php echo (!empty($kindof) && $kindof==$value['id'])?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['id'].' - '.$value['name']; ?></option>
            <?php
            endforeach;
            endif;
            ?>

        </select>
    </div> 

    <div class="form-group col-8 mt-2 mb-0">
        <input type="submit" value="Submit" class="btn btn-success d-block form-control">
    </div>

    </div>

</form>


<table class="w-100">


<thead>
    <tr class="">
    <th class="col-1">Id</th>
    <th class="col-2">Title</th>
    <th class="col-3">Image</th>
    <th class="col-2">Author</th>
    <th class="col-1">Status</th> 
    <th class="col-1">Kind of</th>
    <th class="col-1">Fix</th>
    <th class="col-1">Remove</th>
    </tr>
</thead>

<tbody>
    <?php
        if(!empty($allBooks)):
            foreach ($allBooks as $key => $value):
    ?>
    <tr>
    <td class=""><?php echo $value['id']; ?></td>
    <td class=""><a class="text-success" href="?module=chaps&id_book=<?php echo $value['id']; ?>"><?php echo $value['title']; ?></a></td>
    <td class=""><?php echo !empty($value['image'])?'<img src="'.$value['image'].'" alt="erorr image" width="100">':''; ?></td>
    <td class=""><?php echo $value['name_author']; ?></td>
    <td ><a class="text-<?php echo $value['status']==1?'danger':'primary'; ?>" href=""><?php echo $value['status']==1?'over':'not yet'; ?></a></td>
    <td ><?php echo $value['name_k']; ?></td>
    <td class=""><button type="button" class="btn btn-warning"><a class="text-light" href="?module=books&active=fix&id=<?php echo $value['id']; ?>"><i class="fa fa-wrench"></i></a></button></td>
    <td class=""><button type="button" class="btn btn-danger"><a class="text-light" onclick="return alert('do you relly want remove !!!');" href="?module=books&active=delete&id=<?php echo $value['id']; ?>"><i class="fa fa-trash-alt "></i></a></button></td>
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
      <a class="page-link text-success border-success d-<?php echo $page==1?'none':''; ?>" href="?module=books<?php echo $strFilter; ?>&page=<?php echo $back; ?>" aria-label="Previous">
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

    <li class="page-item border-success"><a class="page-link border-success bg-<?php echo $page==$i?'success':''; ?> text-<?php echo $page==$i?'light':'success'; ?>" href="?module=books<?php echo $strFilter; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

    <?php
    
        endfor;
        endif;
    ?>

    <li class="page-item border-success">
      <a class="page-link text-success border-success d-<?php echo $page==$numberItem?'none':''; ?>" href="?module=books<?php echo $strFilter; ?>&page=<?php echo $next; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>

















</div>


<?php

layout('footer', 'admin', $data);

?>