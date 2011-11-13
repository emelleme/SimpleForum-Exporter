<?php

class SFImporter_Controller extends Controller {
	private $sfdatabaseconfig = array(
	"server" => 'localhost',
	"username" => 'root',
	"password" => 'dev-toby',
	"database" => 'sftest'
	);
    public function index($arguments) {
    
    	global $databaseConfig,$sfdatabaseConfig;
    	
		DB::connect($sfdatabaseConfig);
		$query = new SQLQuery("*", "wp_sftags");
    	$result = $query->execute();
    	//var_dump($result);
    	//exit;
    	//Connect to simpleforum database
    	header('Content-Type: text/xml;encoding=utf-8');
        return $this->renderWith('SFImporter');
    }
}
