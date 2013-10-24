<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Js_plugin extends CI_Controller {
	public function index()
	{
		$header_data['page_title'] = 'JS plug-in'.TITLE_SUFFIX;
		$header_data['gnb'] = 'js_plugin';

		$this->load->view('include/header.php',$header_data);
		$this->load->view('js_plugin/js_plugin');
		$this->load->view('include/footer.php');
	}
}
