<?php namespace App\Models;


use CodeIgniter\Model;
use GroceryCrudModel;


class PavilionModel extends Model {

	protected $table = 'pavilions';
	protected $primaryKey = 'pavilion_id';

	protected $allowedFields = [
		'title', 
		'booths', 
		'image', 
		'slug'
	];
	  
}
