<?php namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Libraries\IonAuth;
use App\Models\IonAuthModel;
use App\Models\BoothModel;
use App\Models\FairModel;
use App\Models\UserModel;
use App\Models\CompanyModel;

class Owner extends BaseController
{
    public function __construct()
	{
        $this->ionAuth = new IonAuth();
        $this->userId = $this->ionAuth->getUserId(); 
        
        $this->test = new UserModel();
        $this->data = $this->test->getUserData($this->userId);

        $this->session = \Config\Services::session();
        
    }
    
    public function groupCheck()
    {
        # multiple groups (by id)
        $group = array(1, 2, 4);
        return $this->ionAuth->inGroup($group);
    }

    public function index()
    {
        $uId = $this->userId;
        $db = db_connect();
        $comp = $db->query("SELECT * FROM `users_companies`
                              WHERE `users_companies`.`user_id` = '$uId'");
        $compId = $comp->getRowArray();

        $data = [
            'userData' => $this->data,
            'compId' => $compId
        ];
        if($this->groupCheck() == true){
            return view('client/index', $data);
        }else{
            return redirect()->to('/');
        }
        
    }

    public function fairsView()
    {
        $ids = $this->clientsFairsIDs();
        $data = array();
        $f = new FairModel;
        foreach($ids as $fID){
            array_push($data, $f->find($fID));
        }
        
        return view('client/fairs', $data);
    }

    public function getClientCompanyId()
    {   
        $db = db_connect();
        $usersCompanies = $db->query('SELECT * FROM `users_companies` WHERE `user_id` = '.$this->userId);
        $uc = $usersCompanies->getResult('array');
		foreach($uc as $key => $value){
			return $value['company_id'];
		}
    }

    public function clientsFairsIDs()
    {
        
        $db = db_connect();
        $fairIds = array();
        $compId = intval($this->getClientCompanyId());
        $fairsId = $db->query("SELECT `fairs`.`fair_id` FROM `fairs` 
                               LEFT JOIN `booths` ON `fairs`.`fair_id` = `booths`.`fair_id` 
                               WHERE `booths`.`company_id` = '$compId'");
        $result = $fairsId->getResult('array');

        foreach($result as $key => $value){
            array_push($fairIds, $value['fair_id']);
        }
        $unique = array_unique($fairIds);
        return $unique;

    }

    public function clientsBoothsOnSingleFair($fairId)
    {
        $db = db_connect();

        $compId = intval($this->getClientCompanyId());
        $ownBooths = $db->query("SELECT * FROM `booths` 
                               LEFT JOIN `fairs` ON `booths`.`fair_id` = `fairs`.`fair_id` 
                               WHERE `booths`.`company_id` = '$compId' 
                               AND `fairs`.`fair_id` = '$fairId'");
        $data = $ownBooths->getResult('array');

        return $data;

    }

    public function clientsBoothById($booth_id)
    {
        $b = new BoothModel();
        $data = $b->find($booth_id);
        
        return view('client/booth', $data);
    }

    public function clientsBooths()
    {
        $fairs = array();
        $db = db_connect();
        $f = new FairModel();
        $b = new BoothModel();
        $c = new CompanyModel();
        $compId = intval($this->getClientCompanyId());

        $usersGroups = $db->query("SELECT * FROM `booths` LEFT JOIN `fairs` ON `booths`.`fair_id` = `fairs`.`fair_id` WHERE `booths`.`company_id` = '$compId'");
        return $boof = $usersGroups->getResult('array');

        // return $fairs; 
    }

}

