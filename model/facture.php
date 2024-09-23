<?php
require_once("model/produits.php");

class Facture extends Product
{

	private $tableName = "factures";
	private $tableDetailName = "detailfactures";
	public function InsertFacture($postProduct)
	{
		$createAt = date("Y-m-d H:i:s");
		$updateAt = date("Y-m-d H:i:s");
		$sql = "INSERT INTO " . $this->tableName . "(dateFacture,montantTotal,createAt,updateAt) VALUES ('" . $postProduct['dateFacture'] . "', '" . $postProduct['montantTotal'] . "','" . $createAt . "','" . $updateAt . "')";
		$DATABASE_HOST = 'localhost';
		$DATABASE_USER = 'root';
		$DATABASE_PASS = '';
		$DATABASE_NAME = 'db-stock';
		$mysqli = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

		$last_id = 0;
		if ($mysqli->connect_error) {
			$last_id = 0;
		}

		if ($mysqli->query($sql) === TRUE) {
			$last_id = $mysqli->insert_id;
		} else {
			$last_id = 0;
		}

		$mysqli->close();
		return $last_id;
	}

	function InsertFactureRow($data)
	{
		return $this->insert($this->tableDetailName, $data, false);
	}

	public function GetFacture($id)
	{
		return $this->getDatas($this->tableName, [
			'select' => 'id, dateFacture, montantTotal, createAt, updateAt',
			'where' => [
				'id' => $id
			],
			'return_type' => 'single'
		]);
	}

	public function GetFactureRows($id)
	{
		$sql = "
 SELECT
        p.nomProduit AS productName,
        df.quantite AS quantity,
        df.prix AS price,
        (df.quantite * df.prix) AS total
    FROM
        detailFactures df
    JOIN
        produits p ON df.idProduit = p.id
    JOIN
        factures f ON df.idFacture = f.id
    WHERE
        f.id = '" . $id . "'
";
		return $this->getDataWithSql($sql);
	}

	public function GetFactures()
	{
		return $this->getDatas($this->tableName);
	}
	public function GetFacturesByDate($date)
	{
		return $this->getDatas($this->tableName, [
			"select" => "id, dateFacture, montantTotal, createAt, updateAt",
			"where" => [
				"dateFacture" => $date
			]
		]);
	}
}
