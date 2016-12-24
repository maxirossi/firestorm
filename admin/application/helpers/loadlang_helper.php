<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// -----------------------------------------------------------------------

if ( ! function_exists('loadlang'))
{
	
	function loadlang(){
		$CI =& get_instance();
		$lang = $CI->config->item('appLang') . '.php';
		include_once('application/dist/lang/' . $lang);
		return $langText;
	}
}
