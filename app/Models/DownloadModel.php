<?php namespace App\Models;

use CodeIgniter\Model;
use GroceryCrudModel;
use App\Models\BoothModel;

class DownloadModel extends Model {

	protected $table = 'downloads';
	protected $primaryKey = 'download_id';

	protected $allowedFields = [
		'company_id', 
		'file_name', 
		'file_type', 
		'file_path', 
		'full_path', 
		'raw_name', 
		'orig_name', 
		'file_ext', 
		'file_size',
		'is_image',
		'image_type',
		'image_width',
		'image_height',
		'language'
	];

    public function uploadToDb($inputData)
    {
        $recievedData = json_decode($inputData, true);
        $b = new BoothModel;

        $data = [
            'company_id' => $recievedData['company_id'],
            'file_name' => $recievedData['file_name'],
            'file_type' => $recievedData['file_type'], 
            'file_path' => $recievedData['file_path'], 
            'full_path' => $recievedData['full_path'], 
            'raw_name' => $recievedData['raw_name'], 
            'orig_name' => $recievedData['orig_name'], 
            'file_ext' => $recievedData['file_ext'], 
            'file_size' => $recievedData['file_size'],
            'is_image' => $recievedData['is_image'],
            'image_type' => $recievedData['image_type'],
            'image_width' => $recievedData['image_width'],
            'image_height' => $recievedData['image_height'],
            'language' => $recievedData['language']
        ];
        
        if($this->insert($data)){
            $downloadId = $this->insertID();
        }
        
        if($this->affectedRows() != 0){
            $db = db_connect();
            $booth_id = $recievedData['booth_id'];

            $result = $db->query("INSERT INTO `booths_downloads` (`booth_id`, `download_id`) 
                                  VALUES ('$booth_id', '$downloadId')");
            if($result){
                return 'Success';
            }
        }
    }

    public function getAllDownloadablesForBooth($boothId)
    {
        $get = $this->query("SELECT * FROM `downloads`
                             LEFT JOIN `booths_downloads` ON `downloads`.`download_id` = `booths_downloads`.`download_id`
                             WHERE `booths_downloads`.`booth_id` ='$boothId'");
        return $get->getResult('array');
    }

    public function myPdfPage($id){
        $path = $this->find($id);
        $html = '<iframe src="'.ltrim($path['file_path'], '.').'" style="border:none; width: 100%; height: 100%"></iframe>';
        echo $html;
    }

    public function downloadPath($id)
    {
        $path = $this->find($id);
        return $filePath = ltrim($path['file_path'], '.');
        
    }

    public function deleteFile($id)
    {
        $delFile = $this->where('download_id', $id)->delete();
        if($delFile){
            $db = db_connect();
            $remove = $db->query("DELETE FROM `booths_downloads`
                               WHERE `download_id` = '$id'");
            if($remove){
                return 'success';
            }
        }
    }
	  
}