<?php
session_start();
require_once('controllers/productsCtrl.php');
include("controllers/appCtrl.php");
$productController = new ProductController();

$redirectURL = '/app/produits/';
$postData = $_POST;

if (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'new-product') {

	if (!isComptable()) {
		$val = $productController->save($postData);
		// $sessData['postData'] = $postData;
		$sessData['status']['type'] = $val['status'];
		$sessData['status']['msg'] = $val['message'];
		$_SESSION['sessData'] = $sessData;
		$redirectURL .= 'nouveau';
	} else {
		$redirectURL = "/app/not-allowed";
	}
}
// If Edit request is submitted
elseif (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'edit' && !empty($_POST['id'])) {
	if (!isComptable()) {
		$val = $productController->updateP($postData);
		$sessData['status']['type'] = $val['status'];
		$sessData['status']['msg'] = $val['message'];
		$_SESSION['sessData'] = $sessData;
		$redirectURL .= 'editer?id=' . $_POST['id'];
	} else {
		$redirectURL = "/app/not-allowed";
	}
}


header("Location: $redirectURL");
exit;
