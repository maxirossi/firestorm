<?php

define('TABLE','content');
define('ITEMS','dependencies');
define('MODULENAME','dependencies');

$fields = array(
	'title' => array(
		'name' => 'title',
		'label' => 'Title',
		'type' => 'input'
	),
	'category' => array(
		'name' => 'category',
		'label' => 'Category',
		'type' => 'select',
		// config data origin select/combo -->
		'table' => 'content',
		'field' => 'title',
		'where' => 'where moduleID = 4',
		'order' => 'title'
	),
	'description' => array(
		'name' => 'description',
		'position' => 'Description',
		'type' => 'textarea'
	),
	'url' => array(
		'name' => 'url',
		'label' => 'Url',
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