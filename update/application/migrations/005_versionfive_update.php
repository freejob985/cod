<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Versionfive_update extends CI_Migration {

	public function up()
	{
		$this->db->query("ALTER TABLE `tbl_invoices` MODIFY `id` INT NOT NULL AUTO_INCREMENT");
	}

	public function down()
	{

	}
}