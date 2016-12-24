<?php
class Files_Model extends CI_Model 
{

	public $table;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->table = 'files';
	}

	function getItemFiles($itemId, $limit = 1, $table = 0 , $clearFirst = false)
	{

	$return = "";

	if (!$itemId){
		$r['status'] = false;
		return $r;
	}
	
	if (!$table){
		$qry="SELECT title,name,moduleID FROM files WHERE item_id=$itemId ORDER BY position ASC LIMIT 0,$limit";
	}else{
		$qry="SELECT title,name,moduleID FROM files WHERE item_id=$itemId AND moduleID=$table ORDER BY position ASC LIMIT 0,$limit";
	}
	
	$query = $this->db->query($qry);
	
	$c = 1;

	foreach ($query->result() as $row){

	if ($clearFirst && $itemId <> 1){ // bug para la home (id=1)
		
		if ($c==1){
			
		}else{
			$retorno['name'][] = $row->title;
			$retorno['module'][] = $row->moduleID;
		}
		
	}else{
			$retorno['name'][] = $row->title;
			$retorno['module'][] = $row->moduleID;
	}
	
	$c++;
	}
	
	if ($return){
		$return['status'] = true;
		$return['nImages'] = $c-1;
	}else{
		$retorno['status'] = false;
	}
	
	return($retorno);
}

	function getGallery($section, $moduleID = 120, $first =false)
	{

	$response = array();
	$images = $this->getItemFiles($section ,100 , $moduleID , $first);

	if ($images['name']){
		
		$c=0;
		$n=0; // nfiles
		
		foreach($imagenes['name'] as $i=>$v){
			
		$imagen = $imagenes['name'][$c];
		
		if ($imagen){
			if ($c==0){
				
			}else{
				$files[]=$imagen;
				$n++;
			}
		}
			
		$c++;
			
		}

		if ($n > 0){
			$response['status'] = true;
		}else{
			$response['status'] = false;
		}

		$response['files'] = $files;
		$response['c'] = $c;
		$response['n'] = $n;
		
		return $response;
		
	}else{
		$response['status'] = false;
		return $response;
	}
}

	function getFilesModule($moduleID, $limit = 1, $clearFirst = false){

	$response = array();

	if (!$itemId){
		$r['status']=false;
		return($r);
	}
	
	$qry="SELECT name,table FROM files WHERE moduleID = $moduleID ORDER by order asc LIMIT 0,$limit";
	
	$query = $this->db->query($qry);
	
	$c=1;

	foreach ($query->result() as $row){

	if ($limpiarPrimera && $itemId <> 1){ // bug para la home (id=1)
		
		if ($c==1){
			
		}else{
			$response['name'][] = $row->name;
			$response['module'][] = $row->table;
		}
		
	}else{
			$response['nombre'][]=$row->name;
			$response['modulo'][]=$row->table;
	}
	
	$c++;
	}
	
	if ($response){
		$response['status'] = true;
	}else{
		$response['status'] = false;
	}
	
	return $response ;
}

}
