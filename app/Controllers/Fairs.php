<?php namespace App\Controllers;

// use App\Libraries\GroceryCrud;
use App\Models\FairModel;

class Fairs extends BaseController
{
    public function uploadFileForm($id)
    {
        return view('fairs/upload');
    }

    public function uploadFile()
    {
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $validationRules = [
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

            $file = $this->request->getFile('image');
            $id = $this->request->getPost('id');

            $ext = $file->getExtension();
            $checkName = 'fair' . $id;
            
            if($this->displayImage($id) !== 'empty'){
                //if there is already an image with other extension, remove it
                $old = $this->displayImage($id);
                unlink('./uploads/images/fairs'.'/'.$old);
            }

            $newName = 'fair' . $id . '.' . $ext;

            if (! $file->isValid())
            {
                throw new RuntimeException($file->getErrorString().'('.$file->getError().')');
            }elseif ($file->isValid() && ! $file->hasMoved()){
                $movePath = './uploads/images/fairs';
                //move image to folder
                $file->move($movePath, $newName, true);
                //add path to database
                $fairModel = new FairModel();
                $data = [
                    'file_url' => $movePath. '/' . $newName
                ];

                $fairModel->set($data);
                $fairModel->where('fair_id', $id);
                $fairModel->update();

                return redirect()->to('/fairs/uploadFileForm/' . $id);

            }else{
                return 'Error uploading image';
            }
        }
    }  

    public function displayImage($id)
    {
        if(file_exists('./uploads/images/fairs/fair'.$id.'.jpg')){
            $file = new \CodeIgniter\Files\File('./uploads/images/fairs/fair'.$id.'.jpg');
            return $file->getBasename();
        }elseif(file_exists('./uploads/images/fairs/fair'.$id.'.jpeg')){
            $file = new \CodeIgniter\Files\File('./uploads/images/fairs/fair'.$id.'.jpeg');
            return $file->getBasename();
        }elseif(file_exists('./uploads/images/fairs/fair'.$id.'.png')){
            $file = new \CodeIgniter\Files\File('./uploads/images/fairs/fair'.$id.'.png');
            return $file->getBasename();
        }else{
            return 'empty';
        }
    }

    public function removeImage($id)
    {
        if($this->displayImage($id) !== 'empty'){
            //remove form folder
            unlink('./uploads/images/fairs'.'/'.$this->displayImage($id));
            //remove from DB
            $fairModel = new FairModel();
            $data = [
                'file_url' => null
            ];

            $fairModel->set($data);
            $fairModel->where('fair_id', $id);
            $fairModel->update();

            return redirect()->to('/fairs/uploadFileForm/' . $id);
        }
    }
}

