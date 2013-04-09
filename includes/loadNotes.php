<?php
include 'database.inc.php';

$noteId = $_POST['noteId'];
$db= Database::getInstance();
$query="select note from tbl_notes where id=" . $noteId;
$row= mysql_fetch_row($db->get_query($query));
echo $row[0];
