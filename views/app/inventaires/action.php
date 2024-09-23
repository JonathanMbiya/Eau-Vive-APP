<?php
session_start();
require_once('controllers/inventaireCtrl.php');
$inventaireOp = new InventaireController();

$redirectURL = '/app/inventaires/';
$postData = $_POST;
if (!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'new-inventaire') {
	$userIdSession = $_SESSION["userInfo"]["id"];
	try {
		if (
			isset($_POST['productId'], $_POST['productPrice'], $_POST['quantity']) &&
			is_array($_POST['productId']) && is_array($_POST['productPrice']) && is_array($_POST['quantity'])
		) {
			$val = $inventaireOp->save([
				'idUser' => $userIdSession,
				'dateInventaire' => $postData["dateInventaire"]
			]);
			$id = $val["insertId"];
			if ($id > 0) {
				$productIds = $_POST['productId'];
				$productPrices = $_POST['productPrice'];
				$quantities = $_POST['quantity'];
				try {
					for ($i = 0; $i < count($productIds); $i++) {
						$productId = htmlspecialchars($productIds[$i]);
						$productPrice = htmlspecialchars($productPrices[$i]);
						$quantity = htmlspecialchars($quantities[$i]);
						$inventaireOp->saveRow([
							"idInventaire" => $id,
							"idProduit" => $productId,
							"prix" => $productPrice,
							"quantite" => $quantity
						]);
					}
					$sessData['status']['type'] = $val['status'];
					$sessData['status']['msg'] = $val['message'];
					$_SESSION['sessData'] = $sessData;
				} catch (Exception $er) {
					$sessData['status']['type'] = 'rrror';
					$sessData['status']['msg'] = 'An error occured';
					$_SESSION['sessData'] = $sessData;
				}
			}else{
				echo "<br>C'est la merde ".$id;
			}
		} else {
			$sessData['status']['type'] = 'error';
			$sessData['status']['msg'] = 'La facture doit contenir au moins un item';
			$_SESSION['sessData'] = $sessData;
		}
	} catch (Exception $er) {
		$sessData['status']['type'] = 'error';
		$sessData['status']['msg'] = "Une erreur s'est produite " . $er->getMessage();
		$_SESSION['sessData'] = $sessData;
		echo "<br>C'est la grosse merde";
	}
	$redirectURL .= 'nouveau';
}



header("Location: $redirectURL");
exit;
