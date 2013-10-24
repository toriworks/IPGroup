<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Convention extends CI_Controller {
	public function index()
	{
		$header_data['page_title'] = 'Convention'.TITLE_SUFFIX;
		$header_data['gnb'] = 'convention';

		$this->load->view('include/header.php',$header_data);
		$this->load->view('convention/convention');
		$this->load->view('include/footer.php');
	}
}
