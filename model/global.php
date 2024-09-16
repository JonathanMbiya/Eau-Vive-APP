<?php
require_once("model/db.php");
class AppGlobalModel extends DataBase
{

	public function getRandomString($n)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
		return $randomString;
	}

	public function valExist($tableName, $whereCond, $columns)
	{
		return $this->getDatas($tableName, [
			'select' => $columns,
			'where' => $whereCond,
			'return_type' => 'single'
		]);
	}

	public function insert($table, $data)
	{
		try {
			if (!empty($data) && is_array($data)) {
				$columns = '';
				$values  = '';
				$i = 0;

				if (!array_key_exists('createAt', $data)) {
					$data['createAt'] = date("Y-m-d H:i:s");
				}
				if (!array_key_exists('updateAt', $data)) {
					$data['updateAt'] = date("Y-m-d H:i:s");
				}
				foreach ($data as $key => $val) {
					$pre = ($i > 0) ? ',' : '';
					$columns .= $pre . $key;
					$values  .= $pre . "?";
					$i++;
				}

				$sqlR = "INSERT INTO " . $table . " (" . $columns . ") VALUES (" . $values . ")";
				$req = $this::getConnexion()->prepare($sqlR);
				$saveV = array();
				$count = 0;
				foreach ($data as $key => $val) {
					$saveV[$count++] = $val;
				}
				$insert = $req->execute($saveV);
				return $insert;
			} else {
				echo 'No data';
			}
		} catch (Exception $e) {
			echo $e;
		}
	}
	public function insertAndReturnId($table, $data)
	{

		try {

			if (!empty($data) && is_array($data)) {
				$columns = '';
				$values  = '';
				$i = 0;

				if (!array_key_exists('createAt', $data)) {
					$data['createAt'] = date("Y-m-d H:i:s");
				}
				if (!array_key_exists('updateAt', $data)) {
					$data['updateAt'] = date("Y-m-d H:i:s");
				}
				foreach ($data as $key => $val) {
					$pre = ($i > 0) ? ',' : '';
					$columns .= $pre . $key;
					$values  .= $pre . "?";
					$i++;
				}

				$sqlR = "INSERT INTO " . $table . " (" . $columns . ") VALUES (" . $values . ")";
				$req = $this::getConnexion()->prepare($sqlR);
				$saveV = array();
				$count = 0;
				foreach ($data as $key => $val) {
					$saveV[$count++] = $val;
				}

				$id = '';
				if ($req->execute($saveV)) {
					$id = $this::getConnexion()->lastInsertId();
				}

				return $id;
			} else {
				echo 'No data';
			}
		} catch (Exception $e) {
			echo $e;
		}
	}
	public function insertWithNoDates($table, $data)
	{
		try {
			if (!empty($data) && is_array($data)) {
				$columns = '';
				$values  = '';
				$i = 0;
				foreach ($data as $key => $val) {
					$pre = ($i > 0) ? ',' : '';
					$columns .= $pre . $key;
					$values  .= $pre . "?";
					$i++;
				}

				$sqlR = "INSERT INTO " . $table . " (" . $columns . ") VALUES (" . $values . ")";
				$req = $this::getConnexion()->prepare($sqlR);
				$saveV = array();
				$count = 0;
				foreach ($data as $key => $val) {
					$saveV[$count++] = $val;
				}
				$id = 23333;
				if ($req->execute($saveV)) {
					$id = $this::getConnexion()->lastInsertId();
				}

				return $id;
			} else {
				echo 'No data';
			}
		} catch (Exception $e) {
			echo $e;
		}
	}
	public function update($table, $data, $conditions)
	{
		try {
			if (!empty($data) && is_array($data)) {
				$ColVal  = '';
				$i = 0;
				$saveV = array();
				$count = 0;
				if (!array_key_exists('updateAt', $data)) {
					$data['updateAt'] = date("Y-m-d H:i:s");
				}
				foreach ($data as $key => $val) {
					$pre = ($i > 0) ? ',' : '';
					$ColVal .= $pre . $key . "=?";
					$saveV[$count++] = $val;
					$i++;
				}
				$whereSql = '';
				if (!empty($conditions) && is_array($conditions)) {
					$whereSql .= ' WHERE ';
					$i = 0;
					foreach ($conditions as $key => $value) {
						$pre = ($i > 0) ? ' AND ' : '';
						$whereSql .= $pre . $key . " = ?";
						$saveV[$count++] = $value;
						$i++;
					}
				}
				$sqlR = "UPDATE $table SET $ColVal $whereSql";
				$req = $this::getConnexion()->prepare($sqlR);
				$update = $req->execute($saveV);
				return $update;
			} else {
				echo 'betise';
			}
		} catch (Exception $e) {
			echo $e;
		}
	}

	public function getRows($table)
	{
		try {
			$req = "SELECT * FROM " . $table;
			$stmt = $this::getConnexion()->prepare($req);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		} catch (Exception $ex) {
			echo $ex;
		}
	}

	public function getDatas($table, $conditions = array())
	{
		$sql = 'SELECT ';
		$sql .= array_key_exists("select", $conditions) ? $conditions['select'] : '*';
		$sql .= ' FROM ' . $table;
		if (array_key_exists("where", $conditions)) {
			$sql .= ' WHERE ';
			$i = 0;
			foreach ($conditions['where'] as $key => $value) {
				$pre = ($i > 0) ? ' AND ' : '';
				$sql .= $pre . $key . " = '" . $value . "'";
				$i++;
			}
		}

		if (array_key_exists("order_by", $conditions)) {
			$sql .= ' ORDER BY ' . $conditions['order_by'];
		}

		if (array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
			$sql .= ' LIMIT ' . $conditions['start'] . ',' . $conditions['limit'];
		} elseif (!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
			$sql .= ' LIMIT ' . $conditions['limit'];
		}

		$query = $this::getConnexion()->prepare($sql);
		$query->execute();

		if (array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all') {
			switch ($conditions['return_type']) {
				case 'count':
					$data = $query->rowCount();
					break;
				case 'single':
					$data = $query->fetch(PDO::FETCH_ASSOC);
					break;
				default:
					$data = '';
			}
		} else {
			if ($query->rowCount() > 0) {
				$data = $query->fetchAll();
			}
		}
		return !empty($data) ? $data : false;
	}
	public function getDataWithSql($sql, $returnType = "all")
	{
		$query = $this::getConnexion()->prepare($sql);
		$query->execute();

		if ($returnType != 'all') {
			$data = $query->fetch(PDO::FETCH_ASSOC);
		} else {
			if ($query->rowCount() > 0) {
				$data = $query->fetchAll();
			}
		}
		return !empty($data) ? $data : false;
	}
}
