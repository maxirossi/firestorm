<?php

define('TABLE','content');
define('ITEMS','sections');
define('MODULENAME','section');

$fields = array(
	'name' => array(
		'name' => 'name',
		'label' => 'Name',
		'type' => 'input',
		'required' => true
	),
	'title' => array(
		'name' => 'title',
		'label' => 'Title',
		'type' => 'input',
		'required' => true
	),
	'subtitle' => array(
		'name' => 'subtitle',
		'label' => 'Subtitle',
		'type' => 'input',
		'required' => true
	),
	'position' => array(
		'name' => 'position',
		'label' => 'Order',
		'type' => 'number'
	),
	'description' => array(
		'name' => 'description',
		'label' => 'Description',
		'type' => 'textarea'
	),
	'status' => array(
		'name' => 'status',
		'label' => 'Active',
		'type' => 'select_flag'
	),
	'menu' => array(
		'name' => 'menu',
		'label' => 'Show in menu?',
		'type' => 'select_flag'
	)

);

$moduleConfig['lFields'] = array ("id", "name", "position");
$moduleConfig['oFields'] = array ("id" , "asc", array_search("id", $moduleConfig['lFields']));

include_once('application/dist/includes/generalFunctions.php');