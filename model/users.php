<?php
require_once("model/global.php");

class User extends AppGlobalModel
{
	private $tableName = "users";
	public function InsertUser($postProduct)
	{
		return $this->insert($this->tableName, $postProduct);
	}

	public function UpdateUser($postProduct, $conditions)
	{
		return $this->update($this->tableName, $postProduct, $conditions);
	}

	public function DeleteUser($id)
	{
		return $this->update($this->tableName, [
			'status' => 'off'
		], [
			"where" => [
				"id" => $id
			]
		]);
	}

	public function GetUsers()
	{
		return $this->getDatas($this->tableName, [
			'where' => [
				"status" => "active"
			],
		]);
	}

	public function userKeyValExist($key, $val)
	{
		return !empty($this->valExist($this->tableName, [
			$key => $val
		], 'id, role'));
	}

	public function GetUser($id)
	{
		return $this->getDatas($this->tableName, [
			'select' => 'id,email',
			'where' => [
				'id' => $id,
				"status" => "active"
			],
			'return_type' => 'single'
		]);
	}

	public function GetUserLogin($email)
	{
		$sql = "SELECT * FROM " . $this->tableName . " WHERE `email` = '" . $email . "' OR `userName` = '" . $email . "'";
		return $this->getDataWithSql($sql, "single");
	}
}
