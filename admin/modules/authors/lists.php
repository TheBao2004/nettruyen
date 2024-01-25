<?php

$data = [
    'nameTitle' => 'Authors'
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

$data = getRequest();

$country = null;
$check = null;

$filter = '';
$strFilter = '';

if(!empty($data['check'])){
    $check = $data['check'];
    $filter .= "WHERE `fullname` LIKE '%$check%'";
    $strFilter .= "&check=$check";
}
    
if(!empty($data['id_country'])){
    $country = $data['id_country'];
    if(!empty($filter)){
        $filter .= "AND `id_country`='$country'";
    }else{
        $filter .= "WHERE `id_country`='$country'";
    }
    $strFilter .= "&id_country=$country";
}

$numberAuthors = getCountRows("SELECT a.id FROM author AS a LEFT JOIN country AS c ON a.id_country = c.id $filter");

$numberItem = ceil($numberAuthors/_COUNT_ITEM);

$allCountrys = getRows("SELECT id, `name` FROM country"); 

if(!empty($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$limitStart = ($page-1)*_COUNT_ITEM;    

$limitEnd = _COUNT_ITEM;

$allAuthors = getRows("SELECT a.*, c.name AS 'name_ctry' FROM author AS a LEFT JOIN country AS c ON a.id_country = c.id $filter ORDER BY id DESC LIMIT $limitStart, $limitEnd");

$msg = getFlashData('msg');
$type = getFlashData('type');

?>


<div class="container-fluid">

<?php getAlert($msg, $type); ?>

<button type="button" class="btn btn-success "><a href="?module=authors&active=add" class="text-light">Add author <i class="fa fa-plus mx-1"></i></a></button>

<form action="" method="get">

    <div class="row py-3 px-2 my-2 mx-1 rounded border border-success">

    <input type="hidden" name="module" value="authors">

    <div class="form-group col-4 my-auto">
    <input type="text" name="check" class="form-control" placeholder="Enter" value="<?php echo !empty($check)?$check:$check; ?>">
    </div>  

    <div class="form-group col-4 my-auto">
        <select name="id_country" id="" class="form-control">
            <option value="0">Choose</option>

            <?php
                if(!empty($allCountrys)):
                    foreach ($allCountrys as $key => $value):
            ?>
                <option <?php echo (!empty($country) && $country==$value['id'])?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['id'].' - '.$value['name']; ?></option>
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
    <th class="col-2">Name</th>
    <th class="col-2">Image</th>
    <th class="col-1">Country</th>
    <th class="col-5">Description</th>
    <th class="col-1">Fix</th>
    <th class="col-1">Remove</th>
    </tr>
</thead>

<tbody>
    <?php
        if(!empty($allAuthors)):
            foreach ($allAuthors as $key => $value):
    ?>
    <tr>
    <td class=""><?php echo $value['id']; ?></td>
    <td class=""><?php echo $value['fullname']; ?></td>
    <td class=""><?php echo !empty($value['image'])?'<img src="'.$value['image'].'" alt="erorr image" width="100">':''; ?></td>
    <td class=""><?php echo $value['name_ctry']; ?></td>
    <td class=""><?php echo $value['description']; ?></td>
    <td class=""><button type="button" class="btn btn-warning"><a class="text-light" href="?module=authors&active=fix&id=<?php echo $value['id']; ?>"><i class="fa fa-wrench"></i></a></button></td>
    <td class=""><button type="button" class="btn btn-danger"><a class="text-light" onclick="return alert('do you relly want remove !!!');" href="?module=authors&active=delete&id=<?php echo $value['id']; ?>"><i class="fa fa-trash-alt "></i></a></button></td>
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
      <a class="page-link text-success border-success d-<?php echo $page==1?'none':''; ?>" href="?module=authors<?php echo $strFilter; ?>&page=<?php echo $back; ?>" aria-label="Previous">
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

    <li class="page-item border-success"><a class="page-link border-success bg-<?php echo $page==$i?'success':''; ?> text-<?php echo $page==$i?'light':'success'; ?>" href="?module=authors<?php echo $strFilter; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

    <?php
    
        endfor;
        endif;
    ?>

    <li class="page-item border-success">
      <a class="page-link text-success border-success d-<?php echo $page==$numberItem?'none':''; ?>" href="?module=authors<?php echo $strFilter; ?>&page=<?php echo $next; ?>" aria-label="Next">
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