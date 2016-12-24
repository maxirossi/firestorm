<?php

// some functions and code config for modulesConfig

/* setting $arrFields for modules */
$arrFields = array();
$c = 1;

foreach($fields as $i=>$v){
	$arrFields[$c][0] = $v['name'];
	$arrFields[$c][1] = $v['type'];
	$arrFields[$c][2] = $v;
	$c++;
}
/* .settings */


/* Panels  */
$panels[0]['label']= 'Content'; 
$panelsConfig['main'] = $panels[0]['label']; 
/* .Panels */
