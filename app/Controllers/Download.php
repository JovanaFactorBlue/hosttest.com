<?php namespace App\Controllers;

use App\Models\DownloadModel;


class Dovnload extends BaseController
{
	public function downloadFile($file_id = 0)
	{
		$download = $this->downloads_model->getById($file_id);

		header('Content-type: ' . $download['file_type']);
		// It will be called downloaded.pdf
		header('Content-Disposition: attachment; filename="' .  $download['orig_name'] .'"');
		// The PDF source is in original.pdf
		readfile('assets/company/' . $download['company_id'] . '/' . $download['file_name'] . '');
	}

}




