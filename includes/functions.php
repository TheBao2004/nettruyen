<?php

function layout($file, $rank, $data=[]){

    $path = _WEB_PATH_TEMPLATE.'/'.$rank.'/layouts/'.$file.'.php';

    if(file_exists($path)){
        require $path;
    }else{
        require _WEB_PATH_ROOT.'/modules/erorrs/layout.php';
    }

}

function isLogin(){

    $check = false;
    $token = getSession('login');

    if(!empty($token)){
        $loginToken = getFirstRow("SELECT * FROM login_token WHERE token='$token'");
        if(!empty($loginToken)){
            $check = $loginToken;
        }
    }else{
        removeSession('login');
        delete('login_token');
    }

    return $check;

}

function is_Get(){

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        return true;

    }
    return false;
}



function is_Post(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        return true;

    }
    return false;
}

function getRequest($method=''){

    $dataArr = [];

    if(empty($method)){
  
        if(is_Get()){
        
        if(!empty($_GET)){

            foreach ($_GET as $key => $value) {
                $key = strip_tags($key);
                if(is_array($key)){
                    $dataArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $dataArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }

        }

    }

    if(is_Post()){
        
        if(!empty($_POST)){

            foreach ($_POST as $key => $value) {
                $key = strip_tags($key);
                if(is_array($key)){
                    $dataArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $dataArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }

        }

    }

    }else{
   

        if($method == 'get'){   
 
                if(!empty($_GET)){
        
                    foreach ($_GET as $key => $value) {
                        $key = strip_tags($key);
                        if(is_array($key)){
                            $dataArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        }else{
                            $dataArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                        }
                    }
        
                }
        
    
        

        }else if($method == 'post'){

  
                if(!empty($_POST)){
        
                    foreach ($_POST as $key => $value) {
                        $key = strip_tags($key);
                        if(is_array($key)){
                            $dataArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        }else{
                            $dataArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                        }
                    }
        
                }
        
    

        }


    }

    
return $dataArr;

}

function getActive($module=null){
    if(!empty($module) && is_array($module) && !empty($_GET['module'])){
        if(in_array($_GET['module'], $module)){
            return true;
        }
    }
    if(!empty($module) && !empty($_GET['module']) && $module==$_GET['module']){
        return true;
    }
    return false;
}


function getAlert($msg='', $type='success'){
    if($msg){
        echo '<div class="alert alert-'.$type.'">';
        echo $msg;
        echo '</div>';
    }
}

function getLinkFilter($arrFilter = []){
    $filter = '';
    if(!empty($arrFilter)){
        foreach ($arrFilter as $key => $value) {
            $filter .= '&'.$key.'='.$value; 
        }
        return $filter;
    }
    return false;
}

function formErorr($erorr=''){
    if(!empty($erorr)){
        echo '<span class="text-danger">'.$erorr.'</span><br>';
    } 
}

function redirect($url='index.php'){
    header('Location: '.$url);
    exit();
}

function getOption($condition){

    $result = null;

    if(!empty($condition)){
        $result = getFirstRow("SELECT value_option FROM options WHERE name_option='$condition'");
        return $result['value_option']; 
    }

    return false;

}


function formatDate($date, $format){

    $object = date_create($date);
    if(is_object($object)){
        return date_format($object, $format);
    }

    return false;
}

function shortStr($str, $len){

    $short = $str;

    if(strlen($short) > $len){
        $short = substr_replace($short, '...', $len);
    }

    return $short;

}

function saveActivity(){



}


function saveActivityHistory($userId, $bookId, $chapId){

    if(!empty($userId) && !empty($bookId) && !empty($chapId)){
        $data = [];

        $detailHistory = getFirstRow("SELECT id FROM history WHERE id_user='$userId' AND id_book='$bookId'");
        if(!empty($detailHistory)){
            $id = $detailHistory['id'];
            $data = [
                'id_chap' => $chapId,
                'lastActivity' => date('Y-m-d H:i:s')
            ];
            update('history', $data, "id='$id'");
        }else{
            $data = [
                'id_user' => $userId,
                'id_book' => $bookId,
                'id_chap' => $chapId,
                'lastActivity' => date('Y-m-d H:i:s'),
                'createAt' => date('Y-m-d H:i:s')
            ];
            insert('history', $data);
        }

    }

}   

function removeAllLastActivity(){

    $timeNow = strtotime(date("Y-m-d H:i:s")); 

    $allHistory = getRows("SELECT * FROM history");

    if(!empty($allHistory)){
        foreach ($allHistory as $key => $value) {
            $timeLast = strtotime($value['lastActivity']);
            $time = $timeNow - $timeLast;
            $time = floor($time/60);
            if($time > 86400*_TIME_HISTORY){
                $id = $value['id'];
                delete('history', "id='$id'");
            }
        }
    }

}

function getRealTime($time){

    $result = 0;

    $time = strtotime($time);
    $date = strtotime(date("Y-m-d H:i:s"));
    $now = $date - $time;   

    if($now < 0){
        return 'ERORR TIME UPDATE !!!';
    }    

    if($now > 31536000){
        $result = floor($now/31536000);
        if($result == 0){
            $result = 1;
        }
        $result = $result.' years';
    }elseif ($now > 2592000) {
        $result = floor($now/2592000);
        if($result == 0){
            $result = 1;
        }
        $result = $result.' months';
    }elseif ($now > 86400) {
        $result = floor($now/86400);
        if($result == 0){
            $result = 1;
        }
        $result = $result.' days';
    }elseif($now > 3600){
        $result = floor($now/3600);
        if($result == 0){
            $result = 1;
        }
        $result = $result.' hours';
    }else{
        $result = floor($now/60);
        if($result == 0){
            $result = 1;
        }
        $result = $result.' minutes';
    }
    
    return $result.' ago';

}

function formatInt($int){
    if(empty($int)){
        $int = 0;
    }
   
    return $int;
}

function getCommentChild($userId, $page, $place, $id_parents){

    if($page == 'book'){
    $allComments = getRows("SELECT c.*, u.fullname AS 'name_u', u.avatar AS 'avatar', u.admin AS 'admin' FROM comments AS c LEFT JOIN users AS u ON c.id_user = u.id WHERE id_parents='$id_parents' AND id_book='$place'");
    }elseif ('chap') {
    $chapId = $place['id_chap'];    
    $allComments = getRows("SELECT c.*, u.fullname AS 'name_u', u.avatar AS 'avatar', u.admin AS 'admin' FROM comments AS c LEFT JOIN users AS u ON c.id_user = u.id WHERE id_parents='$id_parents' AND id_chap='$chapId'");    
    }


 
    if(!empty($allComments)){

        foreach ($allComments as $key => $value) {

?>



<div class="col-11 mt-4 mx-auto row">
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
            <?php if($page == 'book'): ?>
                <a class="text-primary" href="?module=books&active=detail&id=<?php echo $place; ?>&id_comment=<?php echo $value['id']; ?>#comment"><i class="fa fa-comment-o"></i>replay</a>
            <?php else: ?>
                <a class="text-primary" href="?module=chaps&id_book=<?php echo $place['id_book']; ?>&id=<?php echo $place['id_chap']; ?>&id_comment=<?php echo $value['id']; ?>#comment"><i class="fa fa-comment-o"></i>replay</a>
            <?php endif; ?>    
            <?php if($value['id_user'] == $userId): ?>
            <a class="text-danger" onclick="return comfirm(`Do you want remove this comment !!!`);" href="?module=books&active=remove_comment&id=<?php echo $value['id']; ?>"><i class="fa fa-times-circle mx-2"></i>remove</a></p>
            <?php endif; ?>  
        </p>
        </div>
        <p><?php echo $value['comment']; ?></p>
    </div>

    <?php getCommentChild($userId, $page, $place, $value['id']); ?>

</div>




<?php
        }

    }else{
        return false;
    }

}


function addViewBook($bookId=0){

    if(empty($bookId)) return false;

    $detailBook = getFirstRow("SELECT * FROM book WHERE id='$bookId'");

    $dataUpdate = [
        'view_number' => $detailBook['view_number']+1
    ];

    $statusUpdate = update('book', $dataUpdate, "id='$bookId'");

    return $statusUpdate;
}


function removeComment($id){

    $commentId = $id;
    $detailComment = getFirstRow("SELECT id FROM comments WHERE id='$commentId'");

    if(!empty($detailComment)){
        $arrChildComment = getRows("SELECT id FROM comments WHERE id_parents='$commentId'");
        delete('comments', "id='$commentId'");
        if(!empty($arrChildComment)){
            foreach ($arrChildComment as $key => $com) {
                removeComment($com['id']);
            }
        }
    }

}
?>