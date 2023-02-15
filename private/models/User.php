<?php

/**
 * User Model
 */
class User extends Model
{

	protected $allowedColumns = [
		'firstname',
		'lastname',
		'email',
		'password',
		'rank',
		'gender',
		'date',
	];

	protected $beforeInsert = [
		'make_user_id',
		'make_school_id',
		'hash_password',
	];
	
	public function validate($DATA)
	{
		$this->errors = array();

		// allow only letters in first name
		if (empty($DATA['firstname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['firstname'])) {
			$this->errors['firstname'] = "Only letters allowed in first name";
		}

		// allow only letters in last name
		if (empty($DATA['lastname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['lastname'])) {
			$this->errors['lastname'] = "Only letters allowed in last name";
		}

		// check for valid email
		if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['email'] = "Email is not valid";
		}

		// check if email exist
		if ($this->where('email', $_POST['email'])) {
			$this->errors['email'] = "That Email is already in use";
		}

		// check for gender
		$gender = ['female','male'];
		if (empty($DATA['gender']) || !in_array($DATA['gender'], $gender)) {
			$this->errors['gender'] = "Gender not selected";
		}

		// check for rank
		$ranks = ['student','reception','lecturer','admin','super_admin'];
		if (empty($DATA['rank']) || !in_array($DATA['rank'], $ranks)) {
			$this->errors['rank'] = "Rank not selected";
		}

		// check for password match
		if (empty($DATA['password']) || $DATA['password'] != $DATA['password2']) {
			$this->errors['password'] = "The password do not match";
		}

		// check for password length
		if (strlen($DATA['password']) < 8 ) {
			$this->errors['password'] = "Password must be atleast 8 characters long";
		}

		if (count($this->errors) == 0) {
			// code...
			return true;
		}
		return false;
	}

	public function make_user_id($data)
	{
		// code...
		$data['user_id'] = $this->random_string(60);
		return $data;
	}

	public function make_school_id($data)
	{
		// code...
		if (isset($_SESSION['USER']->school_id)) {
			// code...
			$data['school_id'] = $_SESSION['USER']->school_id;
		}
		
		return $data;
	}

	public function hash_password($data)
	{
		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		return $data;
	}

	private function random_string($length)
	{
		$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
		$text = "";

		for ($i=0; $i < $length; $i++) { 
			// code...
			$random = rand(0,61);
			$text .= $array[$random];
		}

		return $text;
	}
}