<?php
/**
 * Created by JetBrains PhpStorm.
 * Author: Mohammad Saleh Nouri
 * Date: 13/01/13
 * Time: 11:41
 */
include 'database.inc.php';
$db= Database::getInstance();

if (isset($_POST['option'] )&& isset($_POST['id'] )&& isset ($_POST['param'])){
    $option = $_POST['option'];
    $id = $_POST['id'];
    $param = $_POST['param'];

    switch ($option){
        case 'size':
            $data = explode(',', $param);
            $query = 'UPDATE tbl_notes SET w = '.$data[0].',
            h = '.$data[1].' WHERE     id = '.$id;
            $db->get_query($query);
            break;
        case 'move':
            $data = explode(',', $param);
            $query = 'UPDATE tbl_notes SET x = '.$data[0].',
            y = '.$data[1].' WHERE     id = '.$id;
            $db->get_query($query);
            break;
        case 'edit':
            $query = 'UPDATE tbl_notes SET note = "'. mysql_real_escape_string( $param).'" WHERE id = '.$id;
            $db->get_query($query);
            break;
    }

}