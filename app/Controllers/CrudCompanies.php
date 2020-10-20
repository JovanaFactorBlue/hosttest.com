<?php namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\CompanyModel;
use App\Models\BoothModel;

class CrudCompanies extends BaseController
{

    public function companies () {
        $crud = new GroceryCrud();

        $crud->setTheme('datatables');
        $crud->setTable('company');
        $crud->setSubject('company');
        $crud->requiredFields([
            'company_name',
            'company_displayname',
            'company_location',
            'company_employees',
            'company_website',
            'company_slogan', 
            'company_logo',
            'company_moreinformation',
            'leverancier_nummer'
        ]);
        
        $crud->columns(['company_name', 'company_displayname', 'company_location']);
        
        $crud->setRead();

        $crud->setActionButton('Manage booths', 'el el-user', function ($primaryKey) { 
            return base_url('/companies/booths/' . $primaryKey); 
        });

        $output = $crud->render();

        return $this->_output($output);
    }


    private function _output($output = null) {

        return view('company/index', (array)$output);
    }
}