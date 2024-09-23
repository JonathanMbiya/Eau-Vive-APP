<?php
session_start();
require_once('controllers/rapportController.php');
include("controllers/appCtrl.php");
$productController = new RapportController();

$redirectURL = '/app/rapport/';
$postData = $_POST;

if (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'new-rapport') {
	if (isAdmin() || isComptable()) {
		$val = $productController->save($postData);
		$sessData['status']['type'] = $val['status'];
		$sessData['status']['msg'] = $val['message'];
		$_SESSION['sessData'] = $sessData;
		$redirectURL .= $val["status"] == "danger" ? "nouveau?startDate=" . $postData["du"] . "&endDate=" . $postData["au"] : 'nouveau';
	} else {
		$redirectURL = "/app/not-allowed";
	}
}



header("Location: $redirectURL");
exit;
