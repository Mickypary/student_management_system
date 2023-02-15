<?php

/**
 * Profile Controller
 */
class Profile extends Controller
{

	public function index($value='')
	{

		return $this->view('profile');
	}
}