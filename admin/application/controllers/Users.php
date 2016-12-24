<?php
include_once("Bootstrap.php");

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Bootstrap 
{

	public function __construct(){

		parent::__construct();

		/* load models */
		$this->load->model('users_model','user');
		/* .models */

		/* load helpers */
		$this->load->helper('ipuser');
		$this->load->helper('htmlmail');
		$this->load->helper('url');
		/* .helpers */

		/* librarys */
		$this->load->library('session');
		/* .librarys */
	}

	public function login($user = "" , $pwd = "")
	{

		$data = $this->setData();

		if ($user == '' && $pwd == ''){

			$data['user'] = '';

			if (isset($_POST['pwd'])){
				$data['pwd'] =  md5($this->input->post('pwd'));
				$data['user'] = $this->input->post('user');
			}
			
		}else{

			$data['user'] = $user;
			$data['pwd'] = $pwd;
		}

		/* ---------- login */

		if ($data['user']){

			$log = $this->user->login($data['user'] , $data['pwd']);

			if ($log > 0){

				$userData = array(
				    'loginAdmin' => TRUE
				);

				$this->session->set_userdata($userData);

				redirect($this->appUrlBase);
			}else{

				$userData = array(
				    'loginAdmin' => FALSE
				);

				$this->session->set_userdata($userData);

				redirect($data['appUrlBase'] . 'login/?err=log');
			}
		}

		/* ---------- end of login */
	}

	public function logOut()
	{
		$data = $this->setData();
		$this->session->sess_destroy();
		redirect($data['appUrlBase'] . 'login/');
	}

}

