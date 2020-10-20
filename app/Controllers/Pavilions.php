<?php namespace App\Controllers;

// use App\Libraries\GroceryCrud;
use App\Models\PavilionModel;

class Pavilions extends BaseController
{
    public function uploadImageForm($id)
    {
        return view('pavilions/upload');
    }

    public function displayImage($id)
    {
        if(file_exists('./uploads/images/pavilions/pavilion'.$id.'.jpg')){
            $file = new \CodeIgniter\Files\File('./uploads/images/pavilions/pavilion'.$id.'.jpg');
            return $file->getBasename();
        }elseif(file_exists('./uploads/images/pavilions/pavilion'.$id.'.jpeg')){
            $file = new \CodeIgniter\Files\File('./uploads/images/pavilions/pavilion'.$id.'.jpeg');
            return $file->getBasename();
        }elseif(file_exists('./uploads/images/pavilions/pavilion'.$id.'.png')){
            $file = new \CodeIgniter\Files\File('./uploads/images/pavilions/pavilion'.$id.'.png');
            return $file->getBasename();
        }else{
            return 'empty';
        }
    }

    public function uploadImage()
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
            $checkName = 'pavilion' . $id;
            
            if($this->displayImage($id) !== 'empty'){
                //if there is already an image with other extension, remove it
                $old = $this->displayImage($id);
                unlink('./uploads/images/pavilions'.'/'.$old);
            }

            $newName = 'pavilion' . $id . '.' . $ext;

            if (! $file->isValid())
            {
                throw new RuntimeException($file->getErrorString().'('.$file->getError().')');
            }elseif ($file->isValid() && ! $file->hasMoved()){
                $movePath = './uploads/images/pavilions';
                //move image to folder
                $file->move($movePath, $newName, true);
                //add path to database
                $pModel = new PavilionModel();
                $data = [
                    'image' => $movePath. '/' . $newName
                ];

                $pModel->set($data);
                $pModel->where('pavilion_id', $id);
                $pModel->update();

                return redirect()->to('/pavilions/uploadImageForm/' . $id);

            }else{
                return 'Error uploading image';
            }
        }
    }

    public function removeImage($id)
    {
        if($this->displayImage($id) !== 'empty'){
            //remove form folder
            unlink('./uploads/images/pavilions'.'/'.$this->displayImage($id));
            //remove from DB
            $pModel = new PavilionModel();
            $data = [
                'image' => null
            ];

            $pModel->set($data);
            $pModel->where('pavilion_id', $id);
            $pModel->update();

            return redirect()->to('/pavilions/uploadImageForm/' . $id);
        }
    }
}

