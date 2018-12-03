<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
	}
	
	public function index()
	{
        $this->load->view('adm/index');
	}

	// 主页
	public function main()
    {
        $this->load->view('adm/default');
    }
	
}