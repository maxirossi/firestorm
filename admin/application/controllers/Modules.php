<?php
include_once("Bootstrap.php");

defined('BASEPATH') OR exit('No direct script access allowed');

class Modules extends Bootstrap 
{

	public function __construct()
	{

		parent::__construct();

		/* load models */
		$this->load->model('modules_model','modules');
		$this->load->model('files_model','files');
		/* .models */

		/* load helpers */
		/* controls */
		$this->load->helpers('input');
		$this->load->helpers('textarea');
		$this->load->helpers('select_flag');
		$this->load->helpers('select');
		$this->load->helpers('select_multiple');
		$this->load->helpers('number');
		/* end of controls */
		/* .helpers */

		$this->islogin();

	}

	public function index(){

		// set inital data app
		$data = $this->setData();
		// --> set inital data app 

		// enabled dataTables for list data of module
		$data['dataTables'] = 1;

		// get module data && config
		$url = current_url();
		$url = explode("/", $url);
		$module = end($url);
		if (!$module){
			redirect($data['appDomain']);
		}

		$dataModule = array();
		$dataModule = $this->getDataModule($module, $data);
		$data['module'] = $module;
		$data['list'] = $dataModule;
		$data['data']['list'] = $dataModule;

		if (!isset($dataModule['table'])){
			/* missing module */
			$this->load->view('templates/header', $data);
			$this->load->view('templates/error', $data);
			$this->load->view('templates/footer', $data);
			$this->load->view('templates/end-list-module', $data);
		}else{
			// load views
			$this->load->view('templates/header', $data);
			$this->load->view('templates/listModule', $data);
			$this->load->view('templates/footer', $data);
			//print_r($data['data']['list']);die();
			$this->load->view('templates/end-list-module');
			// --> load views
		}
		
	}

	public function getDataModule($module, $data){

		$moduleStatus = array();
		$fileModuleConfig = $data['appResourcesModulesConfig'] . $module . '.php';

		if (file_exists($fileModuleConfig)){

			$moduleID = $this->general->searchModuleID($module);
			$moduleConfig = $this->getDefaultOptions($module);

			require_once($fileModuleConfig);

			$listFields = $moduleConfig['lFields'];
			$strFields = implode("," , $moduleConfig['lFields']);
			$moduleConfig['orderSql'] = $moduleConfig['oFields'][0] . " " . $moduleConfig['oFields'][1];
			$dataModule = $this->modules->listModule($strFields , TABLE, $moduleID, $moduleConfig['orderSql']);

			$dataModule['listData-fields'] = $moduleConfig['lFields'];
			$dataModule['listDataOrder'] = $moduleConfig['oFields'];
			
			if (empty($moduleConfig['editableFields'])){
				$dataModule['listData-editableFields'] = array();	
			}else{
				$dataModule['listData-editableFields'] = $moduleConfig['editableFields'];	
			}

			$dataModule['table'] = TABLE;
			// success
			$dataModule['items'] = ITEMS;
			$dataModule['listStatus'] = 1;
			$dataModule['listMessage'] = 'Success';
		}else{
			// error
			$dataModule ['listStatus'] = 0;
			$dataModule ['listMessage'] = '<div class="alert alert-danger">Error loading Module: ' . $module . '</div>';
		}

		return $dataModule;
	}

	function getDefaultOptions($module){
		$defaultOptions = $this->modules->getDefaultOptions($module);
		return $defaultOptions;
	}

	public function delete(){

		$id = $this->input->post('id');
		$table = $this->input->post('table');
		$data = array();

		if (empty($id) || empty($table) || !is_numeric($id)){
			$data['status'] = 0;
			$data['message'] = 'Data fields error.';
			$data = json_encode($data);
			die($data);
		}

		$action = $this->modules->delete($id, $table);
		/* success */
		$data['status'] = 1;
		$data['success'] = 'Success';
		$data = json_encode($data);
		die($data);
	}

