<?php
class Settings extends CI_Controller{
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
		$this->load->helper('settings');
		$this->form_validation->set_error_delimiters('<div class="error-line">', '</div>');
	}

	function general(){
		if(isset($_POST['about'])){
			$settings['privacy_policy']=stripslashes(str_replace('\n', '', $this->input->post('privacy_policy')));
			$settings['about']=htmlentities($this->input->post('about'));
			$settings['address']=$this->input->post('address');
			$settings['website']=$this->input->post('website');
			$settings['twitter']=$this->input->post('twitter');
			$settings['facebook']=$this->input->post('facebook');
			$settings['instagram']=$this->input->post('instagram');
			$settings['youtube']=$this->input->post('youtube');
			$settings['mail']=$this->input->post('mail');
			$settings['phone']=$this->input->post('phone');
			$settings['version']=$this->input->post('version');
			$settings['app_name']=$this->input->post('app_name');


			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			if(isset($_FILES['app_logo'])){
				$filename=$_FILES['app_logo']['name'];
				$_FILES['app_logo']['name']=rename_logo_app_name($filename);
			}

			if ($this->upload->do_upload('app_logo'))
			{
			    $settings['app_logo']='uploads/'.$_FILES['app_logo']['name'];
			}

			setSettings($settings,GENERAL_SETTING_FILE);
		}
		$data['obj']=getSettings(GENERAL_SETTING_FILE);
		$data['heading']=$this->lang->line('msg_settings').'-'.$this->lang->line('msg_general');
		$this->template->write_view('content','backends/settings/general',$data);
		$this->template->render();
	}

	function reset_general_settings(){
		resetGeneral();
		redirect('admin/settings/general');
	}

	function payments(){
		if(isset($_POST['public_key'])){
			$public_key=$this->input->post('public_key');
			$secret_key=$this->input->post('secret_key');
			$settings=array();
			$settings['public_key']=$public_key;
			$settings['secret_key']=$secret_key;
			setSettings($settings,PAYMENT_SETTING_FILE);
		}

		$data['obj']=getSettings(PAYMENT_SETTING_FILE);
		$this->template->write_view('content','backends/settings/payment',$data);
		$this->template->render();
	}

	function reset_payments_settings(){
		resetPayments();
		redirect('admin/settings/payments');
	}

	function mail(){
		if(isset($_POST['host'])){
			$host=$this->input->post('host');
			$user=$this->input->post('user');
			$pwd=$this->input->post('pwd');
			$port=$this->input->post('port');
			$mailpath=$this->input->post('mail_path');
			$from_user=$this->input->post('from_user');
			$from_email=$this->input->post('from_email');
			$settings=getSettings(EMAIL_SETTING_FILE);
			$settings['smtp_host']        = $host;
			$settings['smtp_user']        = $user;
			$settings['smtp_pass']        = $pwd;
			$settings['smtp_port']        = $port;
			$settings['from_email']       = $from_email;
			$settings['from_user'] =        $from_user;
			$settings['mailpath']         = $mailpath;
			setSettings($settings,EMAIL_SETTING_FILE);
		}
		$data['obj']=getSettings(EMAIL_SETTING_FILE);
		$this->template->write_view('content','backends/settings/email',$data);
		$this->template->render();
	}

	function reset_mail_settings(){
		resetEmail();
		redirect('admin/settings/mail');
	}

	function push(){
		if(isset($_POST['app_id'])){
			$app_id=$this->input->post('app_id');
			$rest_key=$this->input->post('rest_key');

			$settings=getSettings(PUSH_SETTING_FILE);
			$settings['app_id']        = $app_id;
			$settings['rest_key']        = $rest_key;
			setSettings($settings,PUSH_SETTING_FILE);
		}
		$data['obj']=getSettings(PUSH_SETTING_FILE);
		$this->template->write_view('content','backends/settings/push',$data);
		$this->template->render();
	}

	function reset_push(){
		resetPush();
		redirect('admin/settings/push');
	}

	function ads(){
		if(isset($_POST['app_ad_id'])){
			$app_ad_id=$this->input->post('app_ad_id');
			$banner_ad_unit=$this->input->post('banner_ad_unit');
			$in_ad_unit=$this->input->post('in_ad_unit');


			$settings=getSettings(ADS_SETTING_FILE);
			$settings['app_ad_id']        = $app_ad_id;
			$settings['banner_ad_unit']        = $banner_ad_unit;
			$settings['in_ad_unit']=$in_ad_unit;

			setSettings($settings,ADS_SETTING_FILE);
		}
		$data['obj']=getSettings(ADS_SETTING_FILE);
		$this->template->write_view('content','backends/settings/ads',$data);
		$this->template->render();
	}


	function reset_ads(){
		resetAds();
		redirect('admin/settings/ads');
	}

	function download(){
		if(isset($_POST['allow_download'])){
			$allow_download= $this->input->post('allow_download');

					$settings=getSettings(DOWNLOAD_SETTING_FILE);
			$settings['allow_download']=$allow_download;
			setSettings($settings,DOWNLOAD_SETTING_FILE);
		}

		$data['obj']=getSettings(DOWNLOAD_SETTING_FILE);
		$this->template->write_view('content','backends/settings/download',$data);
		$this->template->render();
	}

	function reset_download(){
		resetDownload();
		redirect('admin/settings/download');
	}

}
?>
