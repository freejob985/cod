<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Versionfour_update extends CI_Migration {

	public function up()
	{
		$this->db->where('id',4);
		$this->db->update('tbl_payment_settings', array('paymentgateway_id'=>'Escrow'));

		$this->db->query("ALTER TABLE `tbl_listings` MODIFY `id` INT NOT NULL AUTO_INCREMENT");
		$this->db->query("ALTER TABLE `tbl_listings` MODIFY `business_registeredCountry` VARCHAR (10)");
		$this->db->query("ALTER TABLE `tbl_listings` MODIFY `app_market` VARCHAR (50)");

		$ads_fields = array(
        	'webpage_banner_720x90' => array('type' => 'TEXT','null' => TRUE)
		);

		$this->dbforge->add_column('tbl_ads', $ads_fields);

		$this->db->query("ALTER TABLE `tbl_history` CHANGE COLUMN `timestamp` `date` datetime default current_timestamp ");

	}

	public function down()
	{

	}
}