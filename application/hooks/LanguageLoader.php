<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LanguageLoader
{
   function initialize() 
   {
      $default_language = $this->getDefaultLanguage()[0]['language'];
      $ci =& get_instance();
      $ci->load->helper('language');
      $siteLang = $ci->session->userdata('site_lang');
      if ($siteLang) 
      {
         $ci->lang->load(array('information','email', 'updatethree','updatefour','analytics'),$siteLang);
      } 
      else 
      {
        if($default_language!='english' && !empty($default_language) )
        {
          $ci->lang->load(array('information','email', 'updatethree','updatefour','analytics'),$default_language);
        }
        else
        {
          $ci->lang->load(array('information','email', 'updatethree','updatefour','analytics'),'english');
        }
      }
   }

   public function getDefaultLanguage() 
   {
      $ci = &get_instance();
      $ci->load->model('DatabaseOperationsHandler');
      return  $ci->DatabaseOperationsHandler->GetDefaultLanguage();
   }
}

?>