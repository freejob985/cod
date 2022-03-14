<?php defined('BASEPATH') OR exit('No direct script access allowed');

include("./vendor/autoload.php"); 

use Spatie\Dns\Dns;

class Dns_Verifier{

	private function getTxtRecordValues($url)
    {
        $dns = new Dns($url);
        $txtRecords = $dns->getRecords('TXT');

        if (preg_match_all('/"([^"]+)"/', $txtRecords, $m)) {
            return $m[1];
        }

        return [];
    }

    public function dnsCheck($url, $token)
    {
        $txtRecordValues 	= $this->getTxtRecordValues($url);
        $verificationValue 	= trim($token);

        return in_array($verificationValue, $txtRecordValues);
    }
}