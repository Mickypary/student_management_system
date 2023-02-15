<?php

/**
 * Main Model
 */
class Model extends Database
{
	public $errors = array();

	public function __construct()
	{
		// echo $this::class;
		if (!property_exists($this, 'table')) {
			return $this->table = strtolower($this::class . "s");

		}
	}

	public function where($column, $value)
	{
		$column = addslashes($column);
		$query = "select * from $this->table where $column = :value";

		return $this->query($query,[
			'value' => $value
		]);
	} // End where Method

	public function findAll()
	{
		$query = "select * from $this->table";

		return $this->query($query);
	} // End findAll Method

	public function insert($data)
	{
		// Remove unwanted columns
		if (property_exists($this, 'allowedColumns')) {
			foreach ($data as $key => $value) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}

		}

		// Run functions before insert
		if (property_exists($this, 'beforeInsert')) {
			foreach ($this->beforeInsert as $func) {
				// code...
				$data = $this->$func($data);
			}

		}
		// print_r($data);
		// die();

		$keys = array_keys($data);
		$columns = implode(',', $keys);
		$values = implode(',:', $keys);
		$query = "INSERT INTO $this->table ($columns) VALUES (:$values)";

		return $this->query($query, $data);
	} // End insert Method

	public function update($id, $data)
	{
		$str = "";

		foreach ($data as $key => $value) {
			$str .= $key . "=:" . $key . ',';
		}

		$str = trim($str, ",");
		$data['id'] = $id;

		$query = "UPDATE $this->table SET $str WHERE id = :id";
		// echo $query;

		return $this->query($query, $data);
	} // End update Method

	public function delete($id)
	{
		$query = "DELETE FROM $this->table WHERE id = :id";
		$data['id'] = $id;

		return $this->query($query, $data);
	} // End delete Method


}