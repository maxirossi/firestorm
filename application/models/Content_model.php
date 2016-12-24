<?php
class Content_Model extends CI_Model 
{

	public $table;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('files_model','files');
		$this->table = 'content';
	}

	
	public function getIDmenu($name , $moduleID = 9)
	{

		$qry = 'SELECT id FROM content WHERE moduleID=' . $moduleID . ' AND name LIKE \'' . $name . '%\'';
		$query = $this->db->query($qry);
		
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row){
		      $id = $row->id;
		   }

		   return($this->getSections($id));

		} else{
			return false; 
		}
			
	}

	public function getSections($moduleID = 3, $search = false,  $appPublic = "", $idsupercat = 0, $order = '')
	{

		$qry='SELECT id,name FROM ' . $this->table . ' WHERE moduleID=' . $moduleID . ' AND status=1 ' . $order ;
		
		if ($idsupercat){
			$qry .= ' AND supercat_id = ' . $idsupercat;
		}

		$query = $this->db->query($qry);
		$data = array(); 

		if ($query->num_rows() > 0) {
		$data['n'] = $query->num_rows();
		   foreach ($query->result() as $row)
		   {
		     $data['id'][] = $row->id;
		     $data['name'][] = $row->name;
		   
		     if ($idsupercat){
 				$data['url'][] = strtolower($appPublic . "show/" . url_title($row->name) . "/" . $row->id . "/");
		     }else{
		     	$data['url'][] = strtolower($appPublic . "show/" . url_title($row->name) . "/" . $row->id);
		     }
		   }
		   return $data;
		} else{
			return false;
		}

	}

	public function getSection($id)
	{
		 $this->db->select('id,name,title,subtitle,description');
		 $this->db->from($this->table);
		 $this->db->where(array("id" => $id, "status" => 1));
		 $query = $this->db->get();

		 if ($query->num_rows() > 0){

		   foreach ($query->result() as $row){
		   	 $data['name'] = $row->name;
		   	 $data['title'] = $row->title;
		   	 $data['subtitle'] = $row->subtitle;
		   	 $data['url'] = url_title($row->name) . "/" . $row->id  . "/";
		   	 $data['description'] = $row->description;
		   }

		   $img = $this->files->getItemFiles($id, 15);
		   $data['img'] = $img;
		   return $data;
		} else{
			return false;
		}

	}

	public function getShow($id, $moduleID, $table = 'content')
	{

		$this->db->select('id,name,title,summary,description');
		$this->db->from($table);
		if ($moduleID){
			$this->db->where(array("id" => $id, "status" => 1));
		}else{
			$this->db->where(array("id" => $id, "status" => 1));
		}
	
		$query = $this->db->get();

		if ($query->num_rows() > 0){

		   foreach ($query->result() as $row){

		   	 if ($row->title){
		   	 	$data['title'] = $row->title;
		   	 }else{
		   	 	$data['name'] = $row->name;
		   	 }

		   	 $data['summary'] = $row->summary;
		   	 $data['url'] = url_title($row->name) . "/" . $row->id  . "/";
		   	 $data['description'] = $row->description;
		   	 $img = $this->files->getItemFiles($id, 15);
		 	 $data['img'] = $img;

		   	 $image = $this->files->getItemFiles($row->id, 15, $moduleID, 0);
		
		   	 if ($image['status']){
		   	 /* gallery */
		   	 $html = '<div class="sp-wrap galeria-ampliar">';
		   	 $c = 0;
             foreach($imagen['name']  as $i=>$v){

                  $imgName = $imagen['name'][$c];
                  $imgSmall = $this->config->item('appUploads') . $moduloID . '/small-' .  $imgName;
                  $imgBig = $this->config->item('appUploads') . $moduloID . '/ampliar-' .  $imgName;
                  $file_headers = @get_headers($imgBig);

                  if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
                     $imgBig = $this->config->item('appUploads') . $moduleID. '/big-' .  $imgName;
                     $file_headers = @get_headers($imgBig);
                       if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
                           $imgBig = $imgSmall;
                       } 
                  }
                  $html .= '<a href="' . $imgBig . '"><img src="' . $imgSmall . '" alt=""></a>';
                  $c++;
              }
	              $html.= '</div>';
			   	 /* . gallery */
			   	 $data['gallery'] = true;
			   	 $data['galleryHTML'] = $html;
		   	 }else{
		   	 	$data['gallery'] = false;
		   	 }
		   	 
		   }
		   
		   return($data);
		} else{
			return(0); // :v
		}

	}

	function getData($module_id, $fields ,$condition = "" ,$order = "", $table = "")
	{

		if (!$table){
			$table = $this->table;
		}

		if ($condition){
			$strCondition=",";
			foreach($condition as $i=>$v){
				$strCondition.= $i .  "=>" . $v;
			}

		}else{
			$strCondition = "";
		}
		
		$this->db->select($fields);
		$this->db->from($table);

		if (!empty($condition['id']) && is_numeric($condition['id'])){
			$this->db->where(array("id" => $condition['id'], "status" => 1));
		}else{
			$this->db->where(array("moduleID" => $moduleID . $strCondition));
		}

		$this->db->order_by($order); 
		$query = $this->db->get();

		 if ($query->num_rows() > 0){
		 $data = array();
		 $data['n'] = $query->num_rows();
		 foreach ($query->result() as $row){
		 	
		 	$data[] = $row;

			if (!empty($condicion['exclude']) && is_numeric($condicion['exclude'])){
				if ($row->id != $condicion['exclude']){
			   		$data['img'][] = $this->files->getItemFiles($row->id, 100, $module_id);
				}
			}else{
				if(!empty($row->id)){
					$data['img'][] = $this->files->getItemFiles($row->id, 100, $module_id);
				}
			}
			
		   }
		   return $data;
		} else{
			return 0;
		}
	}

	function getText($slug, $moduleID=5, $fields="name,description", $condition ="", $table="")
	{

		if (!$table){
			$table=$this->table;
		}

        $condition['name'] = $slug;
        $condicion['moduleID'] = $moduleID;
        $condicion['status'] = 1;
        
		$this->db->select($fields);
		$this->db->from($this->table);
		$this->db->where($condition);
		$query = $this->db->get();

		 if ($query->num_rows() > 0){

		 $data = array();
		   foreach ($query->result() as $row){
		   	 	$data = $row;
		   }
		   return $data;
		} else{
			return 0; 
		}
	}
	
	public function getTexts()
	{

		$response = array();
		$data = array();
		
		$qry = "SELECT id,title,description FROM content WHERE moduleID='5' AND status='1'";

		$this->db->trans_start();
		$query = $this->db->query($qry);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			// someError here
			$response['status'] = 1;
			$response['sql'] = $qry;
			$response['message'] = 'Error getTexts.';
		}else{
			// success
			foreach ($query->result() as $i=>$v){
				$response['data']['name'][] =  $v->title;
				$response['data']['description'][] =  $v->description;
			}

			$response['status'] = 1;

		}

		return $response;
	}
	
	public function getPosts(){

		$response = array();
		$qry = "SELECT id,title,summary FROM posts WHERE moduleID='2' AND status='1'";

		$query = $this->db->query($qry);

		if ($query->num_rows() > 0){
			foreach ($query->result() as $i=>$row){
				$response[$i]['id'] = $row->id;
		   	 	$response[$i]['title'] = $row->title;
		   	 	$response[$i]['summary'] = $row->summary;
		   	 	$response[$i]['url'] = strtolower($this->config->item('appUrlInit') . "post/" . url_title($row->title) . "/" . $row->id);
		   }
		   $response['success'] = true;
		}else{
		   $response['success'] = false;
		}

		return $response;
	}

	public function getItems($idCat, $moduleID)
	{
		$response = array();
		$qry = "SELECT id,title,description,url FROM content WHERE moduleID=$moduleID AND category=$idCat AND status=1 ORDER BY position ASC";
		$query = $this->db->query($qry);

		if ($query->num_rows() > 0){
			foreach ($query->result() as $i=>$row){
				$response[$i]['id'] = $row->id;
		   	 	$response[$i]['title'] = $row->title;
		   	 	$response[$i]['description'] = $row->description;
		   	 	$response[$i]['url'] = $row->url;
		   }
		   $response['success'] = true;
		}else{
		   $response['success'] = false;
		}

		return $response;
	}
}
