<?php namespace App\Models;

use CodeIgniter\Model;
use GroceryCrudModel;

class CompanyModel extends Model {

	protected $table = 'company';
	protected $primaryKey = 'company_id';

	protected $allowedFields = [
		'company_name', 
		'company_displayname', 
		'company_location', 
		'company_employees', 
		'company_website', 
		'company_slogan', 
		'company_logo',
		'company_moreinformation',
		'leverancier_nummer'
	];

	protected $socialMedia = [
		'linkedin' => 'text-primary', 
		'facebook' => 'text-primary', 
		'instagram' => 'text-warning', 
		'twitter' => 'text-info', 
		'vimeo' => 'text-success', 
		'youtube' => 'text-danger'
	];

	public function getCompanyFilesPath($id)
    {
		$get = $this->find($id);

        //check if there is already folder for this company
		if(!file_exists('./uploads/companies/'.$get['company_name'].'-'.$get['company_id'])){
			//if not make it and return path
			mkdir('./uploads/companies/'.$get['company_name'].'-'.$get['company_id']);
			return './uploads/companies/'.$get['company_name'].'-'.$get['company_id'];
		}else{
			//if already exists return path
			return './uploads/companies/'.$get['company_name'].'-'.$get['company_id'];
		}
	}

	public function getAllProfiles($companyId)
	{
		$db = db_connect();
		$query = $db->query("SELECT * FROM `company`
							 LEFT JOIN `company_profiles` ON `company`.`company_id` = `company_profiles`.`company_id`
							 WHERE `company`.`company_id` = $companyId");
		return $query->getRowArray();
	}

	public function getSocials($companyId)
	{
		$db = db_connect();
		$query = $db->query("SELECT * FROM `social_media`
							 LEFT JOIN `company` ON `social_media`.`company_id` = `company`.`company_id`
							 WHERE `social_media`.`company_id` = $companyId");
		return $query->getResult();
	}	
	
	public function getContacts($companyId)
	{
		$db = db_connect();
		$query = $db->query("SELECT * FROM `contact_persons`
							 LEFT JOIN `company` ON `contact_persons`.`company_id` = `company`.`company_id`
							 WHERE `contact_persons`.`company_id` = $companyId");
		return $query->getResult();
	}

	public function getLinks($companyId)
	{
		$db = db_connect();
		$query = $db->query("SELECT * FROM `external_links`
							 LEFT JOIN `company` ON `external_links`.`company_id` = `company`.`company_id`
							 WHERE `external_links`.`company_id` = $companyId");
		return $query->getResult();
	}

	public function addLink($data)
	{
		$id = $data['companyId'];
		$link = $data['link'];
		$text = $data['text'];

		$db = db_connect();
		$query = $db->query("INSERT INTO `external_links`
							(`company_id`, `link`, `text`)
							VALUES ('$id', '$link', '$text')");
			if($query){
				return 'inserted';
			}
	}

	public function updateLink($data)
	{
		$id = $data['id'];
		$compId = $data['companyId'];
		$link = $data['link'];
		$text = $data['text'];

		$db = db_connect();
		$query = $db->query("UPDATE `external_links` 
							 SET `company_id` = '$compId', `link` = '$link', `text` = '$text'
							 WHERE `id` = '$id'");
			if($query){
				return 'inserted';
			}
	}

	public function deleteLink($id)
	{
		$db = db_connect();
		$query = $db->query("DELETE FROM `external_links`
							 WHERE `id` = '$id'");
			if($query){
				return 'deleted';
			}
	}

	public function addContact($data)
	{
		$id = $data['compId'];
		$name = $data['name'];
		$email = $data['email'];
		$telephone = $data['telephone'];
		$address = $data['address'];

		$db = db_connect();
		$query = $db->query("INSERT INTO `contact_persons`
							(`name`, `email`, `telephone`, `address`, `company_id`)
							VALUES ('$name', '$email', '$telephone', '$address', '$id')");
			if($query){
				return 'inserted';
			}

	}

	public function updateContact($data)
	{
		$id = $data['id'];
		$compId = $data['companyId'];
		$name = $data['name'];
		$email = $data['email'];
		$telephone = $data['telephone'];
		$address = $data['address'];

		$db = db_connect();
		$query = $db->query("UPDATE `contact_persons` 
							SET `name` = '$name', `email` = '$email', `telephone` = '$telephone', `address` = '$address', `company_id` = '$compId'
							WHERE `person_id` = '$id'");
			if($query){
				return 'updated';
			}
	}

	public function removeContact($id)
	{
		$db = db_connect();
		$query = $db->query("DELETE FROM `contact_persons`
							 WHERE `person_id` = '$id'");
			if($query){
				return 'deleted';
			}
	}

	public function insertSocialLink($data)
	{
		$id = $data['compId'];
		$link = $data['link'];
		$type = $data['type'];
		

		$db = db_connect();
		$query = $db->query("SELECT * FROM `social_media`
							 WHERE `company_id` = '$id'
							 AND `media_type` = '$type'");
		$result = $query->getResult();

		//update link if there was one
		if(!empty($result)){
			foreach($result as $key => $value){
				if($value->media_type == $type && $value->social_link != $link && $link != ''){
					$query = $db->query("UPDATE `social_media`
										 SET `social_link` = '$link'
										 WHERE `company_id` = '$id'
										 AND `media_type` = '$type'");
					if($query){
						return 'updated';
					}
				}elseif($value->media_type == $type && $value->social_link == $link && $link != ''){
						return 'no change';
				}elseif($value->media_type == $type && $value->social_link != $link && $link == ''){
					$query = $db->query("DELETE FROM `social_media`
										 WHERE `company_id` = '$id'
										 AND `media_type` = '$type'");
					if($query){
						return 'deleted';
					}
				}
			}
		}elseif(empty($result)){
			
			$query = $db->query("INSERT INTO `social_media`
								 (`company_id`, `social_link`, `media_type`)
								 VALUES ('$id', '$link', '$type')");
			if($query){
				return 'inserted';
			}
		}
	}

	public function updateBasicData($data)
	{
		$recievedData = json_decode($data, true);
		$compId = $recievedData['company_id'];

		$data = [
			'company_name' => $recievedData['company_name'],
			'company_displayname' => $recievedData['company_displayname'], 
			'company_location' => $recievedData['company_location'], 
			'company_employees' => $recievedData['company_employees'], 
			'company_website' => $recievedData['company_website'], 
			'company_slogan' => $recievedData['company_slogan'], 
			'company_moreinformation' => $recievedData['company_moreinformation'],
			'leverancier_nummer' => $recievedData['leverancier_nummer']
		];
		
		$this->set($data);
		$this->where('company_id', $compId);
		$this->update();
		if($this->affectedRows() > 0){
			return 'success';
		}
	}

	public function uploadLogo($path, $compId)
	{
		$this->set('company_logo', $path);
		$this->where('company_id', $compId);
		$this->update();
		if($this->affectedRows() > 0){
			return 'success';
		}
	}

	public function deleteLogo($compId)
	{
		$this->set('company_logo', null);
		$this->where('company_id', $compId);
		$this->update();
		if($this->affectedRows() > 0){
			return 'removed';
		}
	}


	  
}