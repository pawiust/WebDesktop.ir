<?php
/**
 * Author: Mohammad Saleh Nouri
 * Date: 13/01/13
 * Time: 14:11
 */
$pId =$_POST['pId'];
include 'database.inc.php';
$db= Database::getInstance();
$result =$db->get_query('DELETE FROM `tbl_notes` WHERE  id=' . $pId);
echo $result;