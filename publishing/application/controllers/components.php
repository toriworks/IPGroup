<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Components extends CI_Controller {
	public function index()
	{
		$header_data['page_title'] = 'Components'.TITLE_SUFFIX;
		$header_data['gnb'] = 'components';

		$this->load->view('include/header.php',$header_data);
		$this->load->view('components/components');
		$this->load->view('include/footer.php');
	}
}
