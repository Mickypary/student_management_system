<?php

/**
 * Home Controller
 */
class Home extends Controller
{

	public function index($value='')
	{
		if (!Auth::logged_in()) {
			// code...
			$this->redirect('login');
		}
		
		$user = new User();

		$data = $user->findAll();

		return $this->view('home', ['rows' => $data]);
	}

}
