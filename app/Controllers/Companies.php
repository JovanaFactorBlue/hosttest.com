<?php namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\BoothModel;
use App\Libraries\IonAuth;

class Companies extends BaseController
{
    public function __construct()
    {
        $this->auth = new IonAuth();
        $this->groups = array(4, 5);
        $this->inGroup =  $this->auth->inGroup($this->groups);

        $this->c = new CompanyModel;
    }

    public function booths($id)
    {
        if($this->inGroup == false){
            return redirect()->to('/');
        }
        return view('company/booths');
    }

    public function getBooths($id)
    {
        if($this->inGroup == false){
            return redirect()->to('/');
        }
        $booth = new BoothModel();
        return $result = $booth->getBoothsByCompanyId($id);
    }
    
    public function companyData($id)
    {
        if($this->inGroup == false){
            return redirect()->to('/');
        }
        $data = [
            'basic' => $this->c->find($id),
            'contacts' => $this->c->getContacts($id),
            'links' => $this->c->getLinks($id),
            'social' => $this->c->getSocials($id),
            'networks' => $this->c->socialMedia
        ];
        
        return view('client/company', $data);
    }

    public function editBasic($id)
    {
        if($this->inGroup == false){
            return redirect()->to('/');
        }
        $data = $this->c->find($id);
        return view('client/companydata', $data);
    }    
    
    public function editProfiles($id)
    {
        if($this->inGroup == false){
            return redirect()->to('/');
        }
        $data = [
            'profiles' => $this->c->getAllProfiles($id),
            'company' => $this->c->find($id)
        ];
        return view('client/profiles', $data);
    }

    public function editSocial($id)
    {
        if($this->inGroup == false){
            return redirect()->to('/');
        }
        $data = [
            'company' => $this->c->find($id),
            'profiles' => $this->c->getSocials($id),
            'networks' => $this->c->socialMedia
        ];
        return view('client/social', $data);
    } 

    public function editContact($id)
    {
        if($this->inGroup == false){
            return redirect()->to('/');
        }
        $data = [
            'contact' => $this->c->getContacts($id),
            'company' => $this->c->find($id)
        ];
        return view('client/contact', $data);
    }    
    
    public function editLinks($id)
    {
        if($this->inGroup == false){
            return redirect()->to('/');
        }
        $data = [
            'links' => $this->c->getLinks($id),
            'company' => $this->c->find($id)
        ];
        return view('client/links', $data);
    } 

    public function newLink()
    {
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $validationRules = [
            'compId' => 'required',
            'link' => 'required',
            'text' => 'required'
        ];

        if (! $this->validate($validationRules))
        {
            // return $validation->listErrors();
            return redirect()->to('../company/external/'.$this->request->getPost('compId'))->with('error', $validation->listErrors());
        }
        else
        {
            $inputData = [
                'companyId' => $this->request->getPost('compId'),
                'link' => $this->request->getPost('link'),
                'text' => esc($this->request->getPost('text'))
            ];
            $newLink = $this->c->addLink($inputData);

            if($newLink){
                return redirect()->to('../company/external/'.$this->request->getPost('compId'))->with('message', 'Success!');
            }
        }
    }

    public function updateLink()
    {
        helper(['form', 'url']);
        $inputData = [
            'id' => $this->request->getPost('id'),
            'companyId' => $this->request->getPost('compId'),
            'link' => $this->request->getPost('link'),
            'text' => esc($this->request->getPost('text'))
        ];

        $update = $this->c->updateLink($inputData);
        if($update){
            return redirect()->to('../company/external/'.$this->request->getPost('compId'))->with('message', 'Success!');
        }
    }

    public function deleteLink($id, $compId)
    {
        $delete = $this->c->deleteLink($id);
        if($delete){
            return redirect()->to('../company/external/'.$compId)->with('message', 'Success!');
        }
    }

    public function addContact()
    {
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'telephone' => 'required'

        ];

        if (! $this->validate($validationRules))
        {
            return $validation->listErrors();
        }
        else
        {
            $inputData = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'telephone' => $this->request->getPost('telephone'),
                'address' => esc($this->request->getPost('address')),
                'compId' => $this->request->getPost('compId'),
            ];

