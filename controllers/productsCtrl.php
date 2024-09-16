<?php
require_once("model/produits.php");
class ProductController extends Product
{
	public function save($post)
	{
		$productName = $post['nomProduit'];
		$statusMsg = '';
		$status = '';

		if ($this->productExist($productName)) {
			$statusMsg = 'Ce produit existe deja';
			$status = 'danger';
		} else {
			$productName = !empty($post['nomProduit']) ? trim($post['nomProduit']) : '';
			$category = !empty($post['categorie']) ? trim($post['categorie']) : '';
			$qte = !empty($post['quantite']) ? $post['quantite'] : 0;
			$unitPrice = !empty($post['prixUnitaire']) ? $post['prixUnitaire'] : 0;
			$perimptionDate = !empty($post['datePeremption']) ? $post['datePeremption'] : '';
			$sensibility = !empty($post["sensibiliteChaleur"]) ? '1' : '0';
			$isHighPriced = !empty($post["estCouteux"]) ? '1' : '0';

			$valErr = '';

			// Validate form fields
			if (empty($productName)) {
				$valErr .= 'Vous devez saisir le nom du produit.<br/>';
			}
			if (empty($category)) {
				$valErr .= 'Vous devez saisir la categorie du produit. <br/>';
			}
			if (empty($perimptionDate)) {
				$valErr .= 'La date de peremption est obligatoire';
			}

			// if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			// 	$valErr .= 'Saisissez un email valide.<br/>';
			// }



			if (empty($valErr)) {
				$productData = array(
					'nomProduit' => $productName,
					'categorie' => $category,
					'quantite' => $qte,
					'prixUnitaire' => $unitPrice,
					'datePeremption' => $perimptionDate,
					'sensibiliteChaleur' => $sensibility,
					'estCouteux' => $isHighPriced,
					'status' => "active"
				);
				$insert = $this->InsertProduct($productData);
				if ($insert) {
					$status = 'success';
					$statusMsg = 'Produit ajouté avec succès!';
					$postData = '';
				} else {
					$statusMsg = 'Un probleme est survenu, veuillez réessayer plutard.';
					$status = 'danger';
				}
			} else {
				$status = 'danger';
				$statusMsg = '<p>Veuillez remplir tous les champs obligatoires:</p>' . trim($valErr, '<br/>');
			}
		}
		return [
			'status' => $status,
			'message' => $statusMsg
		];
	}

	public function updateP($post)
	{
		$productName = $post['nomProduit'];
		$statusMsg = '';
		$status = '';
		$productId = $post['id'];
		$productInfo = $this->GetProduct($productId);

		if (empty($productId) || !$productInfo) {
			$statusMsg = 'Vous essayez une mauvaise action';
			$status = 'danger';
		} elseif ($productInfo['nomProduit'] != $productName && !empty($this->productExist($productName))) {
			$statusMsg = 'Un autre produit porte deja ce nom';
			$status = 'warning';
		} else {

			$productName = !empty($post['nomProduit']) ? trim($post['nomProduit']) : '';
			$category = !empty($post['categorie']) ? trim($post['categorie']) : '';
			$qte = !empty($post['quantite']) ? $post['quantite'] : 0;
			$unitPrice = !empty($post['prixUnitaire']) ? $post['prixUnitaire'] : 0;
			$perimptionDate = !empty($post['datePeremption']) ? $post['datePeremption'] : '';
			$sensibility = !empty($post["sensibiliteChaleur"]) ? '1' : '0';
			$isHighPriced = !empty($post["estCouteux"]) ? '1' : '0';

			$valErr = '';

			// Validate form fields
			if (empty($productName)) {
				$valErr .= 'Vous devez saisir le nom du produit.<br/>';
			}
			if (empty($category)) {
				$valErr .= 'Vous devez saisir la categorie du produit. <br/>';
			}
			if (empty($perimptionDate)) {
				$valErr .= 'La date de peremption est obligatoire';
			}

			// if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			// 	$valErr .= 'Saisissez un email valide.<br/>';
			// }



			if (empty($valErr)) {
				$productData = array(
					'nomProduit' => $productName,
					'categorie' => $category,
					'quantite' => $qte,
					'prixUnitaire' => $unitPrice,
					'datePeremption' => $perimptionDate,
					'sensibiliteChaleur' => $sensibility,
					'estCouteux' => $isHighPriced,
					'status' => "active"
				);
				$insert = $this->UpdateProduct($productData, [
					'id' => $productId
				]);
				if ($insert) {
					$status = 'success';
					$statusMsg = 'Produit ajouté avec succès!';
					$postData = '';
				} else {
					$statusMsg = 'Un probleme est survenu, veuillez réessayer plutard.';
					$status = 'danger';
				}
			} else {
				$status = 'danger';
				$statusMsg = '<p>Veuillez remplir tous les champs obligatoires:</p>' . trim($valErr, '<br/>');
			}
		}
		return [
			'status' => $status,
			'message' => $statusMsg
		];
	}
}
