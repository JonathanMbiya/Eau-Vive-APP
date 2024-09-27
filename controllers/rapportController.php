<?php
require_once("model/rapport.php");

class RapportController extends Rapport
{
	public function save($post)
	{
		$statusMsg = '';
		$status = '';

		if (empty($post['dateRapport'])) {
			$status = "danger";
			$statusMsg = "Veuillez selectionner une date de rapport";
		} else {
			$dateRapport = !empty($post['dateRapport']) ? $post['dateRapport'] : '';
			$startDate = !empty($post["du"]) ? trim($post['du']) : '';
			$endDate = !empty($post["au"]) ? trim($post['au']) : '';
			 // Appel à getInventory pour récupérer les montants
			 $inventoryData = $this->getInventory($startDate, $endDate);
			 $amountAchat = $inventoryData['totalAmountIn'] ?? 0;  // Montant d'achat
			 $amountVente = $inventoryData['totalAmountOut'] ?? 0;    // Montant de vente
			$valErr = '';
			if (empty($dateRapport)) {
				$valErr .= "La date du rapport est obligatoire";
			}

			if (empty($startDate) || empty($endDate)) {
				$valErr .= "Vous devez indiquer une periode pour le rapport";
			}


			if (empty($valErr)) {
				$productData = [
					"dateRapport" => $dateRapport,
					"du" => $startDate,
					"au" => $endDate,
					"montantVente" => $amountVente,
					"montantAchat" => $amountAchat
				];
				if ($this->rapportExist($startDate, $endDate)) {
					$status = 'danger';
					$statusMsg = "Un autre rapport existe deja pour la periode du " . $startDate . " au " . $endDate . "";
				} else {
					$rapportSave = $this->InsertRapport($productData);

					if ($rapportSave) {
						$status = 'success';
						$statusMsg = 'Inventaire enregisré avec succès! ';
					} else {
						$statusMsg = 'Un probleme est survenu, veuillez réessayer plutard.';
						$status = 'danger';
					}
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

	public function rapportExist($startDate, $endDate)
	{
		return !empty($this->GetRapportWithDate($startDate, $endDate));
	}
}
