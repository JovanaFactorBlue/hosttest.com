<?php namespace App\Controllers;

use App\Libraries\IonAuth;

class Admin extends BaseController
{
	public function __construct()
	{
		$this->ionAuth    = new IonAuth();
		$this->userId = $this->ionAuth->getUserId(); 

		$this->ionAuth = new IonAuth();
        $this->userId = $this->ionAuth->getUserId(); 
        
        // $this->test = new UserModel();
        // $this->data = $this->test->getUserData($this->userId);

        $this->session = \Config\Services::session();
	}

	public function groupCheck()
    {
        # multiple groups (by id)
        $group = array(1, 2);
        return $this->ionAuth->inGroup($group);
	}
	
	public function index()
	{
		
		if($this->groupCheck() == true){
            return view('admin/superadmin');
        }else{
            return redirect()->to('/');
		}
		
	}

	public function blank()
	{
		if($this->groupCheck() == true){
			return view('admin/blank');
        }else{
            return redirect()->to('/');
		}
	}

	public function forms()
	{
		if($this->groupCheck() == true){
			return view('admin/forms');
        }else{
            return redirect()->to('/');
		}
	}

	//--------------------------------------------------------------------

}
