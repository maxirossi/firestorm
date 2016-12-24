<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// -----------------------------------------------------------------------

if ( ! function_exists('ipuser'))
{
	
	function ipuser(){
		
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
}
 

}
