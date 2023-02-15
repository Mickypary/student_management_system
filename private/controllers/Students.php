<?php

/**
 * Students Controller
 */
class Students extends Controller
{

	public function index($value='')
	{
		session_start();
		// echo "This is the home controller";
		$_SESSION['email'] = 'mikipary@gmail.com';
		$_SESSION['array'] = ['Orange','Apple'];
		return $this->view('student');
	}
}