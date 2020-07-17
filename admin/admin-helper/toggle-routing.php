<?php
/**
 * Created by PhpStorm.
 * User: Nikhil Ghind
 * Date: 05-03-2019
 * Time: 05:32 PM
 */


require_once ("../../classes/Database.class.php");
require_once ("../../classes/Posts.class.php");
$conn = (new Database())->getConnection();

$posts = new Posts($conn);

$result = $posts->readPost($_POST['post_id']);

if($result['post_status'])


header("Location: 1");
