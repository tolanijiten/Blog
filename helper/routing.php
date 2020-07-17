<?php
/**
 * Created by PhpStorm.
 * User: Nikhil Ghind
 * Date: 06-02-2019
 * Time: 06:57 PM
 */

include_once ("../includes/constants.php");

spl_autoload_register(function ($class_name){
    include "../classes/".$class_name.'.class.php';
});

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new Database();
    $conn = $db->getConnection();
    $auth = new Authentication($conn);

    echo $auth->login($username,$password);
}

if(isset($_POST['logout'])){
    $db= new Database();
    $conn = $db->getConnection();

    $auth = new Authentication($conn);

    $auth->logout();

}