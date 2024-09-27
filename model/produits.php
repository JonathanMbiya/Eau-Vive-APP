<?php
require_once("model/global.php");

class Product extends AppGlobalModel
{
	private $tableName = "produits";
	public function InsertProduct($postProduct)
	{
		return $this->insert($this->tableName, $postProduct);
	}

	public function UpdateProduct($postProduct, $conditions)
	{
		return $this->update($this->tableName, $postProduct, $conditions);
	}

	public function DeleteProduct($id)
	{
		return $this->update($this->tableName, [
			'status' => 'off'
		], [
			"where" => [
				"id" => $id
			]
		]);
	}

	public function GetProducts()
	{
		return $this->getDatas($this->tableName, [
			'where' => [
				"status" => "active"
			],
		]);
	}

	public function productExist($name, $column = "nomProduit")
	{
		return $this->valExist($this->tableName, [
			$column => $name
		], 'id,categorie');
	}


	public function GetProduct($id)
	{
		return $this->getDatas($this->tableName, [
			'select' => 'id,nomProduit,categorie, quantite, prixUnitaire, prixAchat, datePeremption, sensibiliteChaleur, estCouteux, status, createAt, updateAt',
			'where' => [
				'id' => $id,
				"status" => "active"
			],
			'return_type' => 'single'
		]);
	}

	public function GetProductsByCategory($category)
	{
		return $this->getDatas($this->tableName, [
			'select' => 'id,nomProduit,categorie, quantite, prixUnitaire, prixAchat datePeremption, sensibiliteChaleur, estCouteux, status, createAt, updateAt',
			'where' => [
				'categorie' => $category,
				"status" => "active"
			],
		]);
	}

	public function productIsExpired($idProduits)
	{
		$sql = "SELECT * FROM " . $this->tableName . " WHERE `id` = " . $idProduits . " AND `datePeremption` < CURDATE() AND `status` = 'active'";
		$data = $this->getDataWithSql($sql, "single");
		return !empty($data);
	}
	public function getExpiredProducts()
	{
		$sql = "SELECT * FROM " . $this->tableName . " WHERE `datePeremption` < CURDATE() AND `status` = 'active'";
		return $this->getDataWithSql($sql, "all");
	}

	public function getCountExpiredProduct()
	{
		$sql = "SELECT * FROM " . $this->tableName . " WHERE `datePeremption` < CURDATE() AND `status` = 'active'";
		return $this->getDataWithSql($sql, "count");
	}


	public function GetWillExpireIn1Week()
	{
		$sql = "SELECT * FROM " . $this->tableName . " WHERE datePeremption BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)  AND `status` = 'active'";
		return $this->getDataWithSql($sql, "count");
	}

	public function GetProductsCount()
	{
		return $this->getDatas($this->tableName, [
			'where' => [
				"status" => "active"
			],
			"return_type" => "count"
		]);
	}

	public function GetQuantityIs0()
	{
		return $this->getDatas($this->tableName, [
			'where' => [
				"quantite"=>0,
				"status" => "active"
			],
			"return_type" => "count"
		]);
	}
}
