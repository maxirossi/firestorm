<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// -----------------------------------------------------------------------

if ( ! function_exists('idfromtoken'))
{
	
	function idfromtoken($str){
		
    	// el primer parametro deberia ser el id
    	$str=explode("-",$str)
    	return($str[0]);
}

