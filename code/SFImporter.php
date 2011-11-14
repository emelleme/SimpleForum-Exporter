<?php

class SFImporter_Controller extends Controller {
	private $sfdatabaseconfig = array(
	"server" => 'localhost',
	"username" => 'root',
	"password" => 'dev-toby',
	"database" => 'sftest'
	);
	
	private $tables = array(
	"wp_sfdefpermissions","wp_sfforums","wp_sfgroups", "wp_sflinks","wp_sflog","wp_sfmembers","wp_sfmemberships","wp_sfmessages","wp_sfmeta","wp_sfnotice","wp_sfoptions","wp_sfpermissions","wp_sfpostratings","wp_sfposts","wp_sfroles","wp_sfsettings","wp_sftagmeta","wp_sftags","wp_sftopics","wp_sftrack","wp_sfusergroups","wp_sfwaiting"
	);
	
    public function index($arguments) {
    	global $databaseConfig,$sfdatabaseConfig;
    	$a = $this->tables;
    	//$$a="test";
		DB::connect($sfdatabaseConfig);
		$t = new DataObjectSet();
		
		//Get the data
		foreach($a as $b){
			$entries = '';
			//var_dump($$b);
			$$b = $this->getData($b);
		}
		
    	//var_dump($t);
    	//exit;
    	//Connect to simpleforum database
    	header('Content-Type: text/xml;encoding=utf-8');
    	$data = array();
    	foreach($a as $c){
    	$data[$c] = $$c;
    	}
        return $this->customise($data)->renderWith('SFImporter');
    }
    
    public function getData($tablename){
    	$b = $tablename;
    	//foreach($a as $b){
			//$$b = new DataObjectSet();
			$query = new SQLQuery("*", $b);
			$result = $query->execute();
			$entries = new DataObjectSet();
			foreach($result as $row) {
				$xml ='';
				$columns = array_keys($row);
				foreach($columns as $key=>$column){
					if($column == 'post_content' || $column == 'option_value'){
						$xml .= "<".$column."><![CDATA[\n".htmlentities(urlencode($row[$column]))."\n]]></".$column.">";
					$xml .= "\n";
					
					}else{
					$xml .= "<".$column.">".$row[$column]."</".$column.">";
					$xml .= "\n";
					}
				}
				//Push The XML onto the stack as an entry
			  	//var_dump($xml);
			  	$entry = array(
			  		"Entries" => $xml
			  	);
			  	$entries->push(new ArrayData($entry));
			//}
			}
			//Render Template
			return $entries;
    }
}
