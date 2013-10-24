<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {
	public function index()
	{
		$header_data['page_title'] = 'About'.TITLE_SUFFIX;
		$this->load->view('include/header.php',$header_data);
		$this->load->view('about/about');
		$this->load->view('include/footer.php');
	}
}
