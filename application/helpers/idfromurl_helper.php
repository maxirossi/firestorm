<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// -----------------------------------------------------------------------

if ( ! function_exists('idfromurl'))
{
	
	function idfromurl(){
		$url = current_url();
		$url = explode("/",$url);
		$l = count($url);
		$slug = $url[$l-2]; // change from your url
		$id = array_pop($url);
		$data = array();
		$data['id'] = $id;
		$data['slug'] = strtolower($slug);
		return($data);
	}
}
