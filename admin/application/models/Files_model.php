<?php
class Files_Model extends CI_Model 
{

	public $table;
	public $module_id;

	function __construct(){

		parent::__construct();
		$this->load->database();
				
		/* cargamos los helpers */
		$this->load->helper('objecttoarray');
		/* end of helpers */
	}

	public function saveImage($item_id, $module_id, $name, $type, $size)
	{

		$response = array();
		$qry = "INSERT INTO files (item_id, moduleID, title, type, size, last_mod) VALUES (";
		$qry.= "'$item_id','$module_id', '$name','$type','$size',now())";

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
		}

		$response = json_encode($response);
		return $response;
	}

	public function getImages($item_id, $module_id)
	{

		$response = array();
		$data = array();

		$qry = "SELECT id,title,position,moduleID FROM files WHERE item_id='$item_id' AND moduleID='$module_id' ORDER BY position ASC";

		$this->db->trans_start();
		$query = $this->db->query($qry);
		$this->db->trans_complete();

		if ($this->db->trans_status() === false){
			// someError here
			$response['status'] = 1;
			$response['sql'] = $qry;
			$response['message'] = 'Error getting images.';
		}else{
			// success
			foreach ($query->result() as $row){
				foreach($row as $i=>$v){
					$data[$i][] = $row->$i;
				}
			}
			$response['status'] = 1;
			$response['data'] = $data;
		}

		return $response;
	}

	public function deleteImage($id, $module_id)
	{

		$response = array();

		$qry = "DELETE FROM files WHERE id='$id' AND moduleID='$module_id'";
	
		$this->db->trans_start();
		$query = $this->db->query($qry);
		$this->db->trans_complete();

		if ($this->db->trans_status() === false){
			// someError here
			$response['status'] = 0;
			$response['sql'] = $qry;
			$response['message'] = 'Error deletting image.';
		}else{
			$response['status'] = 1;
			$response['message'] = 'Success';
		}

		return $response;
	}

	public function orderImages($id)
	{

		$id = explode(",", $id);

		foreach($id as $i=>$v){

			$qry = "UPDATE files SET position = '$i' WHERE id='$v'";
			$this->db->trans_start();
			$query = $this->db->query($qry);
			$this->db->trans_complete();

			if ($this->db->trans_status() === false){
				// someError here
				$response['status'] = 0;
				$response['sql'] = $qry;
				$response['message'] = 'Error ordering images.';
				return $response;
			}
		}

		$response['status'] = 1;
		$response['message'] = 'Success';
		
		return $response;
	}

}
