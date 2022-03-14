<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

	public function index($version = '')
	{
		$this->load->library('migration');

		if(empty($version)){
			if ($this->migration->current() === FALSE)
			{
				show_error($this->migration->error_string());
			}

			exit('Successfully Migrated');
		}
		else
		{
			if ($this->migration->version($version) === FALSE)
			{
				show_error($this->migration->error_string());
			}

			exit('Successfully Migrated');
		}
		
	}
}