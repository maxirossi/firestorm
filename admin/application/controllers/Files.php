<?php
include_once("Bootstrap.php");

defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends Bootstrap 
{

	public function __construct()
	{

		parent::__construct();

		/* load models */
		$this->load->model('modules_model','modules');
		$this->load->model('files_model','files');
		/* .models */

	}

	public function uploadImage()
	{

		$response = array();
		// --------------------------------------------------> uploadImage
		if (isset($_FILES)) {
				
			/* itemID & moduleID*/
			// get module data && config

			$url = current_url();
			$url = explode("/", $url);
			$itemIndexURL = count($url) - 3;
			$item = $url[$itemIndexURL];
			$module = end($url);
			
			if (empty($item) || empty($module) || !is_numeric($item) || !is_numeric($module)){
				 $response['status'] = false;
				 $response['message'] = 'Error in URL of upload img.';
				 $response = json_encode($response);
				 die ($response);
			}	

			/* .itemID */

			/* cofig */
			$pathUpload = $this->appPathUpload . $module ."/";
			$this->mkdir_recursive($pathUpload);
			$config['encrypt_name'] = TRUE;
		   	$config['upload_path'] = $pathUpload;
		   	$config['allowed_types'] = 'gif|jpg|png';
			$this->config->item('max_size');
			$this->config->item('max_width');
			$this->config->item('max_height');
			/* load librarys */
			$this->load->library('upload', $config);
			$this->load->library('image_lib');
			/* .load librarys */

			foreach($_FILES as $i=>$file){

				$type = $file['type'];
				$sizeFile = $file['size'];
				$config['file_name'] = $file['tmp_name'];

				/* .config */
				if ( ! $this->upload->do_upload('upload_file')){
					 $response['file_upload'] = false;
				     $response['file_name'] = '';
				     $response['status'] = false;
				     $response['file_msg'] = $this->upload->display_errors();
				     $response = json_encode($response);
				     die ($response);
				} else {

					$dataUp = array('upload_data' => $this->upload->data());
					$this->saveImage($item, $module, $dataUp['upload_data']['file_name'], $type, $sizeFile);

				   	foreach($this->config->item('thumbSizes') as $thumb){
				   		$size = $thumb['size'];
				   		$size = explode(",", $size);
				   		$w = $size[0];
				   		$h = $size[1];
				   		$prefix = $thumb['prefix'];
				   		$this->resizeImage($pathUpload, $dataUp['upload_data']['file_name'], $w, $h, $prefix, $item, $module, $type, $sizeFile);
				   	}
				   // clear //
	   			   $this->image_lib->clear();
				}
		} //.each

			// return data
			$response['status'] = 1;
			$response['message'] = 'Success';
			$response = json_encode($response);
			die ($response);

		} else {
			$response['status'] = false;
			$response['message'] = 'Error uploading images';
			$response = json_encode($data);
			die ($response);
		}
	}

	public function resizeImage($path, $file, $w, $h, $prefix, $item, $module, $type, $size)
	{
	   	
	    $source_path = $path . $file;
	    $fileName =  $prefix . "-" . $file;
	    $target_path = $path . $prefix . "-" . $file;

	    $config_manip = array(
	        'image_library' => 'gd2',
	        'source_image' => $source_path,
	        'new_image' => $target_path,
	        'maintain_ratio' => TRUE,
	        'create_thumb' => TRUE,
	        'thumb_marker'  => '' ,
	        'width' => $w,
	        'height' => $h
	    );

	    $this->load->library('image_lib');
		$this->image_lib->initialize($config_manip);

	    if (!$this->image_lib->resize()) {
	       	 $response['status'] = false;
			 $response['message'] = 'Error creating thumb.';
			 $response = json_encode($response);
			 die($response);
	    }
	    
	}

	public function mkdir_recursive($pathname, $mode = 0755)
	{
		is_dir(dirname($pathname)) || mkdir_recursive(dirname($pathname), $mode);
		return is_dir($pathname) || @mkdir($pathname, $mode);
	}

	public function saveImage($item_id, $module_id, $fileName, $type, $size){
		$response = array();
		$response = $this->files->saveImage($item_id, $module_id, $fileName, $type, $size); 
	}

	public function getImages($item_id = '', $module_id = '', $mode = '')
	{

		if (empty($item_id)){
			$item_id = $this->input->post('id');
			$module_id = $this->input->post('module');
			$mode = $this->input->post('mode');
		}

		$response = array();
		$data = array();

		$response = $this->files->getImages($item_id, $module_id); 
		
		if ($response['status'] == 1){
			if ($mode == 'html'){
				$data = $this->general->getImagesHTMLlist($response['data']);
				$response['data'] = $data;
				die(json_encode($response));
			}else{
				die(json_encode($response));
			}
		}else{
			die(json_encode($response));
		}
	}

	public function deleteImage($id = "", $module_id = "")
	{

		if (empty($id)){
			$id = $this->input->post('id');
			$module_id = $this->input->post('module');
		}

		$response = array();
		$response = $this->files->deleteImage($id, $module_id);
		die(json_encode($response));
	}

	public function orderImages($id = "")
	{

		if (empty($id)){
			$id = $this->input->post('id');
		}

		$response = array();
		$response = $this->files->orderImages($id);

		die(json_encode($response));

	}
}

