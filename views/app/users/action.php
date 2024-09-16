<?php
session_start();
require_once('controllers/usersCtrl.php');
$userCtrl = new userController();

$redirectURL = '/app/users/';
$postData = $_POST;

if (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'new-user') {
	$val = $userCtrl->save($postData);
	$sessData['status']['type'] = $val['status'];
	$sessData['status']['msg'] = $val['message'];
	$_SESSION['sessData'] = $sessData;
	$redirectURL .= 'nouveau';
}
// If Edit request is submitted
elseif (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'edit' && !empty($_POST['id'])) {
	$val = $userCtrl->updateP($postData);
	$sessData['status']['type'] = $val['status'];
	$sessData['status']['msg'] = $val['message'];
	$_SESSION['sessData'] = $sessData;
	$redirectURL .= 'editer?id=' . $_POST['id'];
} elseif (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'delete' && !empty($_POST['id'])) {
	$idUser = $_POST['id'];
	$val = $userCtrl->deleteU($idUser);
	$sessData['status']['type'] = $val['status'];
	$sessData['status']['msg'] = $val['message'];
	$_SESSION['sessData'] = $sessData;
}


header("Location: $redirectURL");
exit;
