<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller 
{

	public function __construct()
	{

		parent::__construct();
 
		/* load models */
		$this->load->model('content_model','content');
		$this->load->model('files_model','files');
	
		/* load librarys */
		$this->load->library('pagination');
		/* load helpers */
		$this->load->helper('idfromurl');
		$this->load->helper('url');

	}

	public function index()
	{

		// set some variables
		$data = $this->setData();
		$posts = $this->getPosts();

		if ($posts['success']){
			$data['HTMLposts'] = $this->HTMLpost($posts);
		}else{
			$data['HTMLposts'] = '';
		}
		// load views
		$this->load->view('templates/header', $data);
		$this->load->view('templates/main', $data);
		$this->load->view('templates/footer', $data);

	}

	public function show()
	{

		// set some variables
		$data = $this->setData();
		
		$dataUrl = idfromurl();
		$id = $dataUrl['id'];
		$slug = strtolower($dataUrl['slug']);
		$data['id'] = $id;

		if (!is_numeric($id)){
			redirect($this->config->item('appDomain'));
		}

		$arrData = array();
		$url = current_url();
		$url = explode("/",$url);
		$l = count($url);
		$id_seccion = $url[$l-1];
		if (!is_numeric($id_seccion)){
			redirect($this->config->item('appDomain'));
		}

		$data['data'] = $this->content->getSection($id);
	
		if (isset($data['data']['img']['name']) && count($data['data']['img']['name']) > 0){
			$data['backgroundImg'] = $this->getUrlFrontImage($data['data']['img']['name'][0], $data['data']['img']['module'][0]);
		}else{
			// default bg
			$data['backgroundImg'] = $this->config->item('appPublic') . '/img/home-bg.jpg';
		}
		
		switch ($slug) {
			case 'dependencies':

				$data['frontEnd'] = $this->content->getItems(1, 3);
				$data['backEnd'] = $this->content->getItems(2, 3);
			
				$this->load->view('templates/header', $data);
				$this->load->view('templates/lists', $data);
				$this->load->view('templates/footer', $data);
			break;
			default:
				$this->load->view('templates/header', $data);
				$this->load->view('templates/general', $data);
				$this->load->view('templates/footer', $data);
			break;
		}
	}

	public function post()
	{

		// set some variables
		$data = $this->setData();
		$dataUrl = idfromurl();
		$id = $dataUrl['id'];
		$slug = strtolower($dataUrl['slug']);
		$data['id'] = $id;

		if (!is_numeric($id)){
			redirect($this->config->item('appDomain'));
		}

		$arrData = array();
		$url = current_url();
		$url = explode("/",$url);
		$l = count($url);
		$idPost = $url[$l-1];

		if (!is_numeric($idPost)){
			redirect($this->config->item('appDomain'));
		}

		$post = $this->content->getShow($idPost, 5, 'posts');

		if ($post['img']){
			$data['htmlImages'] = $this->getHTMLimages($post['img']);
		}
		
		if (!$post){
			redirect($this->config->item('appDomain'));
		}else{
			$data['post'] = $post;
		}
		
		$data['backgroundImg'] = $this->config->item('appPublic') . '/img/home-bg.jpg';
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/post', $data);
		$this->load->view('templates/footer', $data);
		
	}

	public function error()
	{

		$this->load->view('templates/header', $data);
		$this->load->view('templates/ampliar', $data);
		$this->load->view('templates/footer', $data);
		
	}

	public function setData()
	{

		$this->data['appPublic'] = $this->config->item('appPublic');
		$this->data['appDomain'] = $this->config->item('appDomain');
		$this->data['appUploads'] = $this->config->item('appUploads');
		$this->data['appPathUpload'] = $this->config->item('appPathUpload');
		$this->data['email'] = $this->config->item('email');
		$this->data['emailNoResponse'] = $this->config->item('emailNoResponse');
		$this->data['keywords']='';
		$this->data['title']= $this->config->item('title');

		// load general texts  ------------------------------>
		$arrTexts = array();
		$arrTexts = $this->content->getTexts();
		$c = 0;
		foreach($arrTexts['data']['name'] as $i=>$v){
			$slug = $arrTexts['data']['name'][$c];
			$description = $arrTexts['data']['description'][$c];
			$this->data[$slug] = $description;
		$c++;
		}
		$menu = $this->getMenu();
		$this->data['menu'] = $this->getHTMLmenu($menu);
		// end of textos generales --------------------------------->
		$url = base_url(uri_string());
		$this->data['actual_link'] = $url;
		$this->data['description'] = '';
		return $this->data;
	}

	public function getText($slug)
	{
		$text = $this->content->getText($slug);

		if ($text){
			return $text;
		}else{
			return '';
		}
	}

	public function getTexts()
	{

		$response = array();
		$data = array();
		$response = $this->content->getTexts();
	}

	public function getMenu()
	{
		// load menu
		$data = array();
		$data['categories'] = $this->content->getSections(1, false ,$this->config->item('appUrlInit'), 0 , ' ORDER BY position ASC');
		return $data;
	}

	public function getHTMLmenu($data)
	{

		$response = '<ul class="nav navbar-nav navbar-right">';
		$response .= '<li><a href="' . $this->config->item('appDomain') . '">Home</li>';

		$c = 0;

		foreach($data['categories']['id'] as $i=>$v){
			$name = $data['categories']['name'][$c];
			$url = $data['categories']['url'][$c];
			$id = $data['categories']['id'][$c];
			if ($name != 'Home'){
				$response .= '<li><a href="' . $url . '"><div> ' . $name .'</div></a></li>';
			}
			$c++;
		}

		$response .= '</ul>';

		return $response;
	}

	public function getUrlFrontImage($image, $module, $prefix = "")
	{
		if (!$prefix){
			$url = $this->config->item('appUploads') . $module . '/' . $image;
		}else{
			$url = $this->config->item('appUploads') . $module . '/' . $prefix . "-" . $image;
		}
	
		return $url;
	}

	public function getPosts()
	{
		$response = array();
		$response = $this->content->getPosts();
		return $response;
	}

	public function HTMLpost($data)
	{
		$html = '';
		$c = 0;

		foreach($data as $i=>$v){
			$html .=
			'
			  <div class="post-preview">
                    <a href="' . $data[$i]['url'] . '">
                        <h2 class="post-title">
                           ' . $data[$i]['title'] . '
                        </h2>
                        <h3 class="post-subtitle">
                           ' . $data[$i]['summary'] . '
                        </h3>
                    </a>
                </div>
			';
			$c++;
		}
		return $html;
	}

	public function getHTMLimages($images)
	{
		if (isset($images['name'][0])){
		
			$html = '<div class="sp-loading"><img src="' . $this->config->item('appPublic') . '/img/sp-loading.gif" alt=""><br>LOADING IMAGES</div>';
			$html .= '<div class="sp-wrap">';

		    foreach($images['name'] as $i=>$v){
						$imgName = $this->getUrlFrontImage($images['name'][$i], $images['module'][$i], 'small');
						$html .= '<a href="' . $imgName .'"><img src="' . $imgName . '" alt="" height="40" /></a>';
					}

			$html .= '</div>';
			return $html;
		}
		
	}
}
