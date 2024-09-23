<?php
session_start();
require_once('controllers/mvmStockController.php');
$mvmStock = new MouvementStockController();

$redirectURL = '/app/mouvement-stock/';
$postData = $_POST;

if (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'new-mvm') {
	$val = $mvmStock->save($postData);
	$sessData['status']['type'] = $val['status'];
	$sessData['status']['msg'] = $val['message'];
	$_SESSION['sessData'] = $sessData;
	$redirectURL .= 'nouveau';
}
// If Edit request is submitted
elseif (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'edit' && !empty($_POST['id'])) {
	
}


header("Location: $redirectURL");
exit;
