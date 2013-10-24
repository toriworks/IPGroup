<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	public function index()
	{
		$header_data['page_title'] = '메인페이지'.TITLE_SUFFIX;
		$this->load->view('include/header.php',$header_data);
		$this->load->view('main_view');
		$this->load->view('include/footer.php');
	}
}