	public function edit(){


		// -----------------------------------------------------------
		// send edit-form
		if (!empty($this->input->post('data'))){
		
		$params = array();
		parse_str($this->input->post('data'), $params);

			if (!empty($params['submit']) && $params['submit'] == 'true'){

				$response = array();
				
				$id = $params['itemID'];
				$table = $params['table'];
				$module = $params['moduleID'];

				if (empty($id) || empty($table) || empty($module)){
					$response['status'] = 0;
					$response['message'] = 'Error in edit item';
					$reponse = json_encode($response);
					die($response);
				}else{
					$params['last_mod'] = date('Y-m-d'); // last edit
					$params['moduleID'] = $module; // field of module_id in db
					$params = $this->cleanParams($params);
					$response = $this->modules->edit($id, $table, $module, $params);
				}

				$response = json_encode($response);
				die($response);
			}
		}
		// .send edit-form
		// -----------------------------------------------------------

		/* renderize edit form */

		// set inital data app
		$data = $this->setData();
		// --> set inital data app 

		// get module data && config
		$url = current_url();
		$url = explode("/", $url);
		$moduleIndexURL = count($url) - 3;
		$module = $url[$moduleIndexURL];
		$data['module'] = $module;
		$itemID = end($url);
		$data['itemID'] = $itemID; 
		if (!$module){
			redirect($data['appDomain']);
		}
		$moduleConfig = $this->getDefaultOptions($module);
		
		$fileModuleConfig = $data['appResourcesModulesConfig'] . $module . '.php';

		if (file_exists($fileModuleConfig)){

		$moduleID = $this->general->searchModuleID($module);
		$moduleConfig = $this->getDefaultOptions($module);
		$data['moduleID'] = $moduleID;

		/* list of images */
		$images = $this->files->getImages($itemID, $moduleID, 'html');

		if ($images['status']){
			$data['imageList'] = $this->general->getImagesHTMLlist($images['data']);
		}
		/* .list */

		require_once('application/dist/modulesConfig/' . $module . '.php');

		// create form
		$arrPaneles = $this->createPanels($panels);
		$panelesImpresos = array();
		$htmlForm = '';
		$val = $this->modules->getData($itemID , TABLE);
		
		foreach($arrFields as $v){

				$param = $v[2]; // array 
				
				if (empty($param['panel'])){
					$param['panel'] = $panelsConfig['main'];
				}

				if(empty($param['label'])){
					$param['label'] = '';
				}
				
					if (!in_array($param['label'],$panelesImpresos)){
						
						if (!empty($v['debugMode'])){
							die($v);
						}
						if (!empty($val[$v[0]])){
							$value = $val[$v[0]];
						}else{
							$value = "";
						}

						/* change table if its a select combo */

						$data['table'] = TABLE;

						if ($v[1] == 'select' || $v[1] == 'select_multiple'){
							$table = $v[2]['table'];
						}else{
							$table = TABLE;
						}

						if ($v[1] == 'select_flag'){
							$value = $val[$v[0]];
						}

						$htmlForm.= $this->printControl($v, $value , $moduleConfig, $table); // imprimimos el control
						$panelesImpresos[] = $param['label']; 
					}
			
			}
			
		// end of create form

		}else{
			// error
			$dataModule ['listStatus'] = 0;
			$dataModule ['listMessage'] = '<div class="alert alert-danger">Error loading Module: ' . $module . '</div>';
		}
		$data['htmlForm'] = $htmlForm;
		// load views
		$this->load->view('templates/header', $data);
		$this->load->view('templates/editModule', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/uploadImage', $data);
		$this->load->view('templates/end-edit-module', $data);
		// --> load views

	}

	public function add(){

		// -----------------------------------------------------------
		// send edit-form
		if (!empty($this->input->post('data'))){
		
		$params = array();
		parse_str($this->input->post('data'), $params);

			if (!empty($params['submit']) && $params['submit'] == 'true'){

				$response = array();
				$table = $params['table'];
				$module = $params['moduleID'];

				if (empty($table) || empty($module)){
					$response['status'] = 0;
					$response['message'] = 'Error in add item';
					$reponse = json_encode($response);
					die($response);
				}else{
					$params['last_mod'] = date('Y-m-d'); // last edit
					$params['moduleID'] = $module; // field of module_id in db
					$params = $this->cleanParams($params);
					$response = $this->modules->add($table, $module, $params);
				}

				$response = json_encode($response);
				die($response);
			}
		}
		// .send add-form
		// -----------------------------------------------------------

		/* renderize add form */

		// set inital data app
		$data = $this->setData();
		// --> set inital data app 

		// get module data && config
		$url = current_url();
		$url = explode("/", $url);
		$moduleIndexURL = count($url) - 1;
		$module = $url[$moduleIndexURL];
		$data['module'] = $module;
	
		if (!$module){
			redirect($data['appDomain']);
		}

		$moduleConfig = $this->getDefaultOptions($module);
		
		$fileModuleConfig = $module . '.php';
		$htmlForm = '';

		if (file_exists('application/dist/modulesConfig/' . $fileModuleConfig)){

		$moduleID = $this->general->searchModuleID($module);
		$moduleConfig = $this->getDefaultOptions($module);
		$data['moduleID'] = $moduleID;

		require_once('application/dist/modulesConfig/' . $fileModuleConfig);

		// create form
		$arrPaneles = $this->createPanels($panels);
		$panelesImpresos = array();
		$htmlForm = '';
		$val = array();
		
		foreach($arrFields as $v){

				$param = $v[2]; // array whit config of panels
				
				if (empty($param['panel'])){
					$param['panel'] = $panelsConfig['main'];
				}

				if(empty($param['label'])){
					$param['label'] = '';
				}
				
					if (!in_array($param['label'],$panelesImpresos)){
						
						if (!empty($v['debugMode'])){
							die($v);
						}
						if (!empty($val[$v[0]])){
							$value = $val[$v[0]];
						}else{
							$value = "";
						}

						/* change table if its a select combo */

						$data['table'] = TABLE;

						if ($v[1] == 'select' || $v[1] == 'select_multiple'){
							$table = $v[2]['table'];
						}else{
							$table = TABLE;
						}

						$htmlForm.= $this->printControl($v, $value , $moduleConfig, $table); // imprimimos el control
						$panelesImpresos[] = $param['label']; 
					}
			
			}
			
		// end of create form

		}else{
			// error
			$dataModule ['listStatus'] = 0;
			$dataModule ['listMessage'] = '<div class="alert alert-danger">Error loading Module: ' . $module . '</div>';
		}
		$data['htmlForm'] = $htmlForm;
		$data['itemID'] = '';
		// load views
		$this->load->view('templates/header', $data);
		$this->load->view('templates/addModule', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/uploadImage', $data);
		$this->load->view('templates/end-add-module', $data);
		// --> load views

	}
	public function printControl($v, $val, $moduleConfig, $table){

		/*
			$v = config of input
			$val = value of db
		*/
		
		$html = '';
		$idcampo=$v[0]; // id (name) del control
		$p=$v[2]; // parametros individuales de cada control
		
		//echo("El id del campo es " . $idcampo);
		// obtenemos el label
		if (empty($p['label'])){
			$label= $idcampo;
		}else{
			$label= $p['label'];
		}
		
		if (!empty($p['debugMode'])){
			die($p);
		}
		$p = $this->settingConfigControl($p);	

		// verifica si es necesario
		//if(in_array($idcampo,$moduleConfig['oFields'])) $p['necesario'] = 1;
		
		switch ($v[1]){ // se switchea por tipo de control
			
			case "input":
				$html = 
					input(
					$val,
					$idcampo,
					$label,
					$p['maxChars'],
					$p['required'],
					$p['manejaLang'],
					$p['esAjax'],
					$p['disabled'],
					$p['clase']
					);
			break;

			case "number":
				$html = 
					number(
					$val,
					$idcampo,
					$label,
					$p['maxChars'],
					$p['required'],
					$p['manejaLang'],
					$p['esAjax'],
					$p['disabled'],
					$p['clase']
					);
			break;

			case "textarea":
				$html = 
					textarea(
					$val,
					$idcampo,
					$label,
					$p['required'],
					$p['manejaLang'],
					$p['esAjax'],
					$p['disabled'],
					$p['class']
					);
			break;

			case "select_flag":
			if (empty($p['valor1']) || empty(!$p['valor2'])){
				$p['valor1']="Si";
				$p['valor2']="No";
			}
			$html = 
				select_flag(
				$val,
				$idcampo,
				$label,
				$p['esAjax'],
				$p['required'],
				$p['disabled'],
				$p['valor1'],
				$p['valor2']
				);
			break;			

			case "select":
			$html = 
				select(
				$table,
				$val,
				$idcampo,
				$label,
				$p['table'],
				$p['field'],
				$p['where'],
				$p['order'],
				$p['funcion'],
				$p['array'],
				$p['tabla_contar'],
				$p['where_contar'],
				$p['contenedor_pre_name'],
				$p['required'],
				$p['esAjax'],
				$p['disabled']
				);
			break;

			case "select_multiple":
			$html = 
				select_multiple(
				$table,
				$val,
				$idcampo,
				$label,
				$p['tabla'],
				$p['campo'],
				$p['cant'],
				$p['where'],
				$p['orden'],
				$p['array'],
				$p['esAjax'],
				$p['required'],
				$p['disabled']
				);
			break;

		}
			/* examples of other types of inputs, you can create/edit
			there in helpers
			/*
			case "password":
				password(
				$val[$idcampo],
				$idcampo,
				$label,
				$p['maxChars'],
				$p['necesario'],
				$p['disabled']
				);
			break;
			
			case "textarea":
				textarea(
				$val[$idcampo],
				$idcampo,
				$label,
				$p['necesario'],
				$p['manejaLang'],
				$p['esAjax'],
				$p['disabled'],
				$p['class']
				);
			break;
			
			case "datepicker":
				datepicker(
				$val[$idcampo],
				$idcampo,
				$label,
				$p['necesario'],
				$p['disabled']
				);
			break;
			
			case "timepicker":
				timepicker(
				$val[$idcampo],
				$idcampo,
				$label,
				$p['necesario'],
				$p['disabled']
				);
			break;
			
			case "select_flag":
			if (!$p['valor1'] || !$p['valor2']){
				$p['valor1']="SI";
				$p['valor2']="NO";
			}
				select_flag(
				$val[$idcampo],
				$idcampo,
				$label,
				$p['esAjax'],
				$p['necesario'],
				$p['disabled'],
				$p['valor1'],
				$p['valor2']
				);
			break;				
			
			case "search_input_autocomplete":
				search_input_autocomplete(
				$val[$idcampo],
				$idcampo,
				$label,
				$idcampo."_list",
				$p['iconUrl'],
				$p['necesario'],
				$p['itemID'],
				$p['campoID'],
				$p['eventos'],
				$p['moduloName'],
				$p['disabled']
				);
			break;	
			
			case "html":
			//print_r($p);die();
			$idcampo='img';
			//die($p['valor']);
			//die($p['valor'] . $val[$idcampo]);
				html(
					$label,
					$p['valor'] . $val[$idcampo],
					$val[$idcampo],
					$p['tipo']
				);
				
			break;
				
			case "select_static":
				select_static(
				$label,
				$val[$idcampo],
				$p['tipo']
				);
			break;
		}
		*/

		return $html;
}

	public function createPanels($p)
	{
	
	foreach($p as $pConfig){
		$arrPaneles[]=array($pConfig);
	}
	
	return($arrPaneles);
	}

	function getData($table, $id)
	{
		$data = $this->modules->getData($table, $id);
	}

	public function settingConfigControl($p)
	{
	
		$options = array (
				"label",
				"maxChars",
				"disabled",
				"required",
				"manejaLang",
				"class",
				"table",
				"field",
				"where",
				"funcion",
				"array",
				"tabla_contar",
				"where_contar",
				"contenedor_pre_name",
				"esAjax",
				"disabled",
				"moduloName",
				"clase",
				"valor1",
				"valor2",
				"order",
				"cant"
			);

		foreach($options as $i=>$v){
			if (empty($p[$v])){
				$p[$v] = '';
			}
		}

		return $p;
	}

	public function cleanParams($params)
	{

		foreach($params as $i=>$v){
			if (array_search($i, $this->config->item('dataFormParams'))){
				unset($params[$i]);
			}
		}

		return $params;
	}

}

