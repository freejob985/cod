<?php defined('BASEPATH') OR exit('No direct script access allowed');

include("./vendor/autoload.php"); 

class Operations {

	protected $CI = null;
	protected $version     = '2.8';

    /**
     * Extended detection type.
     *
     * @deprecated since version 2.6
     */
    protected $SERVER_URL   = 'http://onlinetoolhub.com/licence';

    /**
     * A frequently used regular expression to extract version #s.
     *
     * since version 2.6
     */
    protected $PASS_CODE = "";

    public function __construct($test_mode = true){
		$this->CI =& get_instance();
	}

    public function scriptVersion()
	{
		return $this->version;
	}
}