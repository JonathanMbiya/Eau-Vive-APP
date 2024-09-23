<?php
require_once("model/facture.php");

class FactureController extends Facture
{
	public function save($post)
	{
		$statusMsg = '';
		$status = '';
		$insertId = 0;

		if (empty($post['dateFacture'])) {
			$status = "danger";
			$statusMsg = "Veuillez selectionner une date de facturation";
		} else {
			$dateFacture = !empty($post['dateFacture']) ? $post['dateFacture'] : '';
			$totalInvoice = !empty($post["totalInvoice"]) ? $post['totalInvoice'] : '0';

			$valErr = '';
			if (empty($dateFacture)) {
				$valErr .= 'La date de facture est obligatoire';
			}
			if (!isset($post['productId']) && count($post['productId']) < 1) {
				$valErr .= "La facture ne doit pas etre vide";
			}


			if (empty($valErr)) {
				$productData = array(
					"dateFacture" => $dateFacture,
					"montantTotal" => $totalInvoice
				);
				$insertId = $this->InsertFacture($productData);

				if (!empty($insertId)) {
					$status = 'success';
					$statusMsg = 'Facture enregisrée avec succès! ';
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
			'message' => $statusMsg,
			'insertId' => $insertId
		];
	}

	public function saveRow($post)
	{
		$product = $this->GetProduct($post['idProduit']);
		if (!empty($product)) {
			$newQte = $product['quantite'] - $post["quantite"];
			if ($newQte >= 0) {
				$this->update(
					'produits',
					[
						"quantite" => $newQte
					],
					[
						'id' => $post['idProduit']
					]
				);
				$this->InsertFactureRow($post);
			}
		}
	}
}
