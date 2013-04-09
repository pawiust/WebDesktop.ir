<?php

include('xmlapi.php');
$ip = 'gamemasters.ir';
$account = "gamemast";
$account_pass = "88012162";

$email_user = "mr_dave";
$email_password = "1234";
$email_domain = "webdesktop.ir";
$email_quota = '0';


$xmlapi = new xmlapi( $ip);
$xmlapi->password_auth($account, $account_pass);  
$xmlapi->set_output('xml');

$result = $xmlapi->api1_query($account, "Email", "addimap", array($email_user, $email_password, $email_quota, $email_domain) );

print_r( $result);

$cpuser = "gamemast";
$cppass = "88012162";
$euser = "ee123";
$epass = "1234abcd";
$equota = "0";
$domain = "webdesktop.ir";
$url = "http://".$cpuser.":".$cppass."@".$domain.":2082/frontend/x3/mail/doaddpop.html?email=".$euser."&domain=".$domain."&password=".$epass."&quota=".$equota;
if($cpanel = fopen($url, "r"))
{
echo "Success email creation.";

	while( !feof($cpanel) ) {
$txt .= fread( $cpanel, 2082 );
}
fclose($cpanel);
}
echo $txt;

?>
