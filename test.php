<?php
/**
 * Created by PhpStorm.
 * User: Nikhil Ghind
 * Date: 06-02-2019
 * Time: 08:07 PM
 */

include_once("classes/Database.class.php");
include_once ("classes/Posts.class.php");
include_once ("classes/Categories.class.php");

$db = new Database();

$conn = $db->getConnection();

$post = new Posts($conn);

$array = array("post_category_id"=>10,"post_title"=>"Some new Title","post_body"=>"<b>My Contents!!!</b><b>Added a new line</b>");

//$post->updatePost($array,"post_id = 4");

print_r((new Categories($conn))->readAllCategories());