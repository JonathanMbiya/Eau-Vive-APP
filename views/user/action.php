<?php
session_start();
require_once('controllers/usersCtrl.php');
$userCtrl = new userController();

$redirectURL = '/app';
$postData = $_POST;

// If Edit request is submitted
if (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'login-user') {
	$val = $userCtrl->loginUser($postData);
	$sessData['status']['type'] = $val['status'];
	$sessData['status']['msg'] = $val['message'];
	$_SESSION['sessData'] = $sessData;
	if ($val["status"] == "success") {
		$redirectURL = '/app';
		$_SESSION['userInfo'] = $val["userInfo"];
		$_SESSION['isLogin'] = "true";
		echo 'OOps';
	} else {
		$redirectURL = '/login';
		$_SESSION['isLogin'] = "false";
		echo $val['message'];
	}
} else if (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'logout') {
	if (session_destroy())
		$redirectURL = '/login';
}

echo $redirectURL;


header("Location: $redirectURL");
exit;
