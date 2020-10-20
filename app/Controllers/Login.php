<?php namespace App\Controllers;

use App\Libraries\IonAuth;
use App\Model\UserModel;

class Login extends BaseController
{
		public $data = [];

		protected $configIonAuth;

		protected $ionAuth;

		protected $session;

		protected $validation;

		protected $validationListTemplate = 'list';

		protected $helpers = [];

	public function __construct()
	{
		// $this->ionAuth    = new \IonAuth\Libraries\IonAuth();
		$this->validation = \Config\Services::validation();
		helper(['form', 'url']);
		$this->configIonAuth = config('IonAuth');
		$this->session       = \Config\Services::session();

		if (! empty($this->configIonAuth->templates['errors']['list']))
		{
			$this->validationListTemplate = $this->configIonAuth->templates['errors']['list'];
		}


	}

	public function login()
	{

		$this->data['title'] = lang('Auth.login_heading');
		
		// validate form input
		$this->validation->setRule('identity', str_replace(':', '', lang('Auth.login_identity_label')), 'required');
		$this->validation->setRule('password', str_replace(':', '', lang('Auth.login_password_label')), 'required');

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run())
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool)$this->request->getVar('remember');

			if ($this->ionAuth->login($this->request->getVar('identity'), $this->request->getVar('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->setFlashdata('message', $this->ionAuth->messages());
				$u = new UserModel;
				$user_id = $this->ionAuth->getUserId();
				$userData = $u->getUserData($id);
				if($userData['name'] == 'admin'){
					return redirect()->to('/admin');
				}elseif($userData['name'] == 'moderator'){
					return redirect()->to('/admin');
				}elseif($userData['name'] == 'organizer'){
					// return redirect()->to('/');
				}elseif($userData['name'] == 'exibitor'){
					return redirect()->to('/owner');
				}elseif($userData['name'] == 'salesperson'){
					// return redirect()->to('/');
				}elseif($userData['name'] == 'visitors'){
					// return redirect()->to('/');
				}elseif($userData['name'] == 'members'){
					// return redirect()->to('/');
				}

				return redirect()->to('/');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->setFlashdata('message', $this->ionAuth->errors($this->validationListTemplate));
				// use redirects instead of loading views for compatibility with MY_Controller libraries
				return redirect()->back()->withInput();
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : $this->session->getFlashdata('message');

			$this->data['identity'] = [
				'name'  => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => set_value('identity'),
			];

			$this->data['password'] = [
				'name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			];

			return view('auth/login', $this->data);

			//return $this->renderPage($this->viewsFolder . DIRECTORY_SEPARATOR . 'login', $this->data);
		}
	}

	//--------------------------------------------------------------------

}
