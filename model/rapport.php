<?php
require_once("model/global.php");

class Rapport extends AppGlobalModel
{
	private $tableName = "rapport_financiers";
	public function InsertRapport($postData)
	{
		return $this->insert($this->tableName, $postData, false);
	}
	public function GetRapportWithDate($startDate, $endDate)
	{
		return $this->getDatas($this->tableName, [
			"where" => [
				"du" => $startDate,
				"au" => $endDate
			],
			"return_type" => "single"
		]);
	}
	public function GetRapport()
	{
		return $this->getDatas($this->tableName);
	}

	public function getInventory($startDate, $endDate)
	{
		$sql = "
			SELECT
				COALESCE(SUM(CASE WHEN ms.typeMouvement = 'entree' THEN ms.quantite * ms.prix END), 0) AS totalAmountIn,
				COALESCE(SUM(CASE WHEN ms.typeMouvement = 'sortie' THEN ms.quantite * ms.prix END), 0) AS totalAmountOut,
				(
					COALESCE(SUM(CASE WHEN ms.typeMouvement = 'entree' THEN ms.quantite * ms.prix END), 0) -
					COALESCE(SUM(CASE WHEN ms.typeMouvement = 'sortie' THEN ms.quantite * ms.prix END), 0)
				) AS totalGeneral
			FROM mouvementstock ms
			WHERE ms.dateMouvement BETWEEN :startDate AND :endDate
		";

		$query = $this::getConnexion()->prepare($sql);
		$query->bindParam(':startDate', $startDate);
		$query->bindParam(':endDate', $endDate);
		$query->execute();

		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function getAllMouvements($startDate, $endDate)
{
    $sql = "
        SELECT
            ms.dateMouvement,
            ms.typeMouvement,
            ms.quantite,
            ms.prix,
            p.nomProduit
        FROM mouvementstock ms
        JOIN produits p ON ms.idProduit = p.id
        WHERE ms.dateMouvement BETWEEN :startDate AND :endDate
        ORDER BY ms.dateMouvement DESC
    ";
    $query = $this::getConnexion()->prepare($sql);
    $query->bindParam(':startDate', $startDate);
    $query->bindParam(':endDate', $endDate);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

}
