<?php
/**
 * Created by PhpStorm.
 * User: Nikhil Ghind
 * Date: 05-03-2019
 * Time: 05:13 PM
 */

require_once ("../../classes/Database.class.php");
require_once ("../../classes/Posts.class.php");
$conn = (new Database())->getConnection();

$posts = new Posts($conn);

$posts->updatePost(["deleted"=>1],"post_id = {$_POST['post_id']}");


header("Location: 1");
