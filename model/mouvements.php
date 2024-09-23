<?php
require_once("model/produits.php");

class MouvementStock extends Product
{
	private $tableName = "mouvementstock";
	public function InsertMouvement($postProduct)
	{
		return $this->insert($this->tableName, $postProduct);
	}

	public function GetMouvements()
	{
		return $this->getDatas($this->tableName);
	}

	public function GetMouvementsByType($type="entree")
	{
		return $this->getDatas($this->tableName, [
			'where' => [
				"typeMouvement" => $type
			],
		]);
	}
}
