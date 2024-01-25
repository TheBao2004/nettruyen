<?php


// if (!defined('_INCODE')) die('Access Deined...');



?>


<div class="debug-wrapper" style="width: 80%; padding: 20px 30px; text-align: center; margin: 0 auto;">
    <h1 style="text-transform: uppercase; color:red;">ERORR DATABASE PLEASE BE AGAIN !!!</h1>
    <hr>
    <p><?php echo $exception->getMessage(); ?></p>
    <p>File: <?php echo $exception->getFile(); ?></p>
    <p>Line: <?php echo $exception->getLine(); ?></p>
</div>
