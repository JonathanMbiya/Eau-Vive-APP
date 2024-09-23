<?php
require_once("model/produits.php");

class Inventaire extends Product
{

	private $tableName = "inventaires";
	private $tableDetailName = "detail_inventaires";
	public function InsertInventaire($postProduct)
	{
		$DATABASE_HOST = 'localhost';
		$DATABASE_USER = 'root';
		$DATABASE_PASS = '';
		$DATABASE_NAME = 'db-stock';

		$createAt = date("Y-m-d H:i:s");
		$updateAt = date("Y-m-d H:i:s");

		$sql = "INSERT INTO
			" . $this->tableName . "
			(idUser, dateInventaire, createAt, updateAt) VALUES
			 ('" . $postProduct['idUser'] . "',
			  '" . $postProduct['dateInventaire'] . "','" . $createAt . "','" . $updateAt . "')";

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

	function InsertInventaireRow($data)
	{
		$product = $this->GetProduct($data['idProduit']);
		if (!empty($product)) {
			$this->insert($this->tableDetailName, $data, false);
		}
	}

	public function GetInventaire($id)
	{
		$sql = "
			SELECT
				u.userName,
				u.role AS userRole,
				u.email AS userEmail,
				i.dateInventaire,
				i.id
			FROM
				" . $this->tableName . " i
			JOIN
				users u ON i.idUser = u.id
			WHERE
				i.id = '" . $id . "'
		";
		return $this->getDataWithSql($sql, "single");
	}

	public function GetInventaireRows($id)
	{
		$sql = "
			SELECT
					p.nomProduit AS productName,
					df.quantite AS quantity,
					df.prix AS price,
					(df.quantite * df.prix) AS total,
					df.id
				FROM
					detail_inventaires df
				JOIN
					produits p ON df.idProduit = p.id
				JOIN
					inventaires f ON df.idInventaire = f.id
				WHERE
					df.id = '" . $id . "'
			";
		return $this->getDataWithSql($sql);
	}

	public function GetInventaires()
	{
		$sql = "
			SELECT
				u.userName,
				u.role AS userRole,
				u.email AS userEmail,
				i.dateInventaire, i.id
			FROM
				inventaires i
			JOIN
				users u ON i.idUser = u.id
		";
		return $this->getDataWithSql($sql);
	}
}
