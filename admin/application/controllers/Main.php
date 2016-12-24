<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once("Bootstrap.php"); // main controller

class Main extends Bootstrap
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		// set inital data app
		$data = $this->setData();
		// --> set inital data app 
		
		$this->isLogin();
		
		// load views
		$this->load->view('templates/header', $data);
		$this->load->view('templates/home', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/end', $data);
		// --> laod views
	}

	public function login()
	{
		
		// set inital data app
		$data = $this->setData();
		// --> set inital data app 
		$data['showMenu'] = false;
		// load views
		$this->load->view('templates/headerLogin', $data);
		$this->load->view('templates/login', $data);
		$this->load->view('templates/footerLogin', $data);
		$this->load->view('templates/end', $data);
		// --> laod views
	}
}
