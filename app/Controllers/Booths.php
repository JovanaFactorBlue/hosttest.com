<?php namespace App\Controllers;

use App\Models\BoothModel;
use App\Models\CompanyModel;
use App\Models\VideoModel;
use App\Models\DownloadModel;

class Booths extends BaseController
{
    public function __construct()
    {
        $this->m = new BoothModel;
    }

    public function index($id) // latest
    {
        $data = [
            'booth' => $this->m->find($id),
            'type' => $this->m->getBoothType($id)
        ];

        return view('client/booth', $data);   
    }

    public function imgGallery($id) // latest
    {
        $data = [
            'id' => $id,
            'imgs' => $this->m->getBoothImagesPath($id),
            'type' => $this->m->getBoothType($id)
        ];
        return view('client/imgallery', $data);
    }

    public function vidGallery($id) // latest
    {
        $data = [
            'id' => $id,
            'vids' => $this->m->getBoothVideosPath($id),
            'type' => $this->m->getBoothType($id),
            'positions' => $this->m->getAvlVideoPositions($id)
        ];
        return view('client/vidgallery', $data);
    }

    public function displayBoothImage($id, $companyId, $imgPosition)
    {
        $b = new BoothModel;

        return $b->getBoothImagesPath($id, $companyId, $imgPosition);

    }

