<?php
/**
 * Author: Mohammad Saleh Nouri
 * Date: 14/01/13
 * Time: 10:11
 */
session_name('wdLogin');
// Starting the session
session_start();
//
define('INCLUDE_CHECK',true);
//include Classes
include 'includes/user.inc.php';
include 'includes/functions.inc.php';

if (isset($_POST['submit']))
{
    $err = array();
    $user = new classUser;


    if($_POST['submit']=='Login'){

       // Will hold our errors

       if(!$_POST['loginEmail'] || !$_POST['loginPass'])
           $err[] = 'All the fields must be filled in!';

       if(!checkEmail($_POST['loginEmail']))
       {
           $err[]='Your email is not valid!';
       }
       if(!count($err))
       {

       $userLogin = $user->Login(GetSQLValueString($_POST['loginEmail'], "text"), GetSQLValueString($_POST['loginPass'],"text")) ;

            if ($userLogin==0){
                $err[]='Account does not exist!';
            }
            elseif ($userLogin==-1){
                $err[]='Wrong password!';
            }
            else {
                $_SESSION['id']=$userLogin;
                $_SESSION['email']=$_POST['loginEmail'];
                header("Location: index.php");
                exit;
            }
       }
       if($err)
           $_SESSION['msg']['login-err'] = implode('<br />',$err);
       // Save the error messages in the session

       header("Location: login.php");
       exit;

   }elseif($_POST['submit']=='Recover'){



   }

    $_POST['submit']='';


}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>WebDesktop (BETA)</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css"/>
<link rel="stylesheet" href="css/style.css"/>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript"></script>

    <script src="assets/js/script.js"></script>

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript">
        $(function () {

	        var formContainer = $('#formContainer');
	        formContainer.find('form').submit(function(e){
		        // Preventing form submissions. If you implement
		        // a backend, you might want to remove this code
		        $email=$('#loginEmail').val();
		        $pass = $('#loginPass').val();
		        if ((($email=='Email')||($email==''))&&(($pass=='Password')||($pass=='')))
		        {
			        e.preventDefault();
			        return false;
		        }

	        });
	        $('#loginPass')
                    .focusin(function(){
                        $txt = $(this).val();
                        if ($txt=='Password'){
                            $(this).val('');}
                        })
                    .focusout(function(){
                       $txt = $(this).val();
                        if ($txt==''){
                            $(this).val('Password');}
                    });
            $('#loginEmail')
                    .focusin(function(){
                        $txt = $(this).val();
                        if ($txt=='Email'){
                            $(this).val('');}
                        })
                    .focusout(function(){
                        $txt = $(this).val();
                        if ($txt==''){
                            $(this).val('Email');}
                    });
        })
    </script>
</head>
<body>



<div class="topContainer"></div>
<div id= "loginPage">

<div id="formContainer">
    <form id="login" method="post" action=""  >

        <input type="text" name="loginEmail" id="loginEmail" value="Email" />

        <input type="password" name="loginPass" id="loginPass" value="Password" />

        <input type="submit" name="submit" value="Login" id="btnLogin"  />
	    <input type="checkbox" name="rememberme" value="remember" id="remember"/>
	    <label for ="remember">Remember me.</label>
    </form>

</div>
</div>
<?php

if(isset($_SESSION['msg']['login-err']))
{
    echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
    unset($_SESSION['msg']['login-err']);
}
?>

</body>





</html>