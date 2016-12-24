<?php

function returnModules()
{

	$arrModulesID = array(
		"0" => array(
			"id" => 1,
			"name" => "sections",
			"icon" => "fa fa-list-alt"
		),
		"1" => array(
			"id" => 2,
			"name" => "blog",
			"icon" => "fa fa-list-alt"
		),
		"2" => array(
			"id" => 3,
			"name" => "dependencies",
			"icon" => "fa fa-list-alt"
		),
		"3" => array(
			"id" => 4,
			"name" => "categories",
			"icon" => "fa fa-list-alt"
		),
		"4" => array(
			"id" => 5,
			"name" => "texts",
			"icon" => "fa fa-list-alt"
		)
	);

    return $arrModulesID;
}


