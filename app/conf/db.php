<?php

class Db {

	protected $db;

	public function __construct() {
		// я включил исключения для PDO, теперь ошибки будут выводится
		$this->db = new PDO('mysql:host='. DB_HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}

	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);//типа подготовка запроса
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				if (is_int($val)) {
					$type = PDO::PARAM_INT;
				} else {
					$type = PDO::PARAM_STR;
				}
				$stmt->bindValue(':'.$key, $val, $type);//связываем параметры и запрос
			}
		}
		$stmt->execute();//делаем запрос
		return $stmt;
	}

	public function row($sql, $params = []) {
		$result = $this->query($sql, $params);
			return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function column($sql, $params = []) {
		$result = $this->query($sql, $params);
			return $result->fetchColumn();
	}

	public function lastInsertId() {
		return $this->db->lastInsertId();
	}

	public function beginTransaction():void {
		$this->db->beginTransaction();
	}

	public function commit():void {
		 $this->db->commit();
	}

	public function rollback():void {
		$this->db->rollback();
	}

	//функция для доавление записи
	public function constructorQueryInsert($tableName, $params):string{
		$query = "INSERT INTO `$tableName` (";
			foreach($params as $key=>$value)
				$query.="`$key`,";
			$query = rtrim($query, ",");
			$query.=') VALUES (';
			foreach ($params as $key=>$value)
				$query.=":$key, ";
			$query = trim($query);	
			$query = rtrim($query, ",");
			$query .= ')';
				return $query;		
	}

} 
?>