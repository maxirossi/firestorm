<?php
class Users_Model extends CI_Model
{

	public $table;
	public $module_id;

	function __construct(){

		// Llamar al constructor de CI_Model
		parent::__construct();
		$this->load->database();
		$this->table = 'admin';
		
		/* cargamos los helpers */
		$this->load->helper('objecttoarray');
		/* end of helpers */

		$this->load->library('session');
	}

	
	function login($user, $pass)
	{

		$qry="SELECT id FROM admin WHERE user='"  . $user . "' AND password='" . $pass  ."' AND permissions=1";
		
		$query=$this->db->query($qry);

		if ($this->db->affected_rows() > 0){

			foreach ($query->result() as $row){
			     $data[]=$row;
			 }

			$arrData = objectToArray($data);
		
			return($arrData[0]['id']);
		}else{
			return(0);
		}
	}
}
