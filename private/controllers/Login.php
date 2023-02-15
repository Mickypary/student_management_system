<?php

/**
 * Login Controller
 */
class Login extends Controller
{

	public function index($value='')
	{
		$errors = array();

		if (count($_POST) > 0) {
			
			$user = new User();
			if ($row = $user->where('email',$_POST['email'])) {
				// code...

				$row = $row[0];
				if (password_verify($_POST['password'], $row->password)) {
					// code...
					Auth::authenticate($row);
					$this->redirect('/home');			
				}
		
			}

				$errors['email'] = "Wrong email or password";
		}

		$this->view('login', [
			'errors' => $errors
		]);
	}
}