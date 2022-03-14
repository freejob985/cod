<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Versionsix_update extends CI_Migration {

	public function up()
	{
		$setting_fields = array(
        	'moz_api_key' => array('type' => 'TEXT','null' => TRUE),
        	'moz_access_id' => array('type' => 'TEXT','null' => TRUE)
		);

		$this->dbforge->add_column('tbl_settings', $setting_fields);
	}

	public function down()
	{

	}
}