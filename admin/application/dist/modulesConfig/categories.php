<?php

define('TABLE','content');
define('ITEMS','categories');
define('MODULENAME','categories');

$fields = array(
	'title' => array(
		'name' => 'title',
		'label' => 'Title',
		'type' => 'input'
	),
	'position' => array(
		'name' => 'position',
		'label' => 'Position',
		'type' => 'number'
	),
	'status' => array(
		'name' => 'status',
		'label' => 'Active',
		'type' => 'select_flag'
	)
);

$moduleConfig['lFields'] = array ("id", "title", "position");
$moduleConfig['oFields'] = array ("id" , "asc", array_search("id", $moduleConfig['lFields']));

include_once('application/dist/includes/generalFunctions.php');