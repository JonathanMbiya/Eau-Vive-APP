<?php
require_once("model/mouvements.php");

class MouvementStockController extends MouvementStock
{
	public function save($post)
	{
		//idProduit
		$statusMsg = '';
		$status = '';

		if (empty($post['idProduit'])) {
			$status = "danger";
			$statusMsg = "Veuillez selectionner un produit";
		} else {
			$product = $this->GetProduct($post['idProduit']);
			if (empty($product)) {
				$statusMsg = "Veuillez fournir un produit valide";
				$status = 'danger';
			} else {
				$idProduit = !empty($post['idProduit']) ? trim($post['idProduit']) : '0';
				$typeMouvement = !empty($post['typeMouvement']) ? trim($post['typeMouvement']) : '';
				$qte = !empty($post['quantite']) ? $post['quantite'] : 0;
				$dateMvment = !empty($post['dateMouvement']) ? $post['dateMouvement'] : '';
				$raison = !empty($post['raison']) ? $post['raison'] : '';
				$price = !empty($post['raison']) ? $post['prix'] : '';

				$valErr = '';

				// Validate form fields
				if (empty($idProduit)) {
					$valErr .= 'Vous devez selectionner un produit.<br/>';
				}
				if (empty($typeMouvement)) {
					$valErr .= 'Vous devez definir le type de mouvement de stock. <br/>';
				}
				if (empty($dateMvment)) {
					$valErr .= 'La date de mouvement est obligatoire';
				}
				if ($qte <= 0) {
					$valErr .= "La quantite doit etre superieur a 0";
				}
				if ($typeMouvement == "sortie" && ($product['quantite'] - $qte < 0)) {
					$valErr .= "La quantite en stock est insufisante";
				}

				$newQte = $product['quantite'];
				if ($typeMouvement == "sortie") {
					$newQte = $newQte - $qte;
				} else {
					$newQte = $newQte + $qte;
				}

				if (empty($valErr)) {
					$productData = array(
						"idProduit" => $idProduit,
						"typeMouvement" => $typeMouvement,
						"dateMouvement" => $dateMvment,
						"quantite" => $qte,
						"prix" => $price,
						"raison" => $raison
					);
					$insert = $this->InsertMouvement($productData);
					$this->update('produits', [
						"quantite" => $newQte
					], [
						'id' => $idProduit
					]);
					if ($insert) {
						$status = 'success';
						$statusMsg = 'Mouvement de stock ajouté avec succès!';
					} else {
						$statusMsg = 'Un probleme est survenu, veuillez réessayer plutard.';
						$status = 'danger';
					}
				} else {
					$status = 'danger';
					$statusMsg = '<p>Veuillez remplir tous les champs obligatoires:</p>' . trim($valErr, '<br/>');
				}
			}
		}
		return [
			'status' => $status,
			'message' => $statusMsg
		];
	}
}
