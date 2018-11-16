<?php
class push extends MY_Controller{
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
	}

	private function sendMessage($title,$content,$extra_data, $styles){
		//var_dump($styles);
		//exit();
		$settings=getSettings(PUSH_SETTING_FILE);
		$content = array(
			"en" => $content
		);

		$headings=array(
			"en" => $title
		);
		
		if(count($extra_data)!=0){
			$fields = array(
				'app_id' => $settings['app_id'],
				'included_segments' => array('All'),
				'contents' => $content,
				'headings'=> $headings,
				'data'=>$extra_data,
				'android_background_layout'=>$styles
			);	
		}else{
			$fields = array(
				'app_id' => $settings['app_id'],
				'included_segments' => array('All'),
				'headings'=>$headings,
				'contents' => $content,
				'android_background_layout'=>$styles
			);	
		}
		
		$fields = json_encode($fields);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
			'Authorization: Basic '.$settings['rest_key']));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}

	function index(){
		$settings=getSettings(GENERAL_SETTING_FILE);
		if(isset($_POST['content'])){
			$content = $this->input->post('content');
			$title = $this->input->post('title');

			$categories = $this->input->post('selected_categories');
			$artist = $this->input->post('selected_artist');
			$track = $this->input->post('selected_track');
			$external_url=$this->input->post('external_url');


			$data=array();
			if(is_numeric($categories)){
				$this->load->model('categories_model');
				$obj=$this->categories_model->get_by_id($categories);
				$obj=$obj[0];
				$data['key']=0;
				$data['id']=$categories;
				$data['sub_title']=$obj->name;
				$data['thumb']=$obj->image;
			}

			if(is_numeric($artist)){
				$this->load->model('artists_model');
				$obj=$this->artists_model->get_by_id($artist);
				$obj=$obj[0];
				$data['key']=1;
				$data['id']=$artist;
				$data['sub_title']=$obj->name;
				$data['thumb']=$obj->image;
			}

			if(is_numeric($track)){
				$this->load->model('audios_model');
				$obj=$this->audios_model->get_by_id($track);
				$data['key']=2;
				$data['id']=$track;
				$data['sub_title']=$obj[0]->name;
				$data['thumb']=$obj[0]->thumb;
			}

			if($external_url!=null && $external_url!=''){
				$data['key']=3;
				$data['url']=$external_url;
			}

			$title_color=$this->input->post('title_color');
			$content_color=$this->input->post('content_color');
			$styles = array(
				'image'=>base_url().$settings['app_logo'],
				'headings_color'=>'ff000000', 
				'contents_color'=>'ff000000'
			);

			if($title_color!=null && $title_color!=''){
				$styles['headings_color']=$title_color;
			};

			if($content_color!=null && $content_color!=''){
				$styles['contents_color']=$content_color;
			};

			//upload image notification if have
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			if(isset($_FILES['image'])){
				$filename=$_FILES['image']['name'];
				$_FILES['image']['name']=rename_push_image($filename);
				if ($this->upload->do_upload('image'))
				{
					$styles['image']=base_url().'uploads/'.$_FILES['image']['name'];
				}
			}


			$response = $this->sendMessage($title,$content,$data,$styles);
		}

	
		$this->render_backend_tp('backends/push/index',array('obj'=>$settings));
	}

}

?>