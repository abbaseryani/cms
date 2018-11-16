<?php
require APPPATH.'/libraries/REST_Controller.php';
class users_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->helper('Ultils');
	}

	function user_get() 
	{ 

		$this->load->model('users_model');
		$first=$this->get('first');
		$offset=$this->get('offset');
		$order=array('created_at'=>'DESC');
		$where=array();
		$like=array();
		$where['activated']=1;

		$fb_id=$this->get('fb_id');
		if($fb_id!=null){
			$where['fb_id']=$fb_id;
		}

		$id=$this->get('id');
		if($id!=null){
			$where['id']=$id;
		}
		
		$data=$this->users_model->get('*',$where,$like,$first,$offset,$order);
		if($data!=null){
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}

	} 

	function pwd_post(){
		$id=$this->post('id');
		if($id!=null){
			$new_pass=$this->post("new_pass");
			$old_pass=$this->post("old_pass");
			$data=$this->users_model->get_by_id($id);

			if($data[0]->pwd==""){
				$new_pass=encrypt_pwd($new_pass);
				$this->users_model->update(array('pwd'=>$new_pass), array('id'=>$id));
				$this->response(array('ok'=>'1'));
			}

			if($data[0]->pwd== encrypt_pwd($old_pass)){
				$new_pass=encrypt_pwd($new_pass);
				$this->users_model->update(array('pwd'=>$new_pass), array('id'=>$id));
				$this->response(array('ok'=>'1'));

			}else{
				$this->response(array('ok'=>'0'));
			}
		}
	}

	function login_post(){
		$email=$this->post('email');
		$pwd=$this->post('pwd');
		if(is_numeric($email)){
			$email=ltrim($email,"0");
		}
		if($email!=null && $pwd!=null){
			$data=$this->users_model->get_by_email_and_pwd($email,encrypt_pwd($pwd));
			if($data!=null){
				$this->response(array('success'=>1,'data'=>$data[0]));
			}else{
				$data=$this->users_model->get_by_phone_and_pwd($email,encrypt_pwd($pwd));
				if($data!=null){
					$this->response(array('success'=>1,'data'=>$data[0]));
				}else{
					$this->response(array('success'=>0));
			    }
			}
		}else{
			$this->response(array('success'=>0));
		}
	}

	function update_post(){
		$id=$this->post('id');
		$full_name=$this->post('full_name');
		$user=$this->users_model->get_by_id($id);
		if($user!=null){
			$data=array('full_name'=>$full_name);
			$this->users_model->update($data,array('id'=>$id));
			$obj = null;
			$obj = $this->users_model->get_by_id($id);
			$this->response(array('success'=>1,'data'=>$obj[0]));
		}else{
			$this->response(array('success'=>0));
		}
	}

	function cancel_register_post(){
		$email=$this->input->post('email');
		$this->load->model('verified_account_model');
		$this->verified_account_model->remove(array('email'=>$email));
	}

	function resend_verified_code_post(){
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$send_code_method=$this->input->post('send_code_method');

		$this->load->model('verified_account_model');
		if($send_code_method==0){
			//if sms method
			$data=$this->verified_account_model->get_by_email($email);
			if($data!=null){
				$this->load->helper('sms');
				$code=substr(md5(uniqid(rand(), true)), 6, 6);
				send_verified_sms($code,$phone);
				$data=array();
				$data['code']=$code;
				$this->verified_account_model->update($data, array('email'=>$email));
			}
		}else{
			//if email method
			$data=$this->verified_account_model->get_by_email($email);
			if($data!=null){
				$this->load->helper('email_ultils');
				$code=substr(md5(uniqid(rand(), true)), 6, 6);
				send_verified_mail($code,$email);
				$data=array();
				$data['code']=$code;
				$this->verified_account_model->update($data, array('email'=>$email));
			}
		}
	}

    //reponse code
    //0 : dont exist user
	function facebook_user_check_get() 
	{ 
		$fb_id=$this->input->get('fb_id');
		$data=$this->users_model->get_by_fb_id($fb_id);
		if($data==null){
			$this->response(array('success'=>0));
		}else{
			$this->response(array('success'=>1,'data'=>$data[0]));
		}
	} 

	//response code
	//0 : email error
	//1 : name error
	//2 : unkown

	function facebook_user_register_post(){
		$fb_id=$this->post('fb_id');
		$fullname=$this->post('full_name');
		$email=$this->post('email');

		$this->load->model('users_model');
		$data=$this->users_model->get_by_exact_email($email);
		if($data!=null){
			$this->response(array('success'=>0));
		}

		$data=array(
			'fb_id'=>$fb_id,
			'email'=>$email,
			'full_name'=>$fullname,
			'avt'=> get_facebook_avt($fb_id, 200, 200),
			'perm'=>USER
			);


		$insert_id = $this->users_model->insert($data);
		if($insert_id!=0){
			$data=$this->users_model->get_by_fb_id($fb_id);
			$this->response(array('success'=>2,'data'=>$data[0]));
		}else{
			$this->response(array('success'=>1));
		}
		$this->response(array('success'=>1));
	}

	function register_post() 
	{ 
			$phone=$this->input->post('phone');

			$check=$this->users_model->get_by_phone($phone);
			if($check!=null){
				$this->response(array('success'=>2));
			}

			$insert_data['phone']=$phone;
			$insert_data['full_name']=$this->input->post('full_name');
			$insert_data['pwd']=encrypt_pwd($this->input->post('pwd'));
			$insert_data['perm']=USER;
			$insert_id = $this->users_model->insert($insert_data);
			if($insert_id!=0){
				$this->response(array('success'=>1));
			}else{
				$this->response(array('success'=>0));
			}
	} 


	function update_avt_post(){
		if(isset($_FILES['avt'])){
			$id=$this->input->post('user_id');
			$config['upload_path'] = 'uploads/avts';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
			$config['max_size']	= '15000';
			$this->load->library('upload', $config);
			$filename=$_FILES['avt']['name'];
			$_FILES['avt']['name']=rename_upload_file($filename);	
			if ($this->upload->do_upload('avt'))
			{
				$user=$this->users_model->get_by_id($id);
				if(file_exists($user[0]->avt)){
					unlink($user[0]->avt);
				}
				$image_path='uploads/avts/'.$_FILES['avt']['name'];
				$data=array('avt'=>$image_path);
				$this->users_model->update($data,array('id'=>$id));	
				$obj=$this->users_model->get_by_id($id);
				$this->response(array('success'=>1,'data'=>$obj[0]));
			}else{
				$this->response(array('success'=>0));
			}
		}
	}

	function send_enquiry_post(){
		if(isset($_POST['email'])){
			$this->load->model('spam_model');
			$reply_to=$this->input->post('reply_to');
			$email=$this->input->post('email');
			$message=$this->input->post('message');
			$user_name=$this->input->post('user_name');
			$data=$this->spam_model->get_by_sender_and_receiver($reply_to,$email);
			$this->load->helper('email_ultils');
			if($data!=null){
				if((time()-strtotime($data[0]->updated_at))>120){
					send_enquiry($message,$email,$reply_to,$user_name);
					$insert_data['sender']=$reply_to;
					$insert_data['receiver']=$email;
					$insert_data['content']=$message;
					$this->spam_model->insert($insert_data);
					$this->response(array('success'=>'1'));
					exit();
				}else{
					//block send email, display error
					$this->response(array('success'=>'0'));
					exit();
				}
			}else{
				send_enquiry($message,$email,$reply_to,$user_name);
				$insert_data['sender']=$reply_to;
				$insert_data['receiver']=$email;
				$insert_data['content']=$message;
				$this->spam_model->insert($insert_data);
				$this->response(array('success'=>'1'));
				exit();
			}
		}	
	}

	function reset_pwd_post(){
		$type=$this->input->post('type');
		$data=$this->input->post('data');
		if($type==0){
			//send sms
			$new_pass=gen_uuid();

			$new_pass=encrypt_pwd($new_pass);
			$this->users_model->update(array('pwd'=>$new_pass),array('phone'=>$data));
		}else{
			//send email
			$new_pass=gen_uuid();

			$new_pass=encrypt_pwd($new_pass);
			$this->users_model->update(array('pwd'=>$new_pass),array('email'=>$data));
		}
	}

	function user_put() 
	{ 
		$data = array('this not available'); 
		$this->response($data); 
	} 

	function user_delete() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	}  




}
?>