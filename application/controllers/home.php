<?php 
class Home extends MY_Controller{
   	function __construct()
	{
		parent::__construct();
		$this->load->helper('settings_helper');
	}


	function index(){
		redirect(base_url().'admin/dashboard');
	}

	function detail(){
		$id=$this->input->get('id');
		if(!is_numeric($id)){
		  echo 'link not found';
		}else{
		  $this->load->model('audios_model');
		  $obj=$this->audios_model->get_by_id($id);
		  if($obj==null){
		  	echo 'link not found';
		  	exit();
		  }
		  $this->load->view('detail',array('obj'=>$obj[0]));
	    }
	}

	function download(){
		ob_clean(); 
		$name = $this->input->get('name');
		$url=$this->input->get('url');
		$this->load->helper('download');
		$path    =   file_get_contents($url);
		force_download($name, $path);     
	}
}
?>