<?php namespace App\Models;


use CodeIgniter\Model;
use GroceryCrudModel;


class FairModel extends Model {

	protected $table = 'fairs';
	protected $primaryKey = 'fair_id';

	protected $allowedFields = [
		'organizer_id', 
		'title', 
		'startDate', 
		'endDate', 
		'public', 
		'registration', 
		'slug', 
		'file_url'
	];
	  
}
