<?php

session_start();

require_once("../../../src/framework/Util.php");
require_once(Util::getSrcRoot() . "/user/User.php");

$dirty = array('username' => $_POST['uid'], 'network' => $_POST['network']);
$clean = array();

if (isset($dirty['network']) && Util::validateNetworkIdFormat($dirty['network'])) {
	$clean['network'] = $dirty['network'];
} else {
	$clean['network'] = "";	
}

if (isset($dirty['username']) && Util::validateUsernameFormat($dirty['username'])) {
	$clean['username'] = $dirty['username'];
} else {
	returnToLoginWithMessage(Util::AUTHENTICATION_ERROR, $clean['network']);	
}

// TODO - make sure username is unique and only one is returned
$cursor = User::getUserByUsername($clean['username']);
$result = pg_fetch_array($cursor);
if (isset($result['email']) && isset($result['id'])) {
	if  (Util::validateEmail($result['email'])) {
		$uuid = Util::newUuid();
		User::insertPasswordResetActivity($result['id'], $uuid);
		sendResetEmail($result['email'], $env_appRoot, $fname, $uuid);
		returnToLoginWithMessage("Your password reset link has been sent to the email address on file.", $clean['network']);	
	} else {
		// TODO - or, say contact customer support?
		returnToLoginWithMessage(Util::AUTHENTICATION_ERROR, $clean['network']);
	}
} else {
	returnToLoginWithMessage("Your password reset link has been sent to the email address on file.", $clean['network']);
}

function returnToLoginWithMessage($message, $network) {
	header("location:" . Util::getHttpPath() . "/login.php?network=" . $network . "&error=" . $message);
	exit(0);
}

function sendResetEmail($email, $path, $fname, $uuid) {
	
	$message = "Hello " . $fname . ",
	
Below is your link to reset your password.

Note: This link will expire in 30 minutes. Also, any password links sent to you previously are now void.

" . Util::getHttpPath() . "/module/login/view/reset.php?resetCode=" . $uuid . "

If you did not request this password reset, please contact our support team at support@northbridgetech.org.

The Support Team at
NorthBridge Technology Alliance";

		mail($email, "[Nexus] Password Reset", $message, "From: noreply@nexus.northbridgetech.org\r\n");		
		
}

?>