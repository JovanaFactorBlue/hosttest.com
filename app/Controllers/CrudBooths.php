<?php namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\BoothModel;
use App\Models\CompanyModel;
use App\Models\VideoModel;
use App\Models\DownloadModel;

class CrudBooths extends BaseController
{

    public function booths () {
        $crud = new GroceryCrud();

        $crud->setTheme('datatables');
        $crud->setTable('booths');
        $crud->setSubject('Booth');
        $crud->requiredFields(['fair_id','pavilion_id', 'creditor_id', 'company_id', 'booth_floor', 'booth_color', 'booth_type_id', 'booth_position', 'booth_name', 'booth_banner', 'booth_back_banner']);
        $crud->columns(['booth_floor', 'booth_color', 'booth_position', 'booth_name']);
        $crud->setRelation('booth_type_id', 'booth_types', 'title');
        $crud->setRelation('fair_id', 'fairs', 'title');
        
        $crud->setRelation('company_id', 'company', 'company_name');


        $crud->setRead();

        $crud->setActionButton('Manage gallery', 'el el-user', function ($primaryKey) { 
            return base_url('/booths/gallery/' . $primaryKey); 
        });

        $output = $crud->render();

        return $this->_output($output);
    }

    private function _output($output = null) {

        return view('booths/index', (array)$output);
    }

}

