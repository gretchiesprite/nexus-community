<?php

session_start();

require_once("../../../src/framework/Util.php");

$dirty = array('username' => $_POST['uid'], 'password' => $_POST['password']);
$clean = array();

if (isset($dirty['username']) && Util::validateUsernameFormat($dirty['username'])) {
	$clean['username'] = $dirty['username'];
}

// TODO - clean password
$isAuthenticated = Util::authenticate($clean['username'], $dirty['password']);

if($isAuthenticated){
	Util::setSession($clean['username']);
	Util::setLogin($_SESSION['uidpk']);
	header("location:" . Util::getHttpPath() . "/index.php");
	exit(0);	
} else {
	returnToLoginWithError(Util::AUTHENTICATION_ERROR);
}

function returnToLoginWithError($errorMessage) {
	header("location:" . Util::getHttpPath() . "/login.php?error=" . $errorMessage);
	exit(0);
}

?>