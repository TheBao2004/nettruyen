<?php

if(!empty($_GET['id']) && !empty($_GET['id_book'])){
    $bookId = $_GET['id_book'];
    addViewBook($bookId);   
    $chapId = $_GET['id'];
    $detailChap = getRows("SELECT ci.*, c.name AS 'name_c', b.title AS 'name_b', b.view_number AS 'view_number' FROM chap AS c INNER JOIN book AS b ON c.id_book = b.id LEFT JOIN chap_img AS ci ON c.id = ci.id_chap WHERE b.id = '$bookId' AND ci.id_chap ='$chapId'");

    if(!empty($detailChap)){
       
    }else{
        setFlashData("msg", "Couldn't be see, ERORR DATABASE!!!");
        setFlashData("type", "danger");
        redirect(_WEB_HOST_ROOT.'#erorr');
        die();
    }
}else{
    setFlashData("msg", "Couldn't be see, ERORR URL!!!");   
    setFlashData("type", "danger");
    redirect(_WEB_HOST_ROOT.'#erorr');
    die();
}


$data = [
    'nameTitle' => $detailChap[0]['name_c'].' - '.$detailChap[0]['name_b'],
    'namePage' => 'Books',
    'nameChap' => $detailChap[0]['name_c'].' - '.$detailChap[0]['name_b'],
    'nameBook' => $detailChap[0]['name_b']
];

layout('header', 'client', $data);

        if(!empty(_MY_DATA['id'])){
            $userId = _MY_DATA['id'];
            saveActivityHistory($userId, $bookId, $chapId);
        }

layout('breadcrumb', 'client', $data);

$arrChap = getRows("SELECT c.*, id_chap FROM chap AS c LEFT JOIN chap_img AS ci ON c.id = ci.id_chap WHERE id_book='$bookId' ORDER BY c.stt_chap DESC");

$count = 0;
$check = '';

foreach ($arrChap as $key => $value) {
    unset($arrChap[$key]);
    if(!empty($value['id_chap'])){
        if($value['id'] != $check){
            $arrChap[$count] = $value;
            $count++;   
            $check = $value['id'];
        }
    }
} 

foreach ($arrChap as $key => $value) {
    $arrSttChap[$key] = $arrChap[$key]['stt_chap'];  
    if($value['id'] == $chapId){
        $chapNow = $key;
    }
    $chapMax = $key;
}


$chapBack = $chapNow+1;
$chapNext = $chapNow-1;

if($chapBack > $chapMax){
    $chapBack = $chapMax;
}

if($chapNext < 0){
    $chapNext = 0;
}

?>

