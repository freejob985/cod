<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Initial_install extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'default' => 1,
            ),
            'homepage_banner_720x90' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'blog_page_720x90' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'blog_300x250' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'blog__post_page_720x90' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'blog__post_page_300x250' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_ads',TRUE);
        $this->db->insert('tbl_ads', array('id'=>'1'));


        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'announcement_heading' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'announcement' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'announcement_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'group_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'date' => array(
                'type' => 'DATETIME',
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_announcement',TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'listing_id' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'listing_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'bidder_id' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'owner_id' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'bid_amount' => array(
                'type' => 'FLOAT',
            ),
            'bid_status' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'date' => array(
                'type' => 'DATETIME',
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_bids',TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'TEXT',
                'null' => FALSE,
            ),
            'slug' => array(
             'type' => 'TEXT',
             'null' => FALSE,
         ),
            'metadescription' => array(
                'type' => 'TEXT',
                'null' => FALSE,
            ),
            'metakeywords' => array(
                'type' => 'TEXT',
                'null' => FALSE,
            ),
            'blog_post' => array(
                'type' => 'TEXT',
                'null' => FALSE,
            ),
            'blog_tags' => array(
                'type' => 'TEXT',
                'null' => FALSE,
            ),
            'thumbnail' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'date' => array(
                'type' => 'DATETIME',
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'views' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_blog',TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'c_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'c_description' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'c_keywords' => array(
                'type' => 'TEXT',
                'null' => FALSE,
            ),
            'c_thumb' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'c_level' => array(
                'type' => 'INT',
                'constraint' => 2,
            ),
            'url_slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_categories',TRUE);
        $categories = array(
            array('id'=>'2','c_name'=>'Cars & Vehicles','c_description'=>'Software Engineer, Web / Mobile Developer & More','c_keywords'=>'["he","lol"]','c_thumb'=>'11.png','c_level'=>0,'url_slug'=>'cars-vehicles'),
            array('id'=>'3','c_name'=>'Electric & Gadgetss','c_description'=>'Electric & Gadgets / Tools','c_keywords'=>'["he","lol"]','c_thumb'=>'22.png','c_level'=>0,'url_slug'=>'electric-gadgets'),
            array('id'=>'4','c_name'=>'Real Estate','c_description'=>'Real Estate / Properties','c_keywords'=>'["he","lol"]','c_thumb'=>'31.png','c_level'=>0,'url_slug'=>'real-estate'),
            array('id'=>'5','c_name'=>'Sports & Games','c_description'=>'Sports & Games / Video Games','c_keywords'=>'["he","lol"]','c_thumb'=>'4.png','c_level'=>0,'url_slug'=>'sports-games'),
            array('id'=>'6','c_name'=>'Fashion & Beauty','c_description'=>'Fashion & Beauty & More','c_keywords'=>'["he","lol"]','c_thumb'=>'5.png','c_level'=>0,'url_slug'=>'fashion-beauty'),
            array('id'=>'7','c_name'=>'Pets & Animals','c_description'=>'Pets & Animals','c_keywords'=>'["he","lol"]','c_thumb'=>'6.png','c_level'=>0,'url_slug'=>'pets-animals'),
            array('id'=>'8','c_name'=>'Home Appliances','c_description'=>'Home Appliances','c_keywords'=>'["he","lol"]','c_thumb'=>'7.png','c_level'=>0,'url_slug'=>'home-appliances'),
            array('id'=>'9','c_name'=>'Matrimony Services','c_description'=>'Matrimony Services','c_keywords'=>'["he","lol"]','c_thumb'=>'8.png','c_level'=>0,'url_slug'=>'matrimony-services'),
        ); 
        $this->db->insert_batch('tbl_categories', $categories);


        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'listing_id' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'body' => array(
                'type' => 'TEXT',
                'null' => FALSE,
            ),
            'created_at datetime default current_timestamp',
            'status' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'author_comment' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'section' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_comments',TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'domain_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'listing_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'invoice_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'contract_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'amount' => array(
                'type' => 'FLOAT',
            ),
            'timestamp datetime default current_timestamp',
            'contract_method' => array(
               'type' => 'VARCHAR',
               'constraint' => 250,
           )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_contracts',TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'discount_type' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'default'=>0
            ),
            'amount' => array(
                'type' => 'FLOAT',
            ),
            'discount_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'valid_from' => array(
                'type' => 'DATE'
            ),
            'valid_till' => array(
                'type' => 'DATE'
            ),
            'valid_listings' => array(
                'type' => 'TEXT',
                'null' => FALSE,
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'created_date' => array(
                'type' => 'DATETIME',
            ),
            'created_user' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            )

        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_coupons',TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'cron_job' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE,
            ),
            'cron_Minute' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE,
            ),
            'cron_Hour' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE,
            ),
            'cron_day' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE,
            ),
            'cron_month' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE,
            ),
            'cron_weekday' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE,
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'modified_date datetime default current_timestamp'

        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_cron',TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'currency' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'sign' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'default_status' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'rate' => array(
                'type' => 'FLOAT',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_currencies',TRUE);

        $currencies = array(
            array('id'=>'2','currency'=>'USD','sign'=>'$','status'=>1,'default_status'=>1,'rate'=>0),
            array('id'=>'3','currency'=>'EUR','sign'=>'€','status'=>1,'default_status'=>0,'rate'=>0),
            array('id'=>'4','currency'=>'INR','sign'=>'Rs','status'=>1,'default_status'=>0,'rate'=>0)
        ); 

        $this->db->insert_batch('tbl_currencies', $currencies);


        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'contract_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'seller_id' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'buyer_id' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'date datetime default current_timestamp'
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_disputes',TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'domain' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'token' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'google_token' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'google_anastatus' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'date' => array(
                'type' => 'DATETIME'
            ),
            'acc_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'prop_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'view_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_domains',TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'domain_id' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'listing_id' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'invoice_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'amount' => array(
                'type' => 'FLOAT',
            ),
            'timestamp datetime default current_timestamp',
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_domain_purchases',TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => FALSE
            ),
            'site_email' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'site_email_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'mail_sending_option' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'mail_smtp_server' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'mail_smtp_user' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'mail_smtp_password' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'mail_smtp_port' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'mail_smtp_encryption' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_email_settings',TRUE);

        $this->db->insert('tbl_email_settings', array('id'=>'1','site_email'=>'otdomains@gmail.com
            ','site_email_name'=>'Slippa','mail_sending_option'=>'php','mail_smtp_server'=>'localhost','mail_smtp_user'=>'otdomains@gmail.com
            ','mail_smtp_password'=>'Ganeendra642','mail_smtp_port'=>'25','mail_smtp_encryption'=>'ssl'));

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'contract_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'remarks' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'uploads' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'timestamp datetime default current_timestamp',
            'user' => array(
                'type' => 'INT',
                'constraint' => 5
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_history',TRUE);


        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => FALSE
            ),
            'sold-domains' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'apps' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'featured-domains-slider' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'popular-categories' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'auction-table' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'sponsored-ads' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'how-it-works' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'ending-soon' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'trending-listings' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'why-us' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'domains-columns' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'info-box' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'blog-carousel' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'social_accounts' => array(
                'type' => 'INT',
                'constraint' => 5
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_homepage_setup',TRUE);

        $this->db->insert('tbl_homepage_setup', array('id'=>'1','sold-domains'=>1,'apps'=>1,'featured-domains-slider'=>1,'popular-categories'=>1,'auction-table'=>1,'sponsored-ads'=>1,'how-it-works'=>1,'ending-soon'=>1,'trending-listings'=>1,'why-us'=>1,'domains-columns'=>1,'info-box'=>1,'blog-carousel'=>1,'social_accounts'=>1));

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => FALSE
            ),
            'invoice_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'paid_by' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'paid_to' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'gross_amount' => array(
                'type' => 'FLOAT'
            ),
            'processing_fee' => array(
                'type' => 'FLOAT'
            ),
            'success_fee' => array(
                'type' => 'FLOAT'
            ),
            'withdraw_amount' => array(
             'type' => 'FLOAT'
         ),
            'listing_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'invoice_type' => array(
                'type' => 'INT',
                'constraint' => 5,
                'default'=>1
            ),
            'date datetime default current_timestamp',
            'updated' => array(
                'type' => 'DATETIME'
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_invoices',TRUE);

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'language_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'unique'=>TRUE
            ),
            'language' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'unique'=>TRUE
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 2
            ),
            'default_status' => array(
                'type' => 'INT',
                'constraint' => 2,
                'default'=>0
            ),
            'icon' => array(
                'type' => 'INT',
                'constraint' => 5
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_languages',TRUE);

        $this->db->insert('tbl_languages', array('id'=>'1','language_code'=>'en','language'=>'english','status'=>'1','default_status'=>'1','icon'=>'flag-icon-us'));

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'message_id' => array(
                'type' => 'INT',
                'constraint' => 11
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_lastseen',TRUE);


        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => FALSE
            ),
            'domain_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'listing_type' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'user_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'website_BusinessName' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'extension' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'business_registeredCountry' => array(
                'type' => 'FLOAT'
            ),
            'website_industry' => array(
             'type' => 'FLOAT'
         ),
            'monetization_methods' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'last12_monthsrevenue' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'last12_monthsexpenses' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'annual_profit' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'financial_uploadVisual' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'financial_uploadProfitLoss' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'website_tagline' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'website_metadescription' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'website_metakeywords' => array(
                'type' => 'TEXT',
                'NULL' => FALSE,
            ),
            'description' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'website_age' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'website_how_make_money' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'website_purchasing_fulfilment' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'website_whyselling' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'website_suitsfor' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'website_facebook' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'website_twitter' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'website_instagram' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'alexa_rank' => array(
                'type' => 'INT',
                'constraint' => 5,
                'default'=>1
            ),
            'google_verified' => array(
                'type' => 'INT',
                'constraint' => 5,
                'default'=>0
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'sold_status' => array(
                'type' => 'INT',
                'constraint' => 5,
                'default'=>0
            ),
            'deliver_in' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'website_thumbnail' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'website_cover' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'listing_option' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'website_startingprice' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'website_reserveprice' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'website_minimumoffer' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'website_buynowprice' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'Included_assets' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'token' => array(
                'type' => 'MEDIUMTEXT',
                'null' => TRUE
            ),
            'user_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'date' => array(
                'type' => 'DATETIME'
            ),
            'views' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'app_market' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'app_url' => array(
                'type' => 'TEXT',
                'NULL' => FALSE,
            ),
            'monthly_downloads' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'screenshot' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_listings',TRUE);

            $this->dbforge->add_field(array(
                'listing_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'listing_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'listing_description' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'listing_price' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'listing_duration' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'listing_type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'listing_icon' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 5
                ),
            ));

            $this->dbforge->add_key('listing_id', TRUE);
            $this->dbforge->create_table('tbl_listing_header',TRUE);

            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'sender_id' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'recipient_id' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'message' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'timestamp datetime default current_timestamp',
                'view_status' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_message',TRUE);


            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'mon' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'month' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_months',TRUE);

            $months = array(
                array('id'=>'1','mon'=>'Jan','month'=>'January'),
                array('id'=>'2','mon'=>'Feb','month'=>'February'),
                array('id'=>'3','mon'=>'Mar','month'=>'March'),
                array('id'=>'4','mon'=>'Apr','month'=>'April'),
                array('id'=>'5','mon'=>'May','month'=>'May'),
                array('id'=>'6','mon'=>'Jun','month'=>'June'),
                array('id'=>'7','mon'=>'Jul','month'=>'July'),
                array('id'=>'8','mon'=>'Aug','month'=>'August'),
                array('id'=>'9','mon'=>'Sep','month'=>'September'),
                array('id'=>'10','mon'=>'Oct','month'=>'October'),
                array('id'=>'11','mon'=>'Nov','month'=>'November'),
                array('id'=>'12','mon'=>'Dec','month'=>'December')
            );

            $this->db->insert_batch('tbl_months', $months);

            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'subject' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'notification' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'url' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'view_status' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'date datetime default current_timestamp',
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_notifications',TRUE); 


            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'listing_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                ),
                'listing_type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '250',
                ),
                'customer_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                ),
                'owner_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                ),
                'offer_amount' => array(
                    'type' => 'FLOAT',
                ),
                'offer_msg' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'offer_status' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                ),
                'date' => array(
                    'type' => 'DATETIME',
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_offers',TRUE);


            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'contract_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'listing_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                ),
                'bid_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '30',
                ),
                'customer_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                ),
                'owner_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                ),
                'delivery_time' => array(
                    'type' => 'DATETIME',
                ),
                'delivery' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                ),
                'remarks' => array(
                    'type' => 'TEXT',
                    'NULL' => TRUE,
                ),
                'date' => array(
                    'type' => 'DATETIME',
                ),
                'percentage' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'contract_method' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '250',
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_opens',TRUE);

            $this->dbforge->add_field(array(
                'page_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'txt_page_title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'txt_page_meta_description' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'txt_page_meta_keywords' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'txt_page_url_slug' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'txt_page_description' => array(
                    'type' => 'LONGTEXT',
                ),
                'page_visibility_group' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'page_visibility_status' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'date' => array(
                    'type' => 'DATETIME',
                ),
                'p_status' => array(
                    'type' => 'INT',
                    'constraint' => 11
                )
            ));

            $this->dbforge->add_key('page_id', TRUE);
            $this->dbforge->create_table('tbl_pages',TRUE); 

            $pages = array(
                array('page_id'=>'5','txt_page_title'=>'What is Lorem Ipsum?','txt_page_meta_description'=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dumm",'txt_page_meta_keywords'=>'["Lorem Ipsum","dummy"]','txt_page_url_slug'=>'what-is-lorem-ipsum','txt_page_description'=>'demo data','page_visibility_group'=>'all','page_visibility_status'=>0,'date'=>'2020-03-29 07:59:11','p_status'=>0),
                array('page_id'=>'6','txt_page_title'=>'Terms of service','txt_page_meta_description'=>'Welcome to www.lorem-ipsum.info. This site is provided as a service to our visitors and may be used for informational purpos','txt_page_meta_keywords'=>'["Lorem Ipsum"," dummy"]','txt_page_url_slug'=>'terms-of-service','txt_page_description'=>'demo data','page_visibility_group'=>'all','page_visibility_status'=>1,'date'=>'2020-03-29 07:59:11','p_status'=>1),
                array('page_id'=>'7','txt_page_title'=>'Privacy Policy','txt_page_meta_description'=>'Privacy Policy','txt_page_meta_keywords'=>'["Lorem Ipsum"," dummy"]','txt_page_url_slug'=>'privacy-policy','txt_page_description'=>'demo data','page_visibility_group'=>"all",'page_visibility_status'=>1,'date'=>'2020-03-29 07:59:11','p_status'=>1),
            );

            $this->db->insert_batch('tbl_pages', $pages);


            $this->dbforge->add_field(array(
                'ID' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'PAYMENT_ID' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'AMOUNT' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'METHOD' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'ACK' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'USER_ID' => array(
                    'type' => 'INT',
                    'constraint' => 5
                ),
                'TIMESTAMP datetime default current_timestamp',
                'PLAN_ID' => array(
                    'type' => 'INT',
                    'constraint' => 5
                ),
                'TOKEN' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'PAYMENTINFO_0_TRANSACTIONID' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'CORRELATIONID' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'PAYER_ID' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'PAYMENTINFO_0_TRANSACTIONTYPE' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'PAYMENTINFO_0_FEEAMT' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'PAYMENTINFO_0_PAYMENTTYPE' => array(
                   'type' => 'VARCHAR',
                   'constraint' => 250,
               ),
                'PAYMENTINFO_0_TAXAMT' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                )
            ));

            $this->dbforge->add_key('ID', TRUE);
            $this->dbforge->create_table('tbl_payments',TRUE); 


            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'paymentgateway_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'method' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'payment_currency' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 4,
                ),
                'username' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'password' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'signature' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'icon_url' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'sandbox' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 2
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_payment_settings',TRUE); 

            $payments = array(
                array('id'=>1,'paymentgateway_id'=>'PayPal_Express','method'=>"PAYPAL EXPRESS",'payment_currency'=>'USD','username'=>'','password'=>'','signature'=>'','icon_url'=>'https://i.imgur.com/ApBxkXU.png','sandbox'=>true,'status'=>1),
                
                array('id'=>2,'paymentgateway_id'=>'PayPal_Pro','method'=>"PAYPAL PRO",'payment_currency'=>'USD','username'=>'','password'=>'','signature'=>'','icon_url'=>'https://i.imgur.com/IHEKLgm.png','sandbox'=>true,'status'=>1),

                array('id'=>3,'paymentgateway_id'=>'Stripe','method'=>"STRIPE",'payment_currency'=>'USD','username'=>'','password'=>'','signature'=>'','icon_url'=>'https://img.favpng.com/4/21/2/stripe-logo-computer-icons-payment-png-favpng-Xv9idVp1sbtXNBadUeuNFaQW5.jpg','sandbox'=>true,'status'=>1),

                array('id'=>4,'paymentgateway_id'=>'','method'=>"ESCROW",'payment_currency'=>'USD','username'=>'','password'=>'','signature'=>'escrow','icon_url'=>'https://upload.wikimedia.org/wikipedia/commons/8/84/Escrow_com_logo.png','sandbox'=>true,'status'=>1),
            );

            $this->db->insert_batch('tbl_payment_settings', $payments);

            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'platform' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'icon' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'version' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'radio' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'description' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 5
                ),
                'updated datetime default current_timestamp',
                'url_box' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_category' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_age' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'financial_overview' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'financial_evidence' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_description' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_make_money' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_fulfilment' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_why_selling' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_perfect_for' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_social' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_deliver_nof' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_cover' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_thumbnail' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_google_analytics' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'box_platform' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_platforms',TRUE); 

            $platforms = array(
                array('id'=>'1','platform'=>'domain','name'=>"Domain",'type'=>'listing','icon'=>'domains.svg
                    ','version'=>'v1.2','radio'=>'Sell-Domains','description'=>'Domain names that are undeveloped or parked. (Only the domain)','status'=>1,'url_box'=>0,'box_category'=>0,'box_age'=>0,'financial_overview'=>0,'financial_evidence'=>0,'box_description'=>0,'box_make_money'=>0,'box_fulfilment'=>0,'box_why_selling'=>0,'box_perfect_for'=>0,'box_social'=>0,'box_deliver_nof'=>0,'box_cover'=>0,'box_thumbnail'=>0,'box_google_analytics'=>0,'box_platform'=>0),
                
                array('id'=>'2','platform'=>'website','name'=>"Websites",'type'=>'listing','icon'=>'website.svg
                    ','version'=>'v1.2','radio'=>'Sell-Websites','description'=>'Which are currently trading and is generating revenue.','status'=>1,'url_box'=>0,'box_category'=>0,'box_age'=>0,'financial_overview'=>0,'financial_evidence'=>0,'box_description'=>1,'box_make_money'=>0,'box_fulfilment'=>0,'box_why_selling'=>0,'box_perfect_for'=>0,'box_social'=>0,'box_deliver_nof'=>0,'box_cover'=>0,'box_thumbnail'=>0,'box_google_analytics'=>1,'box_platform'=>0),
                
                array('id'=>'3','platform'=>'auction','name'=>"Auction",'type'=>'option','icon'=>'auction.svg','version'=>'v1.2','radio'=>'auction','description'=>'Post the ad and let buyers places the Bids.','status'=>1,'url_box'=>0,'box_category'=>0,'box_age'=>0,'financial_overview'=>0,'financial_evidence'=>0,'box_description'=>0,'box_make_money'=>0,'box_fulfilment'=>0,'box_why_selling'=>0,'box_perfect_for'=>0,'box_social'=>0,'box_deliver_nof'=>0,'box_cover'=>0,'box_thumbnail'=>0,'box_google_analytics'=>0,'box_platform'=>0),
                
                array('id'=>'4','platform'=>'classified','name'=>"Classified",'type'=>'option','icon'=>'classified.svg','version'=>'v1.2','radio'=>'classified','description'=>'Post the ad and let people make offers','status'=>1,'url_box'=>0,'box_category'=>0,'box_age'=>0,'financial_overview'=>0,'financial_evidence'=>0,'box_description'=>0,'box_make_money'=>0,'box_fulfilment'=>0,'box_why_selling'=>0,'box_perfect_for'=>0,'box_social'=>0,'box_deliver_nof'=>0,'box_cover'=>0,'box_thumbnail'=>0,'box_google_analytics'=>0,'box_platform'=>0),
                
                array('id'=>'5','platform'=>'app','name'=>"Apps",'type'=>'listing','icon'=>'app.svg
                    ','version'=>'v1.2','radio'=>'Sell-Apps','description'=>'You are selling an Established or Starter App for mobile or tablet.','status'=>1,'url_box'=>0,'box_category'=>0,'box_age'=>0,'financial_overview'=>0,'financial_evidence'=>0,'box_description'=>0,'box_make_money'=>0,'box_fulfilment'=>0,'box_why_selling'=>0,'box_perfect_for'=>0,'box_social'=>0,'box_deliver_nof'=>0,'box_cover'=>0,'box_thumbnail'=>0,'box_google_analytics'=>0,'box_platform'=>0),
                
                array('id'=>'7','platform'=>'account','name'=>"Account",'type'=>'listing','icon'=>'channels.png','version'=>'v1.2','radio'=>'Sell-Account','description'=>'Selling any Telegram Channel like Facebook/ Youtube / Instagram / Twitter or etc..','status'=>1,'url_box'=>1,'box_category'=>1,'box_age'=>1,'financial_overview'=>1,'financial_evidence'=>1,'box_description'=>1,'box_make_money'=>1,'box_fulfilment'=>1,'box_why_selling'=>1,'box_perfect_for'=>1,'box_social'=>1,'box_deliver_nof'=>1,'box_cover'=>0,'box_thumbnail'=>1,'box_google_analytics'=>0,'box_platform'=>1),
            );

            $this->db->insert_batch('tbl_platforms', $platforms);

            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'platfrom' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'platfrom_domain' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'listing_type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'platfrom_icon' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 2
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_platform_list',TRUE); 


            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'invoice_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'plan_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'plan_header' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'listing_type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'purchase_date' => array(
                    'type' => 'DATETIME'
                ),
                'expire_date' => array(
                    'type' => 'DATETIME'
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_purchases',TRUE);

            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'listing_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'reporter' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'reason' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'date datetime default current_timestamp',
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_reports',TRUE);  


            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'reviewer_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'review' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'ratings' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 2
                ),
                'date' => array(
                    'type' => 'DATETIME'
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_reviews',TRUE);  


             $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'user_email_activation' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'admin_email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'admin_email_copy' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'json_key_file' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'site_meta_keywords' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'site_meta_description' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'ssl_enable' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'user_facebook' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_twitter' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_Instagram' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_github' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_google' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_youtube' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'blacklisted_domains' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'commission_based' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'withdrawal_options' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'default_currency' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 5,
                ),
                'show_expired_records' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'activate_one_listing_per_domain' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                    'default'=>1
                ),
                'monetization_methods' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'auction_period' => array(
                    'type' => 'INT',
                    'constraint' => 30,
                ),
                'bid_value_gap' => array(
                    'type' => 'INT',
                    'constraint' => 4,
                ),
                'hold_bidding_until_approval' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'allow_approvedbidder_tobid' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'allow_multiple_bidding' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'hide_useremail' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'sale_commission' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'processing_fee' => array(
                    'type' => 'FLOAT'
                ),
                'mark_as_completed' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'image_thumbnails' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'office_add1' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'office_add2' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'office_tel' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'office_email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'google_analytics' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'email_notifications' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'active_domain_verification' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'google_api_key' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'active_domain_screenshots' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'active_app_verification' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'footer_credits' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'escrow_direct_accept_agree' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'escrow_run_as_broker' => array(
                    'type' => 'INT',
                    'constraint' => 2,
                ),
                'mailchimp_apikey' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'mailchimp_listing_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'enable_user_selling' => array(
                    'type' => 'INT',
                    'constraint' => 2
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_settings',TRUE);

            $settings = array(
                array('id'=>'1','user_email_activation'=>1,'admin_email'=>"",'admin_email_copy'=>'1','json_key_file'=>'1','title'=>'slippa','site_meta_keywords'=>'1','site_meta_description'=>'1','ssl_enable'=>0,'user_facebook'=>0,'user_twitter'=>0,'user_Instagram'=>0,'user_github'=>0,'user_google'=>0,'user_youtube'=>0,'blacklisted_domains'=>'["google.com"]','commission_based'=>0,'withdrawal_options'=>'["Paypal","Payoneer","Escrow","Wire"]','default_currency'=>'USD','show_expired_records'=>0,'activate_one_listing_per_domain'=>0,'monetization_methods'=>'{"0":{"name":"ad sense","value":"ads"},"1":{"name":"subscriptions","value":"subscribe"}}','auction_period'=>14,'bid_value_gap'=>50,'hold_bidding_until_approval'=>1,'allow_approvedbidder_tobid'=>1,'allow_multiple_bidding'=>1,'hide_useremail'=>0,'sale_commission'=>20,'processing_fee'=>2,'mark_as_completed'=>3,'image_thumbnails'=>0,'office_add1'=>'76 Vincent Square, Westminster, London SW1P 2PD','office_add2'=>'United Kingdom','office_tel'=>'+44 20 3878 3955','office_email'=>'support@onlinetoolhub.com','google_analytics'=>'1','email_notifications'=>1,'active_domain_verification'=>0,'google_api_key'=>'2','active_domain_screenshots'=>0,'active_app_verification'=>1,'footer_credits'=>0,'escrow_direct_accept_agree'=>0,'escrow_run_as_broker'=>0,'mailchimp_apikey'=>'1','mailchimp_listing_id'=>1,'enable_user_selling'=>1)
            );

            $this->db->insert_batch('tbl_settings', $settings);

            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'sitelogo' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'favicon' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'homepage' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'mainback' => array(
                   'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'invoice_logo' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'loader' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'backgrounds' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_siteimages',TRUE);  

            $images = array(
                array('id'=>'1','sitelogo'=>'Logo_-small.png','favicon'=>"Thumbnail.png",'homepage'=>'breadcump-img-red-dark.png','mainback'=>'bn2.jpg','invoice_logo'=>'Logo-color.png','loader'=>'loadingimage.gif','backgrounds'=>'breadcump-img-red-dark-2.png')
            );

            $this->db->insert_batch('tbl_siteimages', $images);

            $this->dbforge->add_field(array(
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'username' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                    'unique'=>TRUE
                ),
                'firstname' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'lastname' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'email' => array(
                   'type' => 'VARCHAR',
                    'constraint' => 250,
                    'unique'=>TRUE
                ),
                'thumbnail' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'cover_pic' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_country' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_review' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'password' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'user_membership_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_membership_timestamp' => array(
                    'type' => 'DATETIME'
                ),
                'user_membership_timestamp_expiry' => array(
                    'type' => 'DATETIME'
                ),
                'user_ip' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'user_status' => array(
                    'type' => 'INT',
                    'constraint' => 4
                ),
                'date datetime default current_timestamp',
                'hour_started' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'token' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'user_level' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'social_twitter' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'social_github' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'social_facebook' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'social_youtube' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_metadescription' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_description' => array(
                    'type' => 'TEXT',
                    'NULL' => FALSE,
                ),
                'online' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'paypal' => array(
                    'type' => 'TEXT',
                    'NULL' => TRUE,
                ),
                'payoneer' => array(
                    'type' => 'TEXT',
                    'NULL' => TRUE,
                ),
                'bank_transfer' => array(
                    'type' => 'TEXT',
                    'NULL' => TRUE,
                ),
                'escrow_email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                )

            ));

            $this->dbforge->add_key('user_id', TRUE);
            $this->dbforge->create_table('tbl_users',TRUE);

            $user = array(
                array('user_id'=>'1','username'=>'Logo_-small.png','firstname'=>"Thumbnail.png",'lastname'=>'','email'=>'','thumbnail'=>'','cover_pic'=>'','user_country'=>'','user_review'=>'','password'=>"",'user_membership_id'=>'','user_membership_timestamp'=>date('Y-m-d H:i:s'),'user_membership_timestamp_expiry'=>date('Y-m-d H:i:s'),'user_ip'=>'','user_status'=>2,'hour_started'=>0,'token'=>'','user_level'=>0)
            );

            $this->db->insert_batch('tbl_users', $user);


            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'user_ip' => array(
                    'type' =>'TEXT',
                    'NULL' => FALSE,
                ),
                'count' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'datetime' => array(
                    'type' => 'DATETIME'
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 2
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_user_ip',TRUE); 


            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'withdrawal_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                ),
                'created_date datetime default current_timestamp',
                'updated' => array(
                    'type' => 'DATETIME'
                ),
                'amount' => array(
                    'type' =>'FLOAT'
                ),
                'fee' => array(
                    'type' =>'FLOAT'
                ),
                'final_amount' => array(
                    'type' =>'FLOAT'
                ),
                'method' => array(
                    'type' => 'INT',
                    'constraint' => 5
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 4
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_withdrawals',TRUE);   


            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'method' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                ),
                'threshold' => array(
                    'type' =>'FLOAT'
                ),
                'fee' => array(
                    'type' =>'FLOAT'
                ),
                'cal_meth' => array(
                    'type' => 'INT',
                    'constraint' => 5
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 4
                )
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tbl_withdrawal_methods',TRUE);   

        }

        public function down()
        {
            $this->dbforge->drop_table('tbl_ads');
            $this->dbforge->drop_table('tbl_announcement');
            $this->dbforge->drop_table('tbl_bids');
            $this->dbforge->drop_table('tbl_blog');
            $this->dbforge->drop_table('tbl_categories');
            $this->dbforge->drop_table('tbl_comments');
            $this->dbforge->drop_table('tbl_contracts');
            $this->dbforge->drop_table('tbl_coupons');
            $this->dbforge->drop_table('tbl_cron');
            $this->dbforge->drop_table('tbl_currencies');
            $this->dbforge->drop_table('tbl_disputes');
            $this->dbforge->drop_table('tbl_domains');
            $this->dbforge->drop_table('tbl_domain_purchases');
            $this->dbforge->drop_table('tbl_email_settings');
            $this->dbforge->drop_table('tbl_history');
            $this->dbforge->drop_table('tbl_homepage_setup');
            $this->dbforge->drop_table('tbl_invoices');
            $this->dbforge->drop_table('tbl_languages');
            $this->dbforge->drop_table('tbl_lastseen');
            $this->dbforge->drop_table('tbl_listings');
            $this->dbforge->drop_table('tbl_listing_header');
            $this->dbforge->drop_table('tbl_message');
            $this->dbforge->drop_table('tbl_months');
            $this->dbforge->drop_table('tbl_notifications');
            $this->dbforge->drop_table('tbl_offers');
            $this->dbforge->drop_table('tbl_opens');
            $this->dbforge->drop_table('tbl_pages');
            $this->dbforge->drop_table('tbl_payments');
            $this->dbforge->drop_table('tbl_payment_settings');
            $this->dbforge->drop_table('tbl_platforms');
            $this->dbforge->drop_table('tbl_platform_list');
            $this->dbforge->drop_table('tbl_purchases');
            $this->dbforge->drop_table('tbl_reports');
            $this->dbforge->drop_table('tbl_reviews');
            $this->dbforge->drop_table('tbl_settings');
            $this->dbforge->drop_table('tbl_siteimages');
            $this->dbforge->drop_table('tbl_users');
            $this->dbforge->drop_table('tbl_user_ip');
            $this->dbforge->drop_table('tbl_withdrawals');
            $this->dbforge->drop_table('tbl_withdrawal_methods');
        }
    }