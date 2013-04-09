<?php
/**
 * Author: Mohammad Saleh Nouri
 * Date: 13/01/13
 * Time: 14:11
 */
$user =$_POST['userId'];
include 'database.inc.php';
$db= Database::getInstance();
$result =$db->NewNote($user);
echo $result;