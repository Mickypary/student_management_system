<?php

/**
 * Signup Controller
 */
class Signup extends Controller
{

	public function index()
	{
		$errors = array();
		if (count($_POST) > 0) {
			
			$user = new User();
			if ($user->validate($_POST)) {
				// code...
				$_POST['date'] = date("Y-m-d H:i:s");

				$user->insert($_POST);

				$this->redirect('login');
			}else {
				// errors
				$errors = $user->errors;
				// print_r($errors);
			}
		}

		 $this->view('signup', [
			'errors' => $errors
		]);
	}
}