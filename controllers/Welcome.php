<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Signalactivity');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function savepriority()
	{
		$response = array();
		$response['status'] = false;

		$sa=$this->input->post('signalA');
		$sb=$this->input->post('signalB');
		$sc=$this->input->post('signalC');
		$sd=$this->input->post('signalD');
		$greentime=$this->input->post('greentime');
		$yellowtime=$this->input->post('yellowtime');
		
		$data= array();
		$data['signalA'] = $sa;
		$data['signalB'] = $sb;
		$data['signalC'] = $sc;
		$data['signalD'] = $sd;
		$data['greentime'] = $greentime;
		$data['yellowtime'] = $yellowtime;
		$return=$this->Signalactivity->Update($data);
		
		if($return > 0){
			$response['status'] = true;
			$response['msg'] = 'Updated.';
		}else{
			$response['msg'] = 'Update Error!!!';
		}
		print_r(json_encode($response));
	}
	public function getpriority()
	{
		$data= array();
		$return=$this->Signalactivity->getdata($data);
		$return_data = json_decode($return,true);
		$response = array();
		$response['status'] = true;
		$response['values'] = $return_data['data'];
		print_r(json_encode($response));
	}
}
