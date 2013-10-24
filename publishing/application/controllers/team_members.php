<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team_members extends CI_Controller {
	public function index()
	{
		$header_data['page_title'] = 'Team Members'.TITLE_SUFFIX;
		$this->load->view('include/header.php',$header_data);
		$this->load->view('team_members/team_members');
		$this->load->view('include/footer.php');
	}
}
