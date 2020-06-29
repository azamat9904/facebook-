<?php
class Login{
    public static function isLogginedIn(){
        if(isset($_COOKIE['FBID'])){
            if(DB::query('SELECT user_id FROM token WHERE token = :token',array(':token'=>sha1($_COOKIE['FBID'])))){
                return DB::query('SELECT user_id FROM token WHERE token = :token',array(':token'=>sha1($_COOKIE['FBID'])))[0]['user_id'];
            }
        }
    }
}