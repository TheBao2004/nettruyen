<?php

$data = [
	'nameTitle' => 'Books',
	'namePage' => 'Books'
];

layout('header', 'client', $data);

layout('breadcrumb', 'client', $data);


?>
		<!-- Start Team -->
		<section id="team" class="team section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h1 id="erorr">Truyen B's Book</h1>
						</div>
					</div>
				</div>

<?php 

$data = getRequest();

$check = null;

$filter = '';
$strFilter = '';

if(!empty($data['check'])){
    $check = $data['check'];
    $filter .= "WHERE b.title LIKE '%$check%'";
    $strFilter .= "&check=$check";
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

if(!empty($data['id_country'])){
    $country = $data['id_country'];
    if(!empty($filter)){
        $filter .= "AND `id_country`='$country'";
    }else{
        $filter .= "WHERE `id_country`='$country'";
    }
    $strFilter .= "&id_country=$country";
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


$allAuthors = getRows("SELECT id, `fullname` FROM author");

$allCountries = getRows("SELECT id, `name` FROM country");

$allKindOf = getRows("SELECT id, `name` FROM book_kind_of");

?>


                <form action="" method="get" class="row p-2 border-success border rounded">


                    <input type="hidden" name="module" value="books">


                    <div class="form-group col-4">
                        <label for="">Keyword</label>
                        <input type="text" name="check" value="<?php echo $check; ?>" class="form-control w-100" placeholder="Enter">
                    </div>

                    <div class="form-group col-4">
                        <label for="">Auther</label>
                        <select name="id_author" id="" class="form-control w-100">
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

                    <div class="form-group col-4">
                        <label for="">Country</label>
                        <select name="id_country" id="" class="form-control w-100">
                            <option value="0">Choose</option>

                            <?php
                                if(!empty($allCountries)):
                                    foreach ($allCountries as $key => $value):
                            ?>
                                <option <?php echo (!empty($country) && $country==$value['id'])?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['id'].' - '.$value['name']; ?></option>
                            <?php
                            endforeach;
                            endif;
                            ?>

                        </select>
                    </div> 

                    <div class="form-group col-4">
                        <label for="">Kind Of</label>
                        <select name="id_kindof" id="" class="form-control w-100">
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

                    <div class="form-group col-4">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control w-100">
                            <option value="0">Choose</option>
                            <option <?php echo !empty($selected) && $selected==1?'selected':''; ?> value="1">Over</option>
                            <option <?php echo !empty($selected) && $selected==2?'selected':''; ?> value="2">Not yet</option>
                        </select>
                    </div> 
                       
                    <div class="form-group col-12">
                        <input type="submit" value="Submit" class="form-control w-100 text-light btn bg-success">
                    </div>

                </form>    

				<div class="row">

<?php


$numberBooks = getCountRows("SELECT b.id FROM book AS b LEFT JOIN author AS a ON b.id_author = a.id LEFT JOIN book_kind_of AS k ON b.id_kindof = k.id $filter");

$numberItem = ceil($numberBooks/_LIST_BOOKS);

if(!empty($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$limitStart = ($page-1)*_LIST_BOOKS;

$limitEnd = _LIST_BOOKS;

$allBooks = getRows("SELECT b.*, a.fullname AS 'name_author' FROM book AS b LEFT JOIN author AS a ON b.id_author = a.id $filter ORDER BY b.updateAt DESC LIMIT $limitStart, $limitEnd");


if(!empty($allBooks)):
	foreach ($allBooks as $key => $value):
		$bookId = $value['id'];
		$follwor_number = getCountRows("SELECT id FROM follwor WHERE id_book='$bookId'");
?>



					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Team -->
						<div class="single-team">
							<div class="t-head">
                            <span class="light text-center d-block w-100 py-2 text-primary">Update: <?php echo getRealTime($value['updateAt']); ?></span>
								<div class="t-icon">
									<img src="<?php echo $value['image']; ?>" alt="erorr">
									<a href="?module=books&active=detail&id=<?php echo $value['id']; ?>">
										<i class="fa fa-eye mx-2"></i>
									</a>
								</div>
							</div>
							<div class="t-bottom">
								<p><?php echo $value['name_author']; ?></p>
								<h2><?php echo $value['title']; ?></h2>
								<ul class="t-social">
									<li class="text-primary"><?php echo $value['view_number']; ?><i class="fa mx-2 fa-eye"></i></li>
									<li class="text-danger"><?php echo $follwor_number; ?><i class="fa mx-2 fa-heart"></i></li>			
								</ul>
							</div>
						</div>
						<!-- End Single Team -->
					</div>	

<?php

	endforeach;
	endif;

?>

		
					</div>	
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

                    <div class="row text-center">

                        <nav aria-label="Page navigation example" class="my-5 mx-auto">
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


				</div>
			</div>
		</section>
		<!--/ End Team -->






<?php

layout('footer', 'client');

?>