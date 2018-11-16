<?php
class colors extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['user'])){
			redirect('admin/dashboard');
		}else{
			$user=$_SESSION['user'][0];
			if($user->perm==USER){
				redirect('admin/denied');
			}
		}
		$this->load->model('colors_model');
		$this->form_validation->set_error_delimiters('<span class="help-inline msg-error" generated="true">', '</span>');
	}

	function index(){
		$base_url=base_url().'admin/colors';
		$page=$this->uri->segment(3);
		if(!is_numeric($page) || $page<=0){
			$page=1;
		}
		$first=($page-1)*$this->pg_per_page;
		$total_rows=$this->colors_model->total(array(),array());
		$data['list'] = $this->colors_model->get("*", array(),array(),$first, $this->pg_per_page, array('id' => 'DESC'));
		$data['page_link'] =parent::pagination_config($base_url,$total_rows,$this->pg_per_page);
		$this->render_backend_tp('backends/colors/index', $data);
	}

	public function create(){
		if(isset($_POST['code'])){
			$data['code']=$this->input->post('code');
			$this->form_validation->set_rules('code','code', 'trim|required|min_length[2]|max_length[60]|xss_clean');
			if($this->form_validation->run()!=false){
				$insert_id=$this->colors_model->insert($data);
				if($insert_id!=0){
					$this->session->set_flashdata('msg_ok', $this->lang->line('add_successfully'));
							redirect(base_url().'admin/colors/create');
				}
			}
		}
		$this->template->write_view('content','backends/colors/add');
		$this->template->render();
	}


	public function edit_get(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$data['obj']=$this->colors_model->get_by_id($id);
			$this->load->model('colors_model');
			$this->template->write_view('content','backends/colors/edit',$data);
			$this->template->render();
		}
	}

	public function edit_post(){
		if(isset($_POST['id'])){
			$id=$_POST['id'];
			$code=$_POST['code'];
			$this->form_validation->set_rules('code','code', 'trim|required|min_length[2]|max_length[60]|xss_clean');
			if($this->form_validation->run()){
				$this->colors_model->update(array('code'=>$code),array('id'=>$id));
				$this->session->set_flashdata('msg_ok',$this->lang->line('edit_successfully'));
				redirect(base_url().'admin/colors/edit_get?id='.$id);
			}

			$data['obj']=$this->colors_model->get_by_id($id);
			$this->load->model('colors_model');
			$this->template->write_view('content','backends/colors/edit',$data);
			$this->template->render();
		}
	}

	public function set_default(){
		if(isset($_GET['id'])){
			$id = $this->input->get('id');
			$this->colors_model->update(array('default'=>0),array());
			$this->colors_model->update(array('default'=>1),array('id'=>$id));
			redirect(base_url().'admin/colors');
		}
	}

	public function delete(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$obj=$this->colors_model->get_by_id($id);
			try {
				unlink($obj[0]->path);
			} catch (Exception $e) {

			}
			$this->colors_model->remove_by_id($id);
			redirect('admin/colors');
		}
	}

	public function search(){
		if(isset($_GET['query'])){
			$query=$this->input->get('query');
			$data=parent::getDataView();
			$page     = $this->input->get('page') ? $this->input->get('page') : 0;
			$per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
			$order    = $this->input->get('order') ? $this->input->get('order') : 'DESC';
			$config['total_rows'] = $this->colors_model->total(array(), array('name'=>$query));
			$config['base_url']= base_url() . 'index.php/admin/colors/search?order='.$order.'&query='.$query;
			$config['per_page']=$per_page;
			$data['msg_label']=$this->config->item('msg_label');
			$this->pagination->initialize($config);
			$data['list'] = $this->colors_model->get_by_name($query,$page,$per_page);
			$data['page_link'] = $this->pagination->create_links();
			$data['search_title']='Result search for "'.$query.'"';
			$this->template->write_view('content','backends/colors/index',$data);
			$this->template->render();
		}
	}
}
?>
