<?php
require APPPATH.'/libraries/REST_Controller.php';
class categories_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('categories_model');
	}

	function categories_get()
	{
		$first=$this->get('first');
		$offset=$this->get('offset');

		$where=array();
		$like=array();
		$q=$this->input->get('q');
		if($q!=null && $q!=''){
			$like['categories.name']=$q;
		}

		$id=$this->input->get('pull');
		if($id!=null){
			$product=$this->categories_model->get_by_id($id);
			$where['categories.id <>']=$id;
			$where['categories.created_at >=']= date('Y-m-d H:i:s',strtotime($product[0]->created_at));
		}

		$data=$this->categories_model->get('*',$where,$like,$first,$offset,array('id'=>'DESC'));

		if($data!=null){
			$this->response($data);
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	}

	function categories_post()
	{
		$data = array('this not available');
		$this->response($data);
	}

	function categories_put()
	{
		$data = array('this not available');
		$this->response($data);
	}

	function categories_delete()
	{
		$data = array('this not available');
		$this->response($data);
	}
}
?>