            $insert = $this->c->addContact($inputData);
            if($insert){
                return redirect()->to('../company/contacts/'.$this->request->getPost('compId'))->with('message', 'Success!');
            }
        }
    }

    public function updateContact()
    {
        helper(['form', 'url']);
        $inputData = [
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'telephone' => $this->request->getPost('telephone'),
            'address' => esc($this->request->getPost('address')),
            'companyId' => $this->request->getPost('companyId'),
        ];
        
        $update = $this->c->updateContact($inputData);
        if($update){
            return 'success';
        }
    }

    public function deleteContact($id, $compId)
    {
        $this->c->removeContact($id);
        return redirect()->to('../company/contacts/'.$compId)->with('message', 'Success!');
    }

    public function updateSocial()
    {       
        $data = [
            'compId' => $this->request->getPost('compId'),
            'link' => $this->request->getPost('link'),
            'type' => $this->request->getPost('type')
        ];
        $this->c->insertSocialLink($data);

        return redirect()->to('social/'.$this->request->getPost('compId'))->with('message', 'Success!'); 
    }

    public function updateBasicData()
    {
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $validationRules = [
            'company_name' => 'required',
            'company_displayname' => 'required',
            'company_location' => 'required',
            'company_website' => 'required',
            'company_slogan' => 'required',
            'company_employees' => 'required',

        ];

        if (! $this->validate($validationRules))
        {
            return $validation->listErrors();
        }
        else
        {
            $inputData = [
                'company_id' => $this->request->getPost('company_id'),
                'company_name' => esc($this->request->getPost('company_name')),
                'company_displayname' => esc($this->request->getPost('company_displayname')),
                'company_location' => esc($this->request->getPost('company_location')),
                'company_employees' => $this->request->getPost('company_employees'),
                'company_website' => $this->request->getPost('company_website'),
                'company_slogan' => esc($this->request->getPost('company_slogan')),
                'company_moreinformation' => esc($this->request->getPost('company_moreinformation')),
                'leverancier_nummer' => $this->request->getPost('leverancier_nummer')
            ];

            $data = json_encode($inputData);
            $update = $this->c->updateBasicData($data);
            if($update == 'success'){
                return redirect()->to('../company/'.$this->request->getPost('company_id'))->with('message', 'Success');
            }
        }
    }

    public function uploadLogo()
    {
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $validationRules = [
            'company_id' => 'required',
            'company_logo' => [
                    'rules'  => 'uploaded[company_logo]|ext_in[company_logo,jpg,jpeg,png]',
                    'errors' => [
                        'required' => 'You need to select an image to upload.',
                    ],
                ]
        ];

        if (! $this->validate($validationRules))
        {
            return $validation->listErrors();
        }
        else
        {   
            $compId = $this->request->getPost('company_id');
            $basePath = $this->c->getCompanyFilesPath($compId);
            $logo = $this->request->getFile('company_logo');
            $ext = $logo->getExtension();

            if (! $logo->isValid())
            {
                throw new RuntimeException($logo->getErrorString().'('.$logo->getError().')');
            }elseif ($logo->isValid() && ! $logo->hasMoved()){
                
                helper('text');
                $newName = random_string('alnum', 8).'.'.$ext;

                if (!file_exists($basePath.'/logo')) {
                    mkdir($basePath.'/logo', 0777, true);
                }

                $movePath = $basePath.'/logo/';
                //move image to folder
                $logo->move($movePath, $newName, true);
                //add path to database
                $path = $movePath.'/'.$newName;
                $dbUpload = $this->c->uploadLogo($path, $compId);
                if($dbUpload){
                    return redirect()->to('../company/'.$compId)->with('message', 'Success!');
                }
            }

        }

    }

    public function removeLogo($id)
    {
        $row = $this->c->find($id);
        unlink($row['company_logo']); 
        $del = $this->c->deleteLogo($id);
        if($del = 'removed'){
            return redirect()->to('../company/'.$id);
        }
    }
}