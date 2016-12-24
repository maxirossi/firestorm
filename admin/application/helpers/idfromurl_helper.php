<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// -----------------------------------------------------------------------

if ( ! function_exists('idfromurl'))
{
	
	function idfromurl(){
		$url = current_url();
		$url = explode("/", $url);
		$key = array_search($slug, $url);
		if ($key > 0){
			$key++;
			return($url[$key]);
		}else{
			return(false);
		}
		return($id);
	}
}
