<?php

session_start();

if (isset($_REQUEST['message'])) {
	echo $_REQUEST['message'];
} //else if (isset($_REQUEST['docid'])) {
	//echo "docid:" . $_REQUEST['docid'];
//} else {
//	echo "Logged in";
//}

echo "<img src='http://northbridge.websitetoolbox.com/register/logout?authtoken=" . $_SESSION['authtoken'] . "' border='0' width='1' height='1' alt=''>";

?>