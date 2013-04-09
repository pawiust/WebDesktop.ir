<?php
/**
 * Author: Mohammad Saleh Nouri
 * Date: 14/01/13
 * Time: 23:25
 */

if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');
include 'database.inc.php';

/**
 * Class User
 */
class classUser
{
    private $db;

    public function __construct(){
        $this->db= Database::getInstance();
    }
    private  function Register($email,$pass){
        $query='INSERT INTO tbl_users    (
                email, password ) VALUES ( '.$email.' , MD5('. $pass . '))';
        return $this->db->insert_query($query);
    }
    public function Login($email,$pass){
        // check is user registered
        $result =-1;
        $query='SELECT id FROM tbl_users WHERE email= '.$email;
        $check =  mysql_fetch_assoc( $this->db->get_query($query));
        if ($check['id']){
            //exist check for password
            $query='SELECT id FROM tbl_users WHERE email= '.$email.' AND password = MD5('. $pass . ')';
            $resultQuery= mysql_fetch_assoc( $this->db->get_query($query));
            if ($resultQuery['id'])
                $result = $resultQuery['id'];
        }else{
            // does not exist register
            $result= $result =0;
        }
        return $result; //$this->db->get_query($query);
    }
    function send_mail($email,$body)
    {
        $from ='noreply@webdesktop.ir';
        $subject='Your WebDesktop\'s Password';
        $headers = '';
        $headers .= "From: $from\n";
        $headers .= "Reply-to: $from\n";
        $headers .= "Return-Path: $from\n";
        $headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Date: " . date('r', time()) . "\n";
        mail($email,$subject,$body,$headers);
    }
}
