<?php

/**

 *

 */

class audios_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->model('artists_model');
	}

	function get($select = "*", $array_where = false, $array_like = false, $first = false, $offset = false, $order_by = false) {
		$data = array();
		if( $order_by != false){
			$order = key($order_by);
			if ($order != null) {
				$sort = $order_by[$order];
				$this -> db -> order_by($order, $sort);
			}
		}

		$this -> db -> select($select);
		$this -> db -> from('audios');
		if($array_where != false)
			$this -> db -> where($array_where);
		if($array_like != false)
			$this -> db -> like($array_like);
		if($offset != false){
			$this -> db -> limit($offset, $first);
		}

		$this->db->join('users','audios.user_id=users.id');
		$this->db->join('albums','audios.album_id=albums.id','left');
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $rows) {
				$data[] = $rows;
			}

			foreach ($data as $r) {
				$r->remoteId=$r->id;
				$artist_id=explode(',', $r->artist_id);
				$artists=array();
				foreach ($artist_id as $r1) {
					$artist=$this->artists_model->get_by_id((int)$r1);
					if($artist!=null){
						array_push($artists,$artist[0]);
					}
				}
				$r->artists=$artists;

				if (substr($r->path, 0, 7) != "http://" && substr($r->path, 0, 8) != "https://"){
					$r->path=base_url().$r->path;
				}

				if(isset($r->created_at) && isset($r->updated_at)){
					$r->created_at=date('d-m-Y H:i:s',strtotime($r->created_at));
					$r->updated_at=date('d-m-Y H:i:s',strtotime($r->updated_at));
				}
				continue;
			}

			$query -> free_result();
			return $data;
		}else {
			return null;
		}
	}

	function total($array_where, $array_like) {
		$this -> db -> select('count(*) as total');
		$this -> db -> where($array_where);
		$this -> db -> like($array_like);
		$this -> db -> from('audios');
		$query = $this -> db -> get();
		$rows = $query -> result();
		$query -> free_result();
		return $rows[0] -> total;
	}

	function get_by_id($id) {
		$select = '*,audios.id as id,audios.created_at as created_at,
		audios.updated_at as updated_at,audios.name as name,audios.artist_id as artist_id';
		$array_where = array('audios.id' => $id);
		$array_like = array();
		$order_by = array();
		return $this -> get($select, $array_where, $array_like, 0, 1, $order_by);
	}

	function get_by_exact_name($name){
		$select = '*';
		$array_like=array();
		$array_where = array('audios.name'=>$name);
		$order_by = array();
		return $this -> get($select, $array_where, $array_like, 0, 1, $order_by);
	}

	function get_by_name($name, $first, $offset) {
		$select = '*, audios.name as name,audios.id as id';
		$array_where = array();
		$array_like = array('audios.name'=>$name);
		$order_by = array();
		return $this -> get($select, $array_where, $array_like, $first, $offset, $order_by);
	}

	function get_by_name_and_diff_id($id,$name){
		$select = '*';
		$array_where = array('audios.name'=>$name,'audios.id <>'=>$id);
		$array_like = array();
		$order_by = array();
		return $this -> get($select, $array_where, $array_like, 0, 1, $order_by);
	}

	function get_by_id_and_name($id,$name, $first, $offset) {
		$select = '*';
		$array_where = array();
		$array_like = array('audios.name'=>$name,'audios.id'=>$id);
		$order_by = array();
		return $this -> get($select, $array_where, $array_like, $first, $offset, $order_by);
	}

	function insert($data_array) {
		$data_array['created_at']=date('Y-m-d H:i:s');
		$data_array['updated_at']=date('Y-m-d H:i:s');
		$this -> db -> insert('audios', $data_array);
		return $this -> db -> insert_id();
	}

	public function remove($arr_where) {
		$this -> db -> where($arr_where);
		$this -> db -> delete('audios');
		return $this->db->affected_rows();
	}

	public function remove_by_id($id) {
		$array_where = array('audios.id' => $id);
		return $this -> remove($array_where);
	}

	function update($data_array, $array_where) {
		$this -> db -> where($array_where);
		$this -> db -> update('audios', $data_array);
	}
}
?>