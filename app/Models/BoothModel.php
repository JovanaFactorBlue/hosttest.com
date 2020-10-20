<?php namespace App\Models;


use CodeIgniter\Model;
use GroceryCrudModel;
use App\Models\CompanyModel;


class BoothModel extends Model {

	protected $table = 'booths';
	protected $primaryKey = 'booth_id';

	protected $typeRules = [
		'typeOne' => [
			'id' => 1,
			'dimensions' => '8x8',
			'imagesNum' => 4,
			'videosNum' => 3,
			'filesNum' => 4
		],
		'typeTwo' => [
			'id' => 2,
			'dimensions' => '8x20',
			'imagesNum' => 6,
			'videosNum' => 5,
			'filesNum' => 7
		],
		'typeThree' => [
			'id' => 3,
			'dimensions' => '16x20',
			'imagesNum' => 10,
			'videosNum' => 7,
			'filesNum' => 10
		]
	];

	protected $allowedFields = [
		'booth_id', 
		'fair_id', 
		'pavilion_id', 
		'creditor_id', 
		'company_id', 
		'booth_floor', 
		'booth_color', 
		'booth_type_id', 
		'booth_position',
		'booth_name',
		'booth_banner',
		'booth_back_banner',
		'booth_image_1',
		'booth_image_2',
		'booth_image_3',
		'booth_image_4',
		'booth_video',
		'slug',
		'logo',
		'custom_booth',
		'booth_size',
		'custom_booth_path',
		'booth_number',
		'revechat'
	];
	  
	public function getBoothType($id)
	{
		$t = $this->find($id);
		$type = $t['booth_type_id'];
		foreach($this->typeRules as $key => $value){
			if($value['id'] == $type){
				return $value;
			}
		}
	}

	public function getBoothsByCompanyId($companyId)
	{
		$booths = new BoothModel();
		$b = $booths->asArray()->where('company_id', $companyId)->findAll();
		return $b;
	}

	public function getOneImage($id, $position)
	{
		$db = db_connect();
		$query = $db->query("SELECT * FROM `images` 
							 LEFT JOIN `booths_images` 
							 ON `images`.`image_id` 
							 WHERE `images`.`image_id` = `booths_images`.`image_id`
							 AND `booths_images`.`position` = '$position'
							 AND `booths_images`.`booth_id` = '$id'");
		$result = $query->getRowArray();
		return $result;
	}

	public function getCompanyId($booth_id)
	{
		$b = $this->find($booth_id);
		return $b['company_id'];
	}

	public function getBoothImagesPath($id) //latest
    {
		$db = db_connect();
		$query = $db->query("SELECT * FROM `images` 
							 LEFT JOIN `booths_images` 
							 ON `images`.`image_id` 
							 WHERE `images`.`image_id` = `booths_images`.`image_id`
							 AND `booths_images`.`booth_id` = '$id'");
		$result = $query->getResultArray();
		return $result;
		
	}

	public function getBoothVideosPath($id) //latest
    {
		$db = db_connect();
		$query = $db->query("SELECT * FROM `videos` 
							 LEFT JOIN `booths_videos` 
							 ON `videos`.`video_id` 
							 WHERE `videos`.`video_id` = `booths_videos`.`video_id`
							 AND `booths_videos`.`booth_id` = '$id'");
		$result = $query->getResultArray();
		return $result;
		
	}

	public function getAvlVideoPositions($id) //latest
	{
		//occupied places
		$v = $this->getBoothVideosPath($id);
		if(!empty($v)){
			$occupiedPos = array();
			$avlPos = array();
			foreach($v as $key => $value){
				array_push($occupiedPos, $value['position']);
			}
			//num of places
			$b = $this->getBoothType($id);
			$num = $b['videosNum'];
			//get avl places
			for($i = 1;$i <= $num;$i++){
				if(!in_array($i, $occupiedPos)){
					array_push($avlPos, $i);
				}
			}
	
			return $avlPos;
		}else{
			return;
		}


	}

	public function checkTypeForImages($id)
	{
		$db = db_connect();
        $query = $db->query("SELECT * FROM `images` 
                               LEFT JOIN `booths_images` ON `images`.`image_id` = `booths_images`.`image_id`
							   LEFT JOIN `booths` on `booths_images`.`booth_id` = `booths`.`booth_id`
							   WHERE `booths_images`.`booth_id` = '$id'");
		if($db->affectedRows() == 0){
			return true;
		}else{
			$images = $query->getRowArray();
			foreach($this->typeRules as $key => $data){
				if($data['id'] == $images['booth_type_id']){
					if(count($images) < $data['imagesNum']){
						return true;
					}else{
						return 'You reached capacity for this booth type';
					}
				}
			}
		}
	}

	public function getImageNumber($typeId)
	{
		foreach($this->typeRules as $key => $value){
			if($value['id'] == $typeId){
				return $value['imagesNum'];
			}
		}
	}

}