    public function uploadBoothImage()
    {
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $validationRules = [
            'position' => 'required',
            'id' => 'required',
            'image' => [
                'rules'  => 'uploaded[image]|ext_in[image,jpg,jpeg,png]',
                'errors' => [
                    'required' => 'You need to select an image to upload.',
                ],
            ],
        ];

        if (! $this->validate($validationRules))
        {
            return $validation->listErrors();
        }
        else
        {

            $id = $this->request->getPost('id');
            $position = $this->request->getPost('position');
            $file = $this->request->getFile('image');

            $ext = $file->getExtension();

            $check = $this->m->checkTypeForImages($id);

            if($check == true){
                helper('text');
                $newName = random_string('alnum', 8).'.'.$ext;
            }

            if (! $file->isValid())
            {
                throw new RuntimeException($file->getErrorString().'('.$file->getError().')');
            }elseif ($file->isValid() && ! $file->hasMoved()){

                $comp = $this->m->getCompanyId($id);
                $cm = new CompanyModel;
                $path = $cm->getCompanyFilesPath($comp);
                if (!file_exists($path.'/booths/'.$id)) {
                    mkdir($path.'/booths/'.$id, 0777, true);
                }

                $movePath = $path.'/booths/'.$id;
                //move image to folder
                $file->move($movePath, $newName, true);
                //add path to database
                $imagePath = $movePath.'/'.$newName;
                $db = db_connect();
                $intoImages = $db->query("INSERT INTO `images` (`file_path`)
                VALUES ('$imagePath');");
                
                if($intoImages){
                    $imageId = $db->query("SELECT `image_id` FROM `images` WHERE `file_path` = '$imagePath'");
                    $result = $imageId->getRowArray();
                    $imageId = $result['image_id'];

                    //insert to booths_images
                    $db->query("INSERT INTO `booths_images` (`booth_id`, `image_id`, `position`)
                    VALUES ($id, $imageId, $position)");
                }

                $message = 'Success';
                

            }else{
                 $message ='Error uploading image';
            }
        }
        return redirect()->to('./images/'.$id)->with('message', $message);
    }

    public function unlinkImage($boothId, $position)
    {
        $get = $this->m->getOneImage($boothId, $position);
        //remove from `images` table
        $imgID = $get['image_id'];
        $db = db_connect();
        $imgRemove = $db->query("DELETE FROM `images`
                                 WHERE `images`.`image_id` = '$imgID'");
        if($imgRemove){
            //remove from `booths_images` table
            $bimgRemove = $db->query("DELETE FROM `booths_images`
                                      WHERE `image_id` = '$imgID'
                                      AND `booth_id` = '$boothId'");
            if($bimgRemove){
                //unlink from folder
                unlink($get['file_path']);
                return redirect()->to('./images/'.$boothId);
            }
        }   
    }

    public function uploadVideo()
    {
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $validationRules = [
            'id' => 'required',
            'link' => 'required',
            'title' => 'required',
            'language' => 'required',
            'type' => 'required',
            'position' => 'required'
        ];

        if (! $this->validate($validationRules))
        {
            return $validation->listErrors();
        }
        else
        {
            $boothId = $this->request->getPost('id');
            $url = $this->request->getPost('link');   
            $title = $this->request->getPost('title');   
            $language = $this->request->getPost('language');   
            $type = $this->request->getPost('type');   
            $position = $this->request->getPost('position');   
        }
        
        $v = new VideoModel;

        $upload = $v->uploadToDb($url, $boothId, $position, $title, $type, $language);

        
        return redirect()->back();
    }

    public function deleteVideo($id)
    {
        $v = new VideoModel;
        $v->removeVideo($id);

        return 'success';
    }

    public function deleteDownloadableFile($id)
    {
        $d = new DownloadModel;
        $file = $d->find($id);
        $remove = unlink($file['file_path']);
        if($remove){
            $d->deleteFile($id);
            return 'Success';
        }
    }

    public function uploadDownloadables()
    {
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $validationRules = [
            'booth_id' => 'required',
            'title' => 'required',
            'language' => 'required',
            'file' => [
                'rules'  => 'uploaded[file]|ext_in[file,jpg,jpeg,png,pdf]',
                'errors' => [
                    'required' => 'You need to select a proper file to upload.',
                ],
            ],
        ];

        if (! $this->validate($validationRules))
        {
            return $validation->listErrors();
        }
        else
        {   $file = $this->request->getFile('file');
            $boothId = $this->request->getPost('booth_id');
            
            if (! $file->isValid())
            {
                throw new RuntimeException($file->getErrorString().'('.$file->getError().')');
            }elseif ($file->isValid() && ! $file->hasMoved()){
                // get file extension
                $ext = $file->getExtension();
                
                //is_image
                $isImage;

                if($ext == 'jpg' ||$ext == 'jpeg' ||$ext == 'png'){
                    $isImage = 1;
                }else{
                    $isImage = 0;
                }
                
                if($isImage == 1){
                    // get file info
                    $fileInfo = getimagesize($file, $image_info);
                    $dim = explode(' ', $fileInfo['3']);

                    $imageWidth = filter_var($dim['0'], FILTER_SANITIZE_NUMBER_INT);
                    $imageHeight = filter_var($dim['1'], FILTER_SANITIZE_NUMBER_INT);
                    $imageType = $ext;
                }else{
                    $imageWidth = 0;
                    $imageHeight = 0;
                    $imageType = 0;
                }
                
                
                //get company ID
                // $comp = $this->request->getPost('company_id');
                // var_dump($this->m->getCompanyId($boothId));
                // die();
                $comp = intval($this->m->getCompanyId($boothId));
                $cm = new CompanyModel;
                //get path to company files
                $path = $cm->getCompanyFilesPath($comp);
                // check if folder exists, if not make it
                if (!file_exists($path.'/booths/'.$boothId.'/files')) {
                    mkdir($path.'/booths/'.$boothId.'/files', 0777, true);
                }

                // for safety, create random new file name
                helper('text');
                $rawName = random_string('alnum', 8);
                $newName = $rawName.'.'.$ext;
                //file type
                $fileType = $file->getMimeType();
                //get orig name
                $origName = $file->getName();
                //get size
                $fileSize = $file->getSize();
                //path to move file
                $movePath = $path.'/booths/'.$boothId.'/files';
                //move file to folder
                $file->move($movePath, $newName, true);
                //add path to database
                $filePath = $movePath.'/'.$newName;
                $fullPath = './public/'.$movePath.'/'.$newName;



                $inputData = [
                    'company_id'   => $comp,
                    'file_name'    => $this->request->getPost('title'),
                    'file_type'    => $fileType,
                    'file_path'    => $filePath,
                    'full_path'    => $fullPath,
                    'raw_name'     => $rawName,
                    'orig_name'    => $origName,
                    'file_ext'     => $ext,
                    'file_size'    => $fileSize,
                    'is_image'     => $isImage,
                    'image_type'   => $imageType,
                    'image_width'  => $imageWidth,
                    'image_height' => $imageHeight,  
                    'language'     => $this->request->getPost('language'),
                    'booth_id'     => $boothId
                ];

                

                $data = json_encode($inputData);
                $v = new DownloadModel;
                $upload = $v->uploadToDb($data);
            }

            return redirect()->back();
        }        
        
    }

    public function displayDownloadables($boothId)
    {
        $d = new DownloadModel;
        $getDownloadables = $d->getAllDownloadablesForBooth($boothId);

        return view('client/download', $getDownloadables);
    }

    public function myPdfPage($id){
        $d = new DownloadModel;
        return $d->myPdfPage($id);
    }

    public function downloadFile($id) // not working, see why
    {
        $d = new DownloadModel;
        $filePath = $d->downloadPath($id);

        header("Content-type:application/octet-stream");
        header('Content-Disposition: attachment; filename=' . $filePath);
        return readfile( $filePath );
        
    }

}