<!-- Start Team -->
<section id="team" class="team section pb-1 pt-3">
    <div class="container">
        <div class="row">
        <div class="col-6 mx-auto">

        <nav id="menu" class="navbar navbar-expand-lg navbar-light bg-light p-0 mb-5">
        <div class="collapse navbar-collapse bor-green" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto bor-green w-100">
            <li class="nav-item active bor-green bg-<?php echo ($chapNow == $chapMax)?'secondary':'color'; ?>">
            <!-- <li class="nav-item active bor-green bg-secondary ?>"> -->
                <a class="nav-link" <?php echo ($chapNow == $chapMax)?'onclick="return alert('.'`Please read next chap !!!`'.')"':'href="?module=chaps&id_book='.$bookId.'&id='.$arrChap[$chapBack]['id'].'#menu"'; ?>><i class="text-light fa fa-angle-double-left mx-3"></i><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown w-100 bor-green">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $detailChap[0]['name_c']; ?>
                </a>
                <div class="dropdown-menu w-100" aria-labelledby="navbarDropdown">

                <?php
                
                foreach ($arrChap as $key => $value) {
                    echo '<a class="dropdown-item" href="'._WEB_HOST_ROOT.'?module=chaps&id_book='.$bookId.'&id='.$value['id'].'#menu">'.$value['name'].'</a>';
                }

                ?>

            </li>
            <li class="nav-item active bor-green bg-<?php echo ($chapNow == 0)?'secondary':'color'; ?>">
                <a class="nav-link" <?php echo ($chapNow == 0)?'onclick="return alert('.'`Over chap !!!`'.')"':'href="?module=chaps&id_book='.$bookId.'&id='.$arrChap[$chapNext]['id'].'#menu"'; ?>><i class="text-light fa fa-angle-double-right mx-3"></i><span class="sr-only">(current)</span></a>
            </li>
            </ul>
        </div>
        </div>
        </nav> 


        </div>	

        <div class="col-12">

        <?php 
            if(!empty($detailChap)){
                foreach ($detailChap as $key => $value) {
                    echo ' <img width="100%" src="'.$value['link_img'].'" alt="'.$value['name_c'].' - '.$value['name_b'].'">';
                }
            }
        ?>

        </div>


        <div class="col-6 mx-auto mt-5">

        <nav id="menu" class="navbar navbar-expand-lg navbar-light bg-light p-0 mb-5">
        <div class="collapse navbar-collapse bor-green" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto bor-green w-100">
            <li class="nav-item active bor-green bg-<?php echo ($chapNow == $chapMax)?'secondary':'color'; ?>">
            <!-- <li class="nav-item active bor-green bg-secondary ?>"> -->
                <a class="nav-link" <?php echo ($chapNow == $chapMax)?'onclick="return alert('.'`Please read next chap !!!`'.')"':'href="?module=chaps&id_book='.$bookId.'&id='.$arrChap[$chapBack]['id'].'#menu"'; ?>><i class="text-light fa fa-angle-double-left mx-3"></i><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown w-100 bor-green">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $detailChap[0]['name_c']; ?>
                </a>
                <div class="dropdown-menu w-100" aria-labelledby="navbarDropdown">

                <?php
                
                foreach ($arrChap as $key => $value) {
                    echo '<a class="dropdown-item" href="'._WEB_HOST_ROOT.'?module=chaps&id_book='.$bookId.'&id='.$value['id'].'#menu">'.$value['name'].'</a>';
                }

                ?>

            </li>
            <li class="nav-item active bor-green bg-<?php echo ($chapNow == 0)?'secondary':'color'; ?>">
                <a class="nav-link" <?php echo ($chapNow == 0)?'onclick="return alert('.'`Over chap !!!`'.')"':'href="?module=chaps&id_book='.$bookId.'&id='.$arrChap[$chapNext]['id'].'#menu"'; ?>><i class="text-light fa fa-angle-double-right mx-3"></i><span class="sr-only">(current)</span></a>
            </li>
            </ul>
        </div>
        </div>
        </nav> 

        </div>

        </div>	






    </div>
</section>
<!--/ End Team -->

<section class="blogs-main archives single section pt-0">
    <div class="container">


