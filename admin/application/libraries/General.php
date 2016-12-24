<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General {

public $app;

	public function __construct(){
		$this->app = $CI =& get_instance();
	}

	public function searchModuleID($module){

		$modules = loadmodules($this->app->config->item('appResourcesModulesID'), false);

		foreach($modules as $i=>$v){
			if ($v['name'] == $module){
				return $v['id'];
			}
		}
		die("$module no exist.");
	}

	public function getImagesHTMLlist($data){

		if (count($data) == 0){
			return '';
		}

		$html = '';
		$prefix = 'small';
		// create html list for images
		$html .='
			<div class="container">
			<ul class="thumbnails">
  		';
  		$c = 0;
  		foreach($data['id'] as $i=>$v){
	  		if (!empty($data['moduleID'][$c])){
	  			$urlImg = $this->app->config->item('appUploads') . '/' . $data['moduleID'][$c] . '/' . $prefix . '-' . $data['title'][$c];
	  			$element_id = 'row-image-' . $data['id'][$c];
	  			$html.= '<li class="span4 image-in-list" id="' . $element_id . '">';
	  			$html.= '
				<div class="thumbnail" data-id="' . $data['id'][$c] . '">
			      <a style=";font-size:15px" href="javascript:deleteImage(\'' . $data['id'][$c] . '\',\'' . $data['moduleID'][$c] . '\',\'' . $element_id . '\')"><i class="fa fa-trash" aria-hidden="true"></i></a>
			      <img src="' . $urlImg . '" ">
			    </div>';
				 $html.= '<div class="clearfix"></div>';
				}
  		$c++;
  		}
  		$html .='</ul></div>';
  		return($html);
		// .images
	}

	public function getModuleMenu($modules, $urlList)
	{

		$html = '';
		$c = 0;
	
		foreach($modules as $i=>$v){

			if (!empty($v['icon'])){
				$icon = $v['icon'];
			}else{
				$icon = 'fa fa-navicon fa-fw';
			}

			if ($v['id'] != 'users'){
				 $html .=
				'
				 <li>
	                 <a class="modules" rel="' . $v['name'] . '" href="' . $urlList . $v['name'] . '"><i class="' . $icon .'"></i> ' . ucfirst($v['name']) . '</a>
				 </li>
				';	
				$c++;
			}
		}

		return $html;
	}
}