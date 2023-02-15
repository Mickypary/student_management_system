<?php


/**
 * 
 */
class Auth
{
	
	public static function authenticate($row)
	{
		// code...
		$_SESSION['USER'] = $row;
	}

	public static function logout()
	{
		// code...
		if (isset($_SESSION['USER'])) {
			// code...
			unset($_SESSION['USER']);

		}
	}

	public static function logged_in()
	{
		// code...
		if (isset($_SESSION['USER'])) {
			// code...
			return true;

		}else {
			return false;
		}
	}

	// public static function user()
	// {
	// 	// code...
	// 	if (isset($_SESSION['USER'])) {
	// 		// code...
	// 		return $_SESSION['USER']->firstname;

	// 	}else {
	// 		return false;
	// 	}
	// }

	public static function __callStatic($method, $param)
	{
		// code...
		$prop = strtolower(str_replace("get", "", $method));
		if (isset($_SESSION['USER']->$prop)) {
			// code...
			return $_SESSION['USER']->$prop;

		}else {
			return 'Unknown';
		}
	}
}