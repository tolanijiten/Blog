<?php
/**
 * Created by PhpStorm.
 * User: Nikhil Ghind
 * Date: 08-02-2019
 * Time: 10:10 AM
 */

spl_autoload_register(function($class_name){
    include "../../classes/".$class_name.'.class.php';
});



if(isset($_POST['post_submit'])){
    $data = array();
    $date = date("Y-m-d");
    $db = new Database();
    $conn = $db->getConnection();
    $post = new Posts($conn);

    session_start();
    if(isset($_SESSION['user_id'])){
        $post_author_id = $_SESSION['user_id'];
    }else{
        die("How would u reach here");
    }

    $keys = array('post_category_id','post_title','post_body','post_tags','post_status');


    foreach($keys as $key){
        $data += array($key=>$_POST[$key]);
    }

    $data += array("post_image"=>$_FILES['post_image']['name']);
    $data += array("post_author_id"=>$post_author_id);
    $data += array("post_date"=> $date);
    if($post->createPost($data)){
        //Now Upload Image
        $fileName = $_FILES['post_image']['name'];
        $tmpName = $_FILES['post_image']['tmp_name'];
        if(!move_uploaded_file($tmpName , "../../images/".$fileName))
            die("Error While Uploading Image");
    }else{
        die("Error While Inserting Post!");
    }



}