<div class="row">
    <div class="col-12 mx-auto">
        <div class="blog-comments">

            <?php

            $allComments = getRows("SELECT c.*, u.fullname AS 'name_u', u.avatar AS 'avatar', u.admin AS 'admin' FROM comments AS c LEFT JOIN users AS u ON c.id_user = u.id WHERE id_parents='0' AND id_chap='$chapId'");

            ?>

            <h2 class="title text-success">
            <i class="fa fa-comment-alt mr-2"></i>
            <?php
                $numberComments = getCountRows("SELECT id FROM comments WHERE id_chap='$chapId'");;
                echo $numberComments.' Comments';
            ?>
            </h2>
            <div class="comments-body">

            <?php  
            

             
            if(!empty($allComments)):

                $place = [
                    'id_book' => $bookId,
                    'id_chap' => $chapId
                ];

                foreach ($allComments as $key => $value):
            
            ?>   

            <div class="single-comments">
                <div class="main">
                    <div class="head">
                        <img src="<?php echo !empty($value['avatar'])?$value['avatar']:'https://yt3.ggpht.com/a/AGF-l7-_BjmTIT3g5Y7o3JaOJzxJiCaTmUK5mH73Qg=s900-c-k-c0xffffffff-no-rj-mo'; ?>" alt="<?php echo $value['name_u']; ?>">
                    </div>
                    <div class="body">
                        <h4 class="d-flex align-items-center">
                            <?php echo $value['name_u']; ?>
                            <?php if($value['admin'] == 1){
                                echo '<span class="right badge badge-danger ml-2">Admin</span>';
                            } ?>
                        </h4>
                        <div class="comment-info"> 
                        <p>
                            <span><?php echo formatDate($value['createAt'], "Y-m-d"); ?> at<i class="fa fa-clock-o"></i><?php echo formatDate($value['createAt'], "H:i"); ?></span>
                            <a class="text-primary" href="?module=chaps&id_book=<?php echo $bookId; ?>&id=<?php echo $chapId; ?>&id_comment=<?php echo $value['id']; ?>#comment"><i class="fa fa-comment-o"></i>replay</a>
                            <?php if($value['id_user'] == $userId): ?>
                            <a class="text-danger" onclick="return comfirm(`Do you want remove this comment !!!`);" href="?module=books&active=remove_comment&id=<?php echo $value['id']; ?>"><i class="fa fa-times-circle mx-2"></i>remove</a></p>
                            <?php endif; ?>    
                        </div>
                        <p><?php echo $value['comment']; ?></p>
                    </div>
                </div>

                        <?php getCommentChild($userId, 'chap', $place, $value['id']); ?>

            </div>    

            <?php  

                endforeach;
                else:
                    
            ?>   
            <span class="btn bg-danger py-3 w-100">No comment</span>
            <?php
                endif;
            ?>
                

            </div>
        </div>
    </div>
</div>

<div class="row">

<div class="col-12 mx-auto">
    <div class="comments-form">
        <?php
        
        if(!empty($_GET['id_comment'])){
            $id_comment = $_GET['id_comment'];
            $detailUser = getFirstRow("SELECT u.* FROM users AS u INNER JOIN comments AS c ON u.id = c.id_user WHERE c.id='$id_comment'");
        }

        $msg = getFlashData('msg');
        $type = getFlashData('type');
        
        getAlert($msg, $type);    

        ?>
        <h2 class="title" id="comment"><?php echo !empty($detailUser)?'Answer: <span class="text-success">'.$detailUser['fullname'].'</span>':'' ?></h2>


<?php

if(is_Post()){

    $data = getRequest();
    $erorrs = [];

    if(empty($data['comment'])){
        $erorrs['comment'] = 'Please enter your comment !!!';
    }

    if(empty($erorrs)){

        $dataInsert = [
            'id_user' => $userId,
            'id_chap' => $chapId,
            'id_parents' => 0,
            'comment' => $data['comment']
        ];

        echo '<pre>';
        print_r($dataInsert);
        echo '</pre>';

        
        if(!empty($detailUser)){
            $dataInsert['id_parents'] = $id_comment;
        }

        $statusInsert = insert('comments', $dataInsert);

        if(!empty($statusInsert)){
            setFlashData('msg', 'Comment success !!!');
            setFlashData('type', 'success');
            redirect("?module=chaps&id_book=$bookId&id=$chapId#comment");
        }


    }else{
        setFlashData('msg', 'Please enter your comment !!!');
        setFlashData('type', 'danger');
    }

    if(!empty($detailUser)){
        redirect("?module=chaps&id_book=$bookId&id=$chapId&id_comment=$id_comment#comment");
    }else{
        redirect("?module=chaps&id_book=$bookId&id=$chapId#comment");
    }



}


?>



        <!-- Contact Form -->
        <form class="form" method="post" action="">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <textarea name="comment" rows="5" placeholder="Comment ..." ></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group button">
                        <button type="submit" class="btn primary">Submit Comment</button>
                    </div>
                </div>
            </div>
        </form>
        <!--/ End Contact Form -->
    </div>
</div>

</div>



    </div>
</section>



<?php

layout('footer', 'client');

?>