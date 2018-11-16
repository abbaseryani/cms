<?php
class playlists extends MY_Controller{
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
		$this->load->model('playlists_model');
		$this->form_validation->set_error_delimiters('<span class="help-inline msg-error" generated="true">', '</span>');
	}

	function index(){
		$base_url=base_url().'admin/playlists';
		$page=$this->uri->segment(3);
		if(!is_numeric($page) || $page<=0){
			$page=1;
		}
		$first=($page-1)*$this->pg_per_page;
		$total_rows=$this->playlists_model->total(array(),array());
		$data['list'] = $this->playlists_model->get("*", array(),array(),$first, $this->pg_per_page, array('id' => 'DESC'));
		$data['page_link'] =parent::pagination_config($base_url,$total_rows,$this->pg_per_page);
		$this->render_backend_tp('backends/playlists/index', $data);
	}

	public function create(){
		if(isset($_POST['name'])){
			$data['name']=$this->input->post('name');
			$this->form_validation->set_rules('name','name', 'trim|required|min_length[2]|max_length[200]|xss_clean');
			if($this->form_validation->run()!=false){
				$insert_id=$this->playlists_model->insert($data);
				if($insert_id!=0){
					if(isset($_FILES['image'])){
						//$this->load->helper('Ultils');
						$dir=create_sub_dir_upload('uploads/playlists/');
						$filename=$_FILES['image']['name'];
						$_FILES['image']['name']=rename_upload_file($filename);
						$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
						$config['max_size']	= '25000';
						$config['upload_path']=$dir;
						$this->load->library('upload',$config);
						if ($this->upload->do_upload('image'))
						{
							$array=array();
							$image=$dir.'/'.$_FILES['image']['name'];
							$upload_data=$this->upload->data();
							$width=$upload_data['image_width'];
							$height=$upload_data['image_height'];

	                    	$thumb_width=$width;
	                    	if($thumb_width>1000){
							  $thumb_width=floor(($width*50)/100);
						    }
							$thumb_heigth=ceil(($thumb_width*$height)/$width);

							$config=array(
                                "source_image" => $image, //get original image
							    "new_image" =>  $dir, //save as new image //need to create thumbs first
							    "maintain_ratio" => true,
							    "width" => $thumb_width,
							    "height"=>$thumb_heigth
							);

							$this->load->library('image_lib',$config);
							$this->image_lib->resize();


							$thumb= $dir.'/'.$_FILES['image']['name'];
							$data['image']=$thumb;
							$data['width']=$thumb_width;
							$data['height']=$thumb_heigth;
							$this->playlists_model->update($data,array('id'=>$insert_id));

							$this->session->set_flashdata('msg_ok', $this->lang->line('add_successfully'));
							redirect(base_url().'admin/playlists/create');
						}else{
							$this->session->set_flashdata('msg_error', $this->upload->display_errors());
							redirect(base_url().'admin/playlists/create');
						}
					}
				}
			}
		}
		$this->template->write_view('content','backends/playlists/add');
		$this->template->render();
	}

	public function edit_get(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$data['obj']=$this->playlists_model->get_by_id($id);
			$this->load->model('playlists_model');
			$this->template->write_view('content','backends/playlists/edit',$data);
			$this->template->render();
		}
	}

	public function edit_post(){
		if(isset($_POST['id'])){
			$id=$_POST['id'];

			$obj=$this->playlists_model->get_by_id($id);
		    if($obj==null){
			   redirect('notfound');
		    }

			$name=$_POST['name'];
			$this->form_validation->set_rules('name','name', 'trim|required|min_length[2]|max_length[200]|xss_clean');
			if($this->form_validation->run()){
				if(!empty($_FILES['image']['tmp_name'])){
					$filename=$_FILES['image']['name'];
					$_FILES['image']['name']=rename_upload_file($filename);
					$dir=create_sub_dir_upload('uploads/playlists/');
					$config['allowed_types'] = 'JPEG|jpg|JPG|png';
					$config['max_size'] = '25000';
					$config['upload_path'] = $dir;
					$this->load->library('upload',$config);
					if (!$this->upload->do_upload('image')){
						$this->session->set_flashdata('msg_failed',$this->upload->display_errors());
						redirect(base_url().'admin/playlists/edit_get?id='.$id);
					}else{
						try {
							unlink($obj[0]->image);
						} catch (Exception $e) {
							echo $e;
						}

						$array=array();
						$image=$dir.'/'.$_FILES['image']['name'];
						$upload_data=$this->upload->data();
						$width=$upload_data['image_width'];
						$height=$upload_data['image_height'];
	                    
	                    $thumb_width=$width;

	                    if($thumb_width>1000){
						   $thumb_width=floor(($width*50)/100);
					    }
						$thumb_heigth=ceil(($thumb_width*$height)/$width);

						$config=array(
                                "source_image" => $image, //get original image
							    "new_image" =>  $dir, //save as new image //need to create thumbs first
							    "maintain_ratio" => true,
							    "width" => $thumb_width,
							    "height"=>$thumb_heigth
							);

						$this->load->library('image_lib',$config);
						$this->image_lib->resize();


						$thumb= $dir.'/'.$_FILES['image']['name'];
						$data['image']=$thumb;
						$data['width']=$thumb_width;
						$data['height']=$thumb_heigth;
						$this->playlists_model->update($data,array('id'=>$insert_id));

						$this->playlists_model->update(array('image'=>$dir.'/'.	$_FILES['image']['name']),array('id'=>$id));
					}
				}

				$this->playlists_model->update(array('name'=>$name),array('id'=>$id));
				$this->session->set_flashdata('msg_ok',$this->lang->line('edit_successfully'));
				redirect(base_url().'admin/playlists/edit_get?id='.$id);
			}

			$data['obj']=$this->playlists_model->get_by_id($id);
			$this->load->model('playlists_model');
			$data['parent_cat']=$this->playlists_model->get_by_parent_id(0);
			$this->template->write_view('content','backends/playlists/edit',$data);
			$this->template->render();
		}
	}

	public function delete(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$obj=$this->playlists_model->get_by_id($id);
			try {
				unlink($obj[0]->image);
			} catch (Exception $e) {

			}
			$this->playlists_model->remove_by_id($id);
			redirect('admin/playlists');
		}
	}

	public function search(){
		if(isset($_GET['query'])){
			$query=$this->input->get('query');
			$data=parent::getDataView();
			$page     = $this->input->get('page') ? $this->input->get('page') : 0;
			$per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
			$order    = $this->input->get('order') ? $this->input->get('order') : 'DESC';
			$config['total_rows'] = $this->playlists_model->total(array(), array('name'=>$query));
			$config['base_url']= base_url() . 'index.php/admin/playlists/search?order='.$order.'&query='.$query;
			$config['per_page']=$per_page;
			$data['msg_label']=$this->config->item('msg_label');
			$this->pagination->initialize($config);
			$data['list'] = $this->playlists_model->get_by_name($query,$page,$per_page);
			// var_dump($data['list']);
			$data['page_link'] = $this->pagination->create_links();
			$data['search_title']='Result search for "'.$query.'"';
			$this->template->write_view('content','backends/playlists/index',$data);
			$this->template->render();
		}
	}
}
?>
