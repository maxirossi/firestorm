<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// -----------------------------------------------------------------------

if ( ! function_exists('loadmodules'))
{
	
	function loadmodules($route, $onlyID = true){

		include_once('application/dist/includes/modulesID.php');
		
		$modules = returnModules();
		
		if ($onlyID){

		$data = array();

			$c = 0;
			foreach($modules as $i=>$v){
				$module_id = $v['id'];
				if ($c > 0){
					$data[$module_id] = $v['name'];
				}
			$c++;
			}
		
		return $data;		
		}
		
		return $modules;
	}
}
