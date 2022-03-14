<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Versiontwo_update extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'appid' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'secretid' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'icon' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_social_logins',true);
        $this->db->insert_batch('tbl_social_logins',array( array('id'=>'1','name'=>'Facebook','appid'=>'','secretid'=>'','icon'=>'fa fa-facebook'),array('id'=>'2','name'=>'Google','appid'=>'','secretid'=>'','icon'=>'fa-fa-google')));

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'default' => 1,
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'refer' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 2,
            ),
            'date datetime default current_timestamp',
            'eligible_count' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'payment_amount' => array(
                'type' => 'FLOAT'
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_refferal',true);


        $tbl_users_fields = array(
            'referral_code' => array('type' => 'VARCHAR','constraint' => '250'),
            'referrer' => array('type' => 'INT','default' => 0),
            'identifier' => array('type' => 'TEXT','null' => TRUE)
        );

        $this->dbforge->add_column('tbl_users', $tbl_users_fields);

        $this->db->query('ALTER TABLE `tbl_users` ADD UNIQUE INDEX (`username`)');
        $this->db->query('ALTER TABLE `tbl_users` ADD UNIQUE INDEX (`email`)');


        $tbl_languages_fields = array(
            'l_format' => array('type' => 'VARCHAR','constraint' => '4')
        );

        $this->dbforge->add_column('tbl_languages', $tbl_languages_fields);

        $this->db->query('ALTER TABLE `tbl_languages` ADD UNIQUE INDEX (`language_code`)');
        $this->db->query('ALTER TABLE `tbl_languages` ADD UNIQUE INDEX (`language`)');

        $this->db->update('tbl_languages', array('l_format'=>'ltr'));


        $tbl_payment_settings_fields = array(
            'description' => array('type' => 'VARCHAR','constraint' => '250'),
            'card_status' => array('type' => 'INT','constraint' => 2),
            'back_status' => array('type' => 'INT','constraint' => 2),
            'email_only' => array('type' => 'INT','constraint' => 2),
            'is_fixed' => array('type' => 'INT','constraint' => 2),
            'fields' => array('type' => 'TEXT','null' => TRUE)
        );

        $this->dbforge->add_column('tbl_payment_settings', $tbl_payment_settings_fields);

        $payment_set = array( array('id'=>1,'description'=>'PayPal','card_status'=>0,'back_status'=>1,'email_only'=>0,'is_fixed'=>1,'fields'=>'{"status":"paypal status","username":"Paypal Username","password":"Paypal Password","signature":"Paypal Signature","icon":"Paypal Icon URL","sandbox":"Sandbox mode paypal"}'),

            array('id'=>2,'description'=>'Credit / Debit Card (Paypal Pro)','card_status'=>1,'back_status'=>1,'email_only'=>0,'is_fixed'=>1,'fields'=>'{"status":"paypal status","username":"Paypal Username","password":"Paypal Password","signature":"Paypal Signature","icon":"Paypal Icon URL","sandbox":"Sandbox mode paypal"}'),

            array('id'=>3,'description'=>'Credit / Debit Card (Stripe)','card_status'=>1,'back_status'=>1,'email_only'=>0,'is_fixed'=>1,'fields'=>'{"status":"Stripe status","signature":"Stripe Signature Signature","icon":"Stripe Icon URL","sandbox":"Sandbox mode Stripe"}'),

            array('id'=>4,'description'=>'Escrow Service','card_status'=>0,'back_status'=>0,'email_only'=>1,'is_fixed'=>1,'fields'=>'{"status":"Escrow status","username":"Escrow Username","signature":"Escrow API Key","icon":"Escrow URL Icon","sandbox":"Sandbox mode Escrow"}')
        );

        $this->db->update_batch('tbl_payment_settings', $payment_set, 'id');


        $tbl_settings_fields = array(
            'custom_css' => array('type' => 'LONGTEXT'),
            'custom_js' => array('type' => 'LONGTEXT'),
        );

        $this->dbforge->add_column('tbl_settings', $tbl_settings_fields);

    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_social_logins');
        $this->dbforge->drop_table('tbl_refferal');

        $this->db->query('ALTER TABLE `tbl_languages` DROP INDEX (`language_code`)');
        $this->db->query('ALTER TABLE `tbl_languages` DROP INDEX (`language`)');

        $this->db->query('ALTER TABLE `tbl_users` DROP INDEX (`username`)');
        $this->db->query('ALTER TABLE `tbl_users` DROP INDEX (`email`)');
    }
}