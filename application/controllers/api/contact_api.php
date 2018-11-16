
<?php
require APPPATH.'/libraries/REST_Controller.php';
class contact_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('contact_model');
	}


	function contact_post(){

		$data['full_name']=$this->post('full_name');
		$data['email']=$this->post('email');
		$data['content']=$this->post('message');
		$data['subject']='CONTACT RESTAURANT';
		$this->contact_model->insert($data);

		$this->response(1);

	}

}