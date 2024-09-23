<?php
require_once("model/inventaire.php");

class InventaireController extends Inventaire
{
	public function save($post)
	{
		$statusMsg = '';
		$status = '';
		$insertId = 0;

		if (empty($post['dateInventaire'])) {
			$status = "danger";
			$statusMsg = "Veuillez selectionner une date d'inventaire";
		} else {
			$dateInventaire = !empty($post['dateInventaire']) ? $post['dateInventaire'] : '';
			$idUser = !empty($post['idUser']) ? $post['idUser'] : '';

			$valErr = '';
			if (empty($dateInventaire)) {
				$valErr .= "La date de l'inventaire est obligatoire";
			}

			if (empty($idUser)) {
				$valErr .= "Impossible d'effectuer cette action sans session";
			}


			if (empty($valErr)) {
				$productData = [
					"idUser" => $idUser,
					"dateInventaire" => $dateInventaire,
				];
				$insertId = $this->InsertInventaire($productData);

				if (!empty($insertId)) {
					$status = 'success';
					$statusMsg = 'Inventaire enregisré avec succès! ';
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
		$this->InsertInventaireRow($post);
	}
}
