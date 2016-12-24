<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bootstrap extends CI_Controller 
{

public $appDomain;
public $appPublic;
public $appUploads;
public $appUrlBase;
public $appPathUpload;
public $baseTitle;
public $appTitle;
public $data;

	public function __construct()
	{

		parent::__construct();

		$this->appDomain     = $this->config->item('appDomain');
		$this->appPublic     = $this->config->item('appPublic');
		$this->appUploads    = $this->config->item('appUploads');
		$this->appUrlBase    = $this->config->item('appUrlBase');
		$this->appPathUpload = $this->config->item('appPathUpload');
		$this->baseTitle = $this->config->item('title');
		$this->appTitle = $this->config->item('titleAdmin');
		
		/*  helpers */
		$this->load->helper('idfromurl');
		$this->load->helper('loadlang');
		$this->load->helper('loadmodules');
		$this->load->helper('url');
		/* end of helpers */

		/* librarys */
		$this->load->library('session');
		$this->load->library('general');
		/* .librarys */

		$this->data['lang'] = loadlang($this->config->item('appResourcesLang'));
		$this->data['modules'] = loadmodules($this->config->item('appResourcesModulesID'));
		$modulesConfig = loadmodules($this->config->item('appResourcesModulesID'), false);
		$this->data['htmlMenuModules'] = $this->general->getModuleMenu($modulesConfig, $this->config->item('appResourcesURLlist'));
		
	}

	public function setData()
	{

		$this->data['appPublic'] = $this->appPublic;
		$this->data['appDomain'] = $this->appDomain;
		$this->data['appUploads'] = $this->appUploads;
		$this->data['appUrlBase'] = $this->appUrlBase;
		$this->data['appPathUpload'] = $this->appPathUpload;
		$this->data['keywords']= '';
		$this->data['titleAdmin'] = $this->appTitle;
		$this->data['title'] = $this->baseTitle;
		$this->data['appUrlLogin'] = $this->config->item('appUrlLogin');
		$this->data['appUrlLogOut'] = $this->config->item('appUrlLogOut');
		$this->data['appResourcesModulesConfig'] = $this->config->item('appResourcesModulesConfig');
		$this->data['appGridEdit'] = $this->config->item('appResourcesURLedit');
		$this->data['appGridDelete'] = $this->config->item('appResourcesURLdelete');
		$this->data['appGridAdd'] = $this->config->item('appResourcesURLadd');

		return($this->data);

	}

	public function isLogin(){
		if (empty($this->session->userdata('loginAdmin')) || $this->session->userdata('loginAdmin') != 1){
			$data = $this->setData();
			redirect($data['appUrlBase'] . 'login/');
		}
	}
}
