<?php
require APPPATH.'/libraries/REST_Controller.php';
class playlists_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('playlists_model');
	}

	function playlists_get()
	{
        $first=$this->get('first')==null? 0:$this->get('first');
		$offset=$this->get('offset')==null? 10:$this->get('offset');
		$where=array();

		$like=array();
		$q=$this->input->get('q');
		if($q!=null && $q!=''){
			$like['playlists.name']=$q;
		}
		
		$id=$this->input->get('pull');
		if($id!=null){
			$product=$this->playlists_model->get_by_id($id);
			$where['playlists.id <>']=$id;
			$where['playlists.created_at >=']= date('Y-m-d H:i:s',strtotime($product[0]->created_at));
		}

		$data=$this->playlists_model->get('*',$where,$like,$first,$offset,array('id'=>'DESC'));
		if($data!=null){
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	}

	function playlists_post()
	{
		$data = array('this not available');
		$this->response($data);
	}

	function playlists_put()
	{
		$data = array('this not available');
		$this->response($data);
	}

	function playlists_delete()
	{
		$data = array('this not available');
		$this->response($data);
	}
}
?>
