<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Versionthree_update extends CI_Migration {

	public function up()
	{
		$this->db->insert_batch('tbl_withdrawal_methods',array(array('id'=>1,'method'=>'Paypal','threshold'=>1,'fee'=>1,'cal_meth'=>0,'status'=>1),array('id'=>2,'method'=>'Payoneer','threshold'=>50,'fee'=>5,'cal_meth'=>1,'status'=>1),array('id'=>3,'method'=>'Bank Transfer','threshold'=>200,'fee'=>30,'cal_meth'=>1,'status'=>1)));

	}

	public function down()
	{

	}
}