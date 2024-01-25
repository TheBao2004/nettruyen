<?php

$data = [
    'nameTitle' => 'Users'
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
    $filter .= "WHERE `fullname` LIKE '%$check%' OR email LIKE '%$check%' ";
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

$numberUsers = getCountRows("SELECT * FROM users $filter");

$numberItem = ceil($numberUsers/_COUNT_ITEM);

if(!empty($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$limitStart = ($page-1)*_COUNT_ITEM;

$limitEnd = _COUNT_ITEM;

$allUsers = getRows("SELECT * FROM users $filter ORDER BY id DESC LIMIT $limitStart, $limitEnd");

$msg = getFlashData('msg');
$type = getFlashData('type');

?>


<div class="container-fluid">

<?php getAlert($msg, $type); ?>

<button type="button" class="btn btn-success "><a href="?module=users&active=add" class="text-light">Add user <i class="fa fa-plus mx-1"></i></a></button>

<form action="" method="get">

    <div class="row py-3 px-2 my-2 mx-1 rounded border border-success">

    <input type="hidden" name="module" value="users">

    <div class="form-group col-4 my-auto">
    <input type="text" name="check" class="form-control" placeholder="Enter" value="<?php echo !empty($check)?$check:$check; ?>">
    </div>  

    <div class="form-group col-4 my-auto">
        <select name="status" id="" class="form-control">
            <option value="0">Choose</option>
            <option <?php echo !empty($selected) && $selected==1?'selected':''; ?> value="1">Status</option>
            <option <?php echo !empty($selected) && $selected==2?'selected':''; ?> value="2">No status</option>
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
    <th class="col-1">Id</th>
    <th class="col-2">Name</th>
    <th class="col-3">Email</th>
    <th class="col-2">Avatar</th>
    <th class="col-1">Status</th> 
    <th class="col-1">Permission</th>
    <th class="col-1">Fix</th>
    <th class="col-1">Remove</th>
    </tr>
</thead>

<tbody>
    <?php
        if(!empty($allUsers)):
            foreach ($allUsers as $key => $value):
    ?>
    <tr>
    <td class=""><?php echo $value['id']; ?></td>
    <td class=""><?php echo $value['fullname']; ?></td>
    <td class=""><?php echo $value['email']; ?></td>
    <td class=""><img src="<?php echo !empty($value['avatar'])?$value['avatar']:'https://yt3.ggpht.com/a/AGF-l7-_BjmTIT3g5Y7o3JaOJzxJiCaTmUK5mH73Qg=s900-c-k-c0xffffffff-no-rj-mo'; ?>" width="90%" class="rounded-circle elevation-2" alt="User Image"></td>
    <td ><a class="text-<?php echo $value['status']==1?'primary':'danger'; ?>" href=""><?php echo $value['status']==1?'yes':'no'; ?></a></td>
    <td ><a class="text-<?php echo $value['admin']==1?'danger':'primary'; ?>" href=""><?php echo $value['admin']==1?'admin':'user'; ?></a></td>
    <td class="">
    <?php if($value['admin'] == 1): ?>
        <button type="button" class="btn btn-success"><a class="text-light" onclick="return alert(`you couldn't to be fix admin !!!`);" href=""><i class="fa fa-check"></i></a></button>
        <?php else: ?>
        <button type="button" class="btn btn-warning"><a class="text-light" href="?module=users&active=fix&id=<?php echo $value['id']; ?>"><i class="fa fa-wrench"></i></a></button>
        <?php endif ?>
    </td>
    <td class="">
        <?php if($value['admin'] == 1): ?>
        <button type="button" class="btn btn-success"><a class="text-light" onclick="return alert(`you couldn't to be remove admin !!!`);" href=""><i class="fa fa-check"></i></a></button>
        <?php else: ?>
        <button type="button" class="btn btn-danger"><a class="text-light" onclick="return alert('do you relly want remove !!!');" href="?module=users&active=delete&id=<?php echo $value['id']; ?>"><i class="fa fa-trash-alt "></i></a></button>
        <?php endif ?>
    </td>
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
      <a class="page-link text-success border-success d-<?php echo $page==1?'none':''; ?>" href="?module=users<?php echo $strFilter; ?>&page=<?php echo $back; ?>" aria-label="Previous">
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

    <li class="page-item border-success"><a class="page-link border-success bg-<?php echo $page==$i?'success':''; ?> text-<?php echo $page==$i?'light':'success'; ?>" href="?module=users<?php echo $strFilter; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

    <?php
    
        endfor;
        endif;
    ?>

    <li class="page-item border-success">
      <a class="page-link text-success border-success d-<?php echo $page==$numberItem?'none':''; ?>" href="?module=users<?php echo $strFilter; ?>&page=<?php echo $next; ?>" aria-label="Next">
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