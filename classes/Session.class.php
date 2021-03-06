<?php
/**
 * Created by PhpStorm.
 * User: Nikhil Ghind
 * Date: 06-02-2019
 * Time: 06:21 PM
 */

class Session
{
    public static function start_session(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public static function startSession($user_id){
        self::start_session();
        $_SESSION['user_id']= $user_id;
    }

    public static function isSessionStart(){
        self::start_session();
        if(isset($_SESSION['user_id'])){
            return true;
        }else{
            return false;
        }
    }

    public static function destroySession(){
        if(self::isSessionStart()){
            unset($_SESSION['user_id']);
            session_destroy();
        }
    }

}