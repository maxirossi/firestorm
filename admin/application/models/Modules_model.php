<?php
class Modules_Model extends CI_Model 
{

	public $table;
	public $module_id;

	function __construct(){

		parent::__construct();
		$this->load->database();
				
		/* cargamos los helpers */
		$this->load->helper('objecttoarray');
		/* end of helpers */

		$this->load->library('session');
	}

	public function getDefaultOptions($module_name)
	{

	if ($module_name){

		// search for configModule options in db (no defaults)
		$qry = "SELECT * FROM modulesConfig WHERE module_name='$module_name'";
		$query = $this->db->query($qry);

		if (!$this->db->affected_rows() > 0){
			$qry = "SELECT * from defaultModulesConfig";
		}

		$query = $this->db->query($qry);

		if ($this->db->affected_rows() > 0){

			foreach ($query->result() as $row){
			    foreach($row as $i=>$v){
				    switch ($i){
					case "OpcSort":
						$i='sort';
					break;
					
					case "OpcImagenes":
						$i="imagenes";
					break;
					
					case "OpcAudios":
						$i="audios";
					break;
					
					case "OpcVideos":
						$i="videos";
					break;
					
					
					case "lFields":
					
					$v=trim($v);
					
						// convertimos en array la variable
						if (!strpos($v,",")){
								$valor=$v;
								$v=array();
								$v[0]=$valor;
							}else{
								$v=str_replace(" ","",$v);
								$v=explode(",",$v);
							}
						
					break;
					
					case "oFields":
					
					$v=trim($v);
					
						if ($v){
							
							if (!strpos($v,",")){
								$valor=$v;
								$v=array();
								$v[0]=$valor;
							}else{
								$v=str_replace(" ","",$v);
								$v=explode(",",$v);
							}
							
							
						}else{
							$v[0]="";
						}
					break;
					
					
					default:
						
					break;
				}
				$modulesConfig[$i] = $v;
			}
		}
		}
		}

	return($modulesConfig);

	}

	public function listModule($fields, $table, $moduleID, $order)
	{

		$data = array();

		$qry = "SELECT $fields  FROM $table WHERE moduleID=$moduleID  ORDER BY " . $order . " LIMIT 0,2000";
		
		$query = $this->db->query($qry);

		if ($this->db->affected_rows() > 0){

		$data['status'] = 1;
		$c = 0;
			foreach ($query->result() as $row){
				foreach($row as $i=>$v){
					$data[$c][$i] = substr($v, 0, 400);
				}
				$c++;
			}
		$data['nRows'] = $this->db->affected_rows();
		}else{
			$data['status'] = 0;
			$data['nRows'] = 0;
		}

		return($data);
	}

	public function delete($id, $table)
	{

		$qry = "DELETE FROM $table WHERE id=$id";
		$query = $this->db->query($qry);

		$data = array();

		if ($this->db->affected_rows() > 0){
			$data['status'] = 1;
		}else{
			$data['status'] = 0;
		}

		return($data);
	}

	public function getData($id, $table)
	{

		$qry = "SELECT * FROM $table WHERE id=$id";
		
		$query = $this->db->query($qry);

		if ($this->db->affected_rows() > 0){
			foreach ($query->result() as $row){
				foreach($row as $i=>$v){
					$data[$i] = $v;
				}
			}
			
			$data['qStatus'] = 1;

		}else{
			$data['qStatus'] = 0;
		}

		return($data);
	}

	public function getDataCombo($table, $where, $order)
	{

		$qry = "SELECT * FROM ".$table." ".$where." ORDER BY ".$order;
		
		$query = $this->db->query($qry);

		if ($this->db->affected_rows() > 0){
			foreach ($query->result() as $row){
				$data[] = $row;
			}
			
			$data['status'] = 1;

		}else{
			$data['status'] = 0;
		}

		return($data);
	}


	public function edit($id, $table, $module, $data)
	{
		
		$response = array();
		$qry = "UPDATE $table SET";

		foreach($data as $i=>$v){
			$v = str_replace("'","",$v);
			$qry.= " $i='$v',";
		}

		$qry = substr($qry, 0, -1);

		$qry.= " WHERE id='$id';";
		$this->db->trans_start();
		$query = $this->db->query($qry);
		$this->db->trans_complete();

		if ($this->db->trans_status() === false){
			// someError here
			$response['status'] = 1;
			$response['sql'] = $qry;
			$response['message'] = 'Error in edit data.';
		}else{
			// success
			$response['status'] = 1;
		}

		return($response);

	}

	public function add($table, $module, $data)
	{
		
		$response = array();
		$qry = "INSERT INTO $table ("; 

		foreach($data as $i=>$v){
			$qry.= " $i,";
		}

		$qry = substr($qry, 0, -1);
		$qry.= ") ";

		$qry.= " VALUES ( ";

		foreach($data as $i=>$v){
			$v = str_replace("'","",$v);
			$qry.= "'$v',";
		}	

		$qry = substr($qry, 0, -1);
		$qry.= ");";
		
		$this->db->trans_start();
		$query = $this->db->query($qry);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			// someError here
			$response['status'] = 1;
			$response['sql'] = $qry;
			$response['message'] = 'Error in edit data.';
		}else{
			// success
			$response['status'] = 1;
			// get last id
			$qry = "SELECT id FROM $table  ORDER BY id DESC LIMIT 0,1";
			$query = $this->db->query($qry);
			if ($this->db->affected_rows() > 0){
				foreach ($query->result() as $i=>$v){
					$response['id'] =  $v->id;
				}
			}
		}

		return($response);

	}

}
