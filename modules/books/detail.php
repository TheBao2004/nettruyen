<?php

if(!empty($_GET['id'])){
    $bookId = $_GET['id'];
    $detailBook = getFirstRow("SELECT b.*, a.fullname AS 'name_author', a.image AS 'image_author', a.description AS 'des_author', k.name AS 'name_kindof' FROM book AS b LEFT JOIN author AS a ON b.id_author = a.id LEFT JOIN book_kind_of AS k ON b.id_kindof = k.id WHERE b.id='$bookId'");
  
    if(!empty($detailBook)){

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
	'nameTitle' => 'Books - '.$detailBook['title'],
	'namePage' => 'Books',
	'nameBook' => $detailBook['title'],
];


layout('header', 'client', $data);

$userId = _MY_DATA['id'];

$detailFollwor = getFirstRow("SELECT * FROM follwor WHERE id_book='$bookId' AND id_user='$userId'");

layout('breadcrumb', 'client', $data);



?>

<!-- Start Team -->
<section id="team" class="team section pb-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h1><?php echo $detailBook['title']; ?></h1>
                </div>
            </div>
        </div>
            <div class="row">

<div class="col-4">

<img src="<?php echo $detailBook['image']; ?>" alt="erorr">

</div>

<div class="col-8">

<h5 class="my-4"><i class="fa fa-pen-fancy mx-2"></i>Author: <?php echo $detailBook['name_author']; ?></h5>
<h5 class="my-4"><i class="fa fa-file-upload mx-2"></i>Status: <span class="text-<?php echo $detailBook['status']==1?'danger':'primary'; ?>" href=""><?php echo $detailBook['status']==1?'over':'not yet'; ?></span></h5>
<h5 class="my-4"><i class="fa fa-align-left mx-2"></i>Kind of: <?php echo $detailBook['name_kindof']; ?></h5>
<h5 class="my-4"><i class="fa mx-2 fa-eye"></i>View: <?php echo $detailBook['view_number']; ?></h5>
<h5 class="my-4"><a href="<?php echo '?module=books&active=follwor&id_book='.$bookId.'&id='.$userId; ?>" class="text-light btn bg-<?php echo !empty($detailFollwor['id'])?'danger':'secondary'; ?>">Follwor <i class="fa mx-2 fa-heart"></i></a></h5>

<hr>

<label for="">Description:</label>

<p><?php echo $detailBook['description']; ?></p>

</div>

            </div>		
        </div>
    </div>
</section>
<!--/ End Team -->

<!-- Blogs Area -->
<section class="blogs-main archives single section pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-12">
                <div class="row">

                    <div class="col-12">
                        <div class="author-details">
                            <div class="author-left">
                                <img src="<?php echo $detailBook['image_author']; ?>" alt="#">
                                <h4 class="my-2"><span><?php echo $detailBook['name_author']; ?></span></h4>
                            </div>
                            <div class="author-content">
                                <p><?php echo $detailBook['des_author']; ?></p>
                            </div>
                        </div>
                    </div>



                    <?php 
                    
                    $allChaps = getRows("SELECT c.*, id_chap FROM chap AS c LEFT JOIN chap_img AS ci ON c.id = ci.id_chap WHERE id_book='$bookId' ORDER BY c.stt_chap DESC");   

                    $count = 0;
                    $check = '';

                    $history = getFirstRow("SELECT id_chap FROM history WHERE id_book='$bookId' AND id_user='$userId'");

                    $historyChap = '';

                    foreach ($allChaps as $key => $value) {
                        if(!empty($history)){
                        if($history['id_chap'] == $value['id']) $historyChap = $value['name'];
                        }
                        unset($allChaps[$key]);
                        if(!empty($value['id_chap'])){
                            if($value['id'] != $check){
                                $allChaps[$count] = $value;
                                $count++;   
                                $check = $value['id'];
                            }
                        }
                    }  
          
                    ?>


                    <div class="col-12">
                    <p class="text-success text-center pt-4 pb-2">
                        <?php echo !empty($historyChap)?'Reading '.$historyChap:'Read now'; ?>
                    </p>

                    <div class="bor-green w-100 p-2">

                    <?php 
                    
                    if(!empty($allChaps)):
                        foreach ($allChaps as $key => $chap):

                    ?>

                    <a href="?module=chaps&id_book=<?php echo $bookId; ?>&id=<?php echo $chap['id']; ?>" class="w-100 mb-1 btn text-light bg-<?php echo ($chap['id'] == $history['id_chap'])?'success':''; ?>">
                    <?php echo $chap['id'].' - '.$chap['name']; ?>
                    </a>

                    <?php endforeach; else: ?>
                        <span class="btn btn-outline-danger w-100">No chap</span>
                    <?php endif; ?>    

                    </div>

                    </div>

                </div>
            </div>
        </div>	
        
        


<div class="row">
    <div class="col-12 mx-auto">
        <div class="blog-comments">

            <?php

            $allComments = getRows("SELECT c.*, u.fullname AS 'name_u', u.avatar AS 'avatar', u.admin AS 'admin' FROM comments AS c LEFT JOIN users AS u ON c.id_user = u.id WHERE id_parents='0' AND id_book='$bookId'");

            ?>

            <h2 class="title text-success">
            <i class="fa fa-comment-alt mr-2"></i>
            <?php
                $numberComments = getCountRows("SELECT id FROM comments WHERE id_book='$bookId'");;
                echo $numberComments.' Comments';
            ?>
            </h2>
            <div class="comments-body">

            <?php  
            

             
            if(!empty($allComments)):
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
                            <a class="text-primary" href="?module=books&active=detail&id=<?php echo $bookId; ?>&id_comment=<?php echo $value['id']; ?>#comment"><i class="fa fa-comment-o"></i>replay</a>
                            <?php if($value['id_user'] == $userId): ?>
                            <a class="text-danger" onclick="return comfirm(`Do you want remove this comment !!!`);" href="?module=books&active=remove_comment&id=<?php echo $value['id']; ?>"><i class="fa fa-times-circle mx-2"></i>remove</a></p>
                            <?php endif; ?>    
                        </div>
                        <p><?php echo $value['comment']; ?></p>
                    </div>
                </div>

                        <?php getCommentChild($userId, 'book', $bookId, $value['id']); ?>

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
            'id_book' => $bookId,
            'id_parents' => 0,
            'comment' => $data['comment']
        ];
        
        if(!empty($detailUser)){
            $dataInsert['id_parents'] = $id_comment;
        }

        $statusInsert = insert('comments', $dataInsert);

        if(!empty($statusInsert)){
            setFlashData('msg', 'Comment success !!!');
            setFlashData('type', 'success');
            redirect("?module=books&active=detail&id=$bookId#comment");
        }


    }else{
        setFlashData('msg', 'Please enter your comment !!!');
        setFlashData('type', 'danger');
    }

    if(!empty($detailUser)){
        redirect("?module=books&active=detail&id=$bookId&id_comment=$id_comment#comment");
    }else{
        redirect("?module=books&active=detail&id=$bookId#comment");
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
<!--/ End Blogs Area -->










<?php

layout('footer', 'client');

?>