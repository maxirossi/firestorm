<?php

define('TABLE','content');
define('ITEMS','texts');
define('MODULENAME','texts');

$fields = array(
	'title' => array(
		'name' => 'title',
		'label' => 'Title',
		'type' => 'input'
	),
	'description' => array(
		'name' => 'description',
		'label' => 'Description',
		'type' => 'textarea'
	),
	'position' => array(
		'name' => 'position',
		'label' => 'Order',
		'type' => 'number'
	),
	'status' => array(
		'name' => 'status',
		'label' => 'Active',
		'type' => 'select_flag'
	)
);

$moduleConfig['lFields'] = array ("id", "title", "description");
$moduleConfig['oFields'] = array ("id" , "asc", array_search("id", $moduleConfig['lFields']));

include_once('application/dist/includes/generalFunctions.php');