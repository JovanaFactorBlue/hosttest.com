<?php namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\PavilionModel;

class CrudPavilions extends BaseController
{

    public function pavilions () {
        $crud = new GroceryCrud();

        $crud->setTheme('datatables');
        $crud->setTable('pavilions');
        $crud->setSubject('Pavilion');
        $crud->requiredFields(['title','booths','image', 'slug']);
        $crud->columns(['title','booths','image', 'slug']);
        //setRelationNtoN($field_name, $relation_table, $selection_table, $primary_key_alias_to_this_table, $primary_key_alias_to_selection_table , $title_field_selection_table , $where_clause = null)
        $crud->setRead();

        $crud->setActionButton('Set image', 'el el-user', function ($primaryKey) { 
            return base_url('/pavilions/uploadImageForm/' . $primaryKey); 
        });

        $output = $crud->render();

        return $this->_output($output);
    }
    
    private function _output($output = null) {

        return view('pavilions/index', (array)$output);
    }
}

