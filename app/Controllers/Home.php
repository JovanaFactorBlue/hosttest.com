<?php namespace App\Controllers;

use App\Libraries\IonAuth;
use App\Model\UserModel;


class Home extends BaseController
{
	public function index()
	{
		return view('welcome');
	}

	//--------------------------------------------------------------------

}
