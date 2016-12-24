<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// -----------------------------------------------------------------------

if ( ! function_exists('islogin'))
{
	
	function islogin(){

		 $CI =& get_instance();
   		 $is_logged_in = $CI->session->userdata('loginAdmin');

		 if(!isset($is_logged_in) || $is_logged_in != true){
		     return(0);
		 }else{
		 	return(1);
		 }


	}
 

}
