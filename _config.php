<?php

//Configuration Here

/* URL Rules for Map View */
Director::addRules(50, array('sfxml/$Action/$ID' => 'SFImporter_Controller'));

global $sfdatabaseConfig;

/* Set the Database information for the SimpleForum Database */
$sfdatabaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'root',
	"password" => '',
	"database" => 'sftest'
);
Director::set_environment_type("dev");
