<?php
require APPPATH.'/libraries/REST_Controller.php';
class settings_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	function general_get() 
	{ 
		$this->load->helper('settings');
		$data=getSettings(GENERAL_SETTING_FILE);
		$data['about']=trim(preg_replace('/\s+/', ' ',html_entity_decode($data['about']))); 
	    $data['privacy_policy']= html_entity_decode($data['privacy_policy']);
		$this->response($data);
	}

	function ads_get(){
		$this->load->helper('settings');
		$data=getSettings(ADS_SETTING_FILE);
		$allow_download=getSettings(DOWNLOAD_SETTING_FILE);
		$data['allow_download']=$allow_download['allow_download'];

		$this->response($data);
	}

	// function download_get(){
	// 	$this->load->helper('settings');
	// 	$data=getSettings(DOWNLOAD_SETTING_FILE);
	// 	$this->response($data);
	// }
}
?>