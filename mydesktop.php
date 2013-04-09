<?php
session_name('wdLogin');
// Starting the session
session_start();
//
define('INCLUDE_CHECK',true);
if (!isset($_SESSION['id'])){
    header("Location: index.php");
}
$user=$_SESSION['id'];
include ('includes/database.inc.php');
$db = Database::getInstance();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>WebDesktop (BETA)</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css"/>

    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css"
          type="text/css" media="all"/>
    <link rel="stylesheet" href="css/style.css"/>

    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript"></script>

    <script src="js/touch.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/notes.js"></script>

    <script type="text/javascript">
        userId = <?php echo $user; ?>;
        $(function () {


        <?php

        $query ="select * from tbl_notes WHERE user=".$user;

        $result = $db->get_query($query);

        while ($row = mysql_fetch_assoc($result)){

            echo "loadNotes(".$row['id'].", ".$row['x'].", ". $row['y'].", ". $row['w'].", ". $row['h'].");";

        }

        ?>








        });
        function NotePad(){

            $('#notepad')

					/*
                    .css({
                        position:"absolute",
                        left: ($(window).width()/2-$('#notepad').width()/2) + "px",
                        top: ($(window).height()/2-$('#notepad').height()/2) + "px",
                        display:'block',
                        zIndex:'1000'
                    })
                    .load('includes/notepad.php').fadeIn(1000);*/
        }
        function bold(){
            document.execCommand('bold', false, null);
            return false;
        }
        function underline(){
            document.execCommand('underline', false, null);
            return false;
        }
        function italic(){
            document.execCommand('italic', false, null);
            return false;
        }

    </script>
    <style type="text/css">

        .menu {
            margin-left:15px ;
            margin-right: 15px;
            margin-top: 5px;

            padding-left: 20px;;
            height: 20px;
            border: 1px solid #000;
            background: rgba(0,0,0,.5);
            text-align: center;
            display: run-in;
        }

        .options {
            cursor: pointer;
            color: #FFF;
            Verdana, Arial, Helvetica, sans-serif;
            font-size: 16px;
            margin-left: 3px;
            margin-right: 3px;
            float: left;
        }

        a {
            text-decoration: none;
            color: #ffffff;
        }
    </style>
</head>

<body>
<div class="topContainer"></div>

<div id="container" >




    <div id="toolbar">

        <a href="#" onclick="addNote(); "><img src="images/sticky-icon.png" title="add Sticky Note"/></a>
        <a href="#" onclick="NotePad(); "><img src="images/notepad.png" title="NotePad"/></a>
    </div>



</div>
<div id="error" style="color: red"></div>
<div id= "notepad"></div>
</body>

</html>