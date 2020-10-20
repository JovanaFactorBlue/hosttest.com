<?php namespace App\Models;

use CodeIgniter\Model;
use GroceryCrudModel;
use App\Models\BoothModel;

class VideoModel extends Model {

	protected $table = 'videos';
	protected $primaryKey = 'video_id';

	protected $allowedFields = [
		'company_id', 
		'title', 
		'url', 
		'type', 
		'video_code', 
		'language', 
		'embed_code'
	];
      
    public function generateVideoEmbedUrl($url){
        //This is a general function for generating an embed link of an FB/Vimeo/Youtube Video.
        $finalUrl = '';
        if(strpos($url, 'facebook.com/') !== false) {
            //it is FB video
            $finalUrl.='https://www.facebook.com/plugins/video.php?href='.rawurlencode($url).'&show_text=1&width=200';
        }elseif(strpos($url, 'vimeo.com/') !== false) {
            //it is Vimeo video
            $videoId = explode("vimeo.com/",$url)[1];
            if(strpos($videoId, '&') !== false){
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://player.vimeo.com/video/'.$videoId;
        }elseif(strpos($url, 'youtube.com/') !== false) {
            //it is Youtube video
            $videoId = explode("v=",$url)[1];
            if(strpos($videoId, '&') !== false){
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://www.youtube.com/embed/'.$videoId;
        }elseif(strpos($url, 'youtu.be/') !== false){
            //it is Youtube video
            $videoId = explode("youtu.be/",$url)[1];
            if(strpos($videoId, '&') !== false){
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://www.youtube.com/embed/'.$videoId;
        }else{
            return 'Please enter a valid video URL';
        }
        return $finalUrl;
    }

    public function getVideoType($url)
    {
        $type = parse_url($url, PHP_URL_HOST);

        if($type == 'www.youtube.com' || $type == 'youtu.be'){
            return 'youtube';
        }elseif($type == 'vimeo.com'){
            return 'vimeo';
        }elseif($type == 'facebook.com'){
            return 'facebook';
        }else{
            return null;
        }
        
    }

    public function getVideoCode($url){
        $type = parse_url($url, PHP_URL_HOST);
        
        if($type == 'facebook.com') {
            return rawurlencode($url);
        }elseif($type == 'vimeo.com') {
            return explode("vimeo.com/",$url)[1];
        }elseif($type == 'www.youtube.com') {
            return $videoId = explode("v=",$url)[1];
        }elseif($type == 'youtu.be'){
            return explode("youtu.be/",$url)[1];
        }else{
            return null;
        }
    }

    public function uploadToDb($url, $boothId, $position, $title, $type, $language)
    {
        if($type == 'social'){
            $embedCode = $this->generateVideoEmbedUrl($url);
            $videoCode = $this->getVideoCode($url);
            $type = $this->getVideoType($url);
        }elseif($type == 'direct'){
            $embedCode = '';
            $videoCode = '';
        }
        $b = new BoothModel;
        $companyId = $b->getCompanyId($boothId);
        
        $data = [
            'company_id' => $companyId, 
            'title' => $title, 
            'url' => $url, 
            'type' => $type, 
            'video_code' => $videoCode, 
            'language' => strtolower($language), 
            'embed_code' => $embedCode
        ];
        
        $this->insert($data);

        if($this->affectedRows() != 0){
            $db = db_connect();
            $get = $db->query("SELECT max(`video_id`) AS `videoId` 
                               FROM `videos`
                               WHERE `company_id` = '$companyId'");
            $result = $get->getResultArray();
            $videoId = $result[0]['videoId'];

            $query = $db->query("INSERT INTO `booths_videos`
                                (`booth_id`, `video_id`, `position`)
                                 VALUES ('$boothId', '$videoId', '$position')");
            if($query){
                return 'Video added succesfully';
            }
        }
    }

    public function removeVideo($id)
    {
        $video = $this->where('video_id', $id)->delete();
        if($video){
            $db = db_connect();
            $remove = $db->query("DELETE FROM `booths_videos`
                               WHERE `video_id` = '$id'");
            if($remove){
                return 'success';
            }
        }
    }

}