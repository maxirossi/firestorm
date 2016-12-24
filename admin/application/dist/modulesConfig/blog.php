<?php

define('TABLE','posts');
define('ITEMS','posts');
define('MODULENAME','blog');

$fields = array(
	'title' => array(
		'name' => 'title',
		'label' => 'Title',
		'type' => 'input',
		'required' => true
	),
	'summary' => array(
		'name' => 'summary',
		'label' => 'Summary',
		'type' => 'textarea'
	),
	'position' => array(
		'name' => 'description',
		'description' => 'Description',
		'type' => 'textarea'
	),
	'description' => array(
		'name' => 'position',
		'position' => 'Position',
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