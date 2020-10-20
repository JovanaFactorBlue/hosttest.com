<?php namespace App\Models;


use CodeIgniter\Model;
use IonAuthModel;


class UserModel extends Model {

	protected $table = 'users';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'ip_adress', 
		'username', 
		'password', 
		'email',
		'activation_selector',
		'activation_code',
		'forgotten_password_selector',
		'forgotten_password_code',
		'forgotten_password_time',
		'remember_selector',
		'remember_code',
		'created_on',
		'last_login',
		'active',
		'first_name',
		'last_name',
		'company',
		'phone',
		'company',
		'company',
    ];
	
	public function getUserData($id)
	{
		$u = $this->query("SELECT * FROM `users`
						   LEFT JOIN `users_groups` ON `users`.`id` = `users_groups`.`user_id`
						   LEFT JOIN `groups` ON `users_groups`.`user_id` = `groups`.`id`
						   WHERE `users`.`id` = '$id'");
		$data = $u->getRowArray();

		return $data;
	}
}

