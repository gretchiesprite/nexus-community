<?php

session_start();

//error_reporting(E_ALL);
//ini_set( 'display_errors','1'); 

require_once($_SESSION['appRoot'] . "control/forum_sso_functions.php");
require_once($_SESSION['appRoot'] . "model/pgDb.php");

$_SESSION['forumSessionError'] = $_SESSION['authtoken'] = $forumUsername = "";

forumSignout();

$cursor = pgDb::getForumUserByNexusId($_SESSION['uidpk']);
while ($row = pg_fetch_array($cursor)) {
	//$forumUsername = $row['username'] . $row['id'];
	$forumUsername = $row['name'];
}
	
// Login user to forum
$user = array();
$user['user'] = $forumUsername;
$login_status = forumSignin($user);
if($login_status == 'Login Successful') {
	$_SESSION['forumSessionError'] = "noError";
} else {
	$_SESSION['forumSessionError'] = $login_status;
	// TODO: Why is error message not showing up on page when authtoken is not existing?
}
	
header("location:../view/nexus.php?thisPage=forum");

exit(0);

?>