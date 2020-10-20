<?php namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\FairModel;

class CrudFairs extends BaseController
{

    public function fairs () {
        $crud = new GroceryCrud();

        $crud->setTheme('datatables');
        $crud->setTable('fairs');
        $crud->setSubject('Fair');
        $crud->requiredFields(['title','startDate','endDate','public','registration']);
        $crud->columns(['title','startDate','endDate','public','registration', 'slug']);
        $crud->setRelationNtoN('pavilions', 'fair_pavilions', 'pavilions', 'fair_id', 'pavilion_id' , 'title' , $where_clause = null);
        $crud->setRelation('organizer_id', 'users', 'username');
        $crud->setRead();

        $crud->setActionButton('Set image', 'el el-user', function ($primaryKey) { 
            return base_url('/fairs/uploadFileForm/' . $primaryKey); 
        });

        $output = $crud->render();

        return $this->_output($output);
    }
        
    private function _output($output = null) 
    {
        return view('fairs/index', (array)$output);
    }
}

