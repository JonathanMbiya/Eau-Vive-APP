<?php
session_start();
require_once('controllers/productsCtrl.php');
$productController = new ProductController();

$redirectURL = '/app/produits/';
$postData = $_POST;

if (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'new-product') {

	$val = $productController->save($postData);
	// $sessData['postData'] = $postData;
	$sessData['status']['type'] = $val['status'];
	$sessData['status']['msg'] = $val['message'];
	$_SESSION['sessData'] = $sessData;
	$redirectURL .= 'nouveau';
}
// If Edit request is submitted
elseif (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'edit' && !empty($_POST['id'])) {
	$val = $productController->updateP($postData);
	$sessData['status']['type'] = $val['status'];
	$sessData['status']['msg'] = $val['message'];
	$_SESSION['sessData'] = $sessData;
	$redirectURL .= 'editer?id='.$_POST['id'];
}


header("Location: $redirectURL");
exit;
