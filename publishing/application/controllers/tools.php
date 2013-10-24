<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Controller {
	public function index()
	{
		$header_data['page_title'] = 'Tools'.TITLE_SUFFIX;
		$header_data['gnb'] = 'tools';

		$this->load->view('include/header.php',$header_data);
		$this->load->view('tools/tools');
		$this->load->view('include/footer.php');
	}
}
