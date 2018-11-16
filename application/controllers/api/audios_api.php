<?php
require APPPATH.'/libraries/REST_Controller.php';
class audios_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('audios_model');
	}

	function audios_get()
	{
	    $first=$this->get('first')==null? 0:$this->get('first');
		$offset=$this->get('offset')==null? 10:$this->get('offset');
		$where=array();
		$like=array();
		$id=$this->input->get('pull');
		if($id!=null){
			$product=$this->audios_model->get_by_id($id);
			$where['audios.id <>']=$id;
			$where['audios.created_at >=']= date('Y-m-d H:i:s',strtotime($product[0]->created_at));
		}

		$categories_id=$this->input->get('categories_id');
		if($categories_id!=null && is_numeric($categories_id)){
			$where['FIND_IN_SET("'.$categories_id.'",audios.categories_id)<>']=0;
		}

		$album_id=$this->input->get('album_id');
		if($album_id!=null && is_numeric($album_id)){
			$where['audios.album_id']=$album_id;
		}

	    $artist_id=$this->input->get('artist_id');
		if($artist_id!=null && is_numeric($artist_id)){
			$where['FIND_IN_SET("'.$artist_id.'",audios.artist_id)<>']=0;
		}


	    $playlist_id=$this->input->get('playlist_id');
		if($playlist_id!=null && is_numeric($playlist_id)){
			$where['FIND_IN_SET("'.$playlist_id.'",audios.playlist_id)<>']=0;
		}

		$query=$this->input->get('q');
		if($query!=null && $query!=''){
			$like['audios.name']=$query;
		}

		$data=$this->audios_model->get('*,audios.name as name,
			audios.created_at as created_at,
			audios.updated_at as updated_at,
			audios.id as id,
			audios.artist_id as artist_id,
			albums.name as album_name',$where,$like,$first,$offset,array('audios.id'=>'DESC'));
		if($data!=null){
			$this->response($data);
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	}

	function audio_get(){
		$id=$this->input->get('track_id');
		$data=$this->audios_model->get('*,audios.name as name,
			audios.created_at as created_at,
			audios.updated_at as updated_at,
			audios.id as id,
			audios.artist_id as artist_id,
			albums.name as album_name',array('audios.id'=>$id),array(),0,1,array('audios.id'=>'DESC'));
		$this->response($data);
	}

	function audios_post()
	{
		$data = array('this not available');
		$this->response($data);
	}

	function audios_put()
	{
		$data = array('this not available');
		$this->response($data);
	}

	function audios_delete()
	{
		$data = array('this not available');
		$this->response($data);
	}
}
?>
