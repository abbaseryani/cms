<?php
class audios extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['user'])) {
			redirect('admin/dashboard');
		} else {
			$user = $_SESSION['user'][0];
			if ($user->perm == USER) {
				redirect('admin/denied');
			}
		}
		$this->load->model('audios_model');
		$this->form_validation->set_error_delimiters('<span class="help-inline msg-error" generated="true">', '</span>');
	}

	function index()
	{
		$base_url = base_url() . 'admin/audios';
		$page     = $this->uri->segment(3);
		if (!is_numeric($page) || $page <= 0) {
			$page = 1;
		}
		$first             = ($page - 1) * $this->pg_per_page;
		$total_rows        = $this->audios_model->total(array(), array());
		$data['list']      = $this->audios_model->get("*,audios.id as id,albums.name as album_name,audios.name as name, audios.activated as activated", array(), array(), $first, $this->pg_per_page, array(
			'audios.id' => 'DESC'
		));
		$data['page_link'] = parent::pagination_config($base_url, $total_rows, $this->pg_per_page);
		$this->render_backend_tp('backends/audios/index', $data);
	}

	public function add_audio()
	{
		if (isset($_FILES['file_audio'])) {
			$dir                          = create_sub_dir_upload('uploads/audios/');
			$filename                     = $_FILES['file_audio']['name'];
			$_FILES['file_audio']['name'] = rename_upload_file($filename);
			$config['allowed_types']      = 'mp3|wav';
			$config['max_size']           = '50000';
			$config['upload_path']        = $dir;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('file_audio')) {
				echo json_encode(array(
					'success' => 1,
					'path' => $dir . '/' . $_FILES['file_audio']['name']
				));
			} else {
				echo json_encode(array(
					'success' => 0
				));
			}
		}
	}

	public function create()
	{
		if (isset($_POST['name'])) {
			$this->form_validation->set_rules('name', 'name', 'trim|required|min_length[1]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('duration', 'duration', 'trim|required|xss_clean');
			$this->form_validation->set_rules('categories', 'categories', 'required');
			$path = $this->input->post('path');
			if ($this->form_validation->run() != false) {
				if (isset($_FILES['image'])) {
					$dir                     = create_sub_dir_upload('uploads/audios/');
					$filename                = $_FILES['image']['name'];
					$_FILES['image']['name'] = rename_upload_file($filename);
					$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
					$config['max_size']      = '50000';
					$config['upload_path']   = $dir;
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('image')) {
						$array       = array();
						$image       = $dir . '/' . $_FILES['image']['name'];
						$upload_data = $this->upload->data();
						$width       = $upload_data['image_width'];
						$height      = $upload_data['image_height'];

						$thumb_width = $width;
						if ($thumb_width > 1000) {
							$thumb_width = floor(($width * 50) / 100);
						}
						$thumb_heigth = ceil(($thumb_width * $height) / $width);

						$config = array(
                            "source_image" => $image, //get original image
                            "new_image" => $dir, //save as new image //need to create thumbs first
                            "maintain_ratio" => true,
                            "width" => $thumb_width,
                            "height" => $thumb_heigth
                          );

						$this->load->library('image_lib', $config);
						$this->image_lib->resize();


						$thumb          = $dir . '/' . $_FILES['image']['name'];
						$data['thumb']  = $thumb;
						$data['width']  = $thumb_width;
						$data['height'] = $thumb_heigth;

						$user                  = $_SESSION['user'][0];
						$categories            = $this->input->post('categories');
						$categories            = implode(',', $categories);
						$data['description']   = $this->input->post('description');
						$data['tags']          = $this->input->post('tags');
						$data['categories_id'] = $categories;
						$data['user_id']       = $user->id;
						$data['name']          = $this->input->post('name');
						$data['path']          = $this->input->post('path');
						$data['duration']      = $this->input->post('duration');


						$playlist_id = '';
						$playlists   = json_decode($this->input->post('playlists_list'), true);
						foreach ($playlists as $r) {
							$playlist_id .= $r . ',';
						}
						$playlist_id = rtrim($playlist_id, ',');
                        $album_id    = $this->input->post('albums_list'); //rtrim($album_id,',');
                        
                        $artist_id = '';
                        $artist    = json_decode($this->input->post('artists_list'), true);
                        foreach ($artist as $r) {
                        	$artist_id .= $r . ',';
                        }
                        $artist_id           = rtrim($artist_id, ',');
                        $data['playlist_id'] = $playlist_id;
                        $data['album_id']    = $album_id;
                        $data['artist_id']   = $artist_id;
                        
                        $insert_id = $this->audios_model->insert($data);
                        if ($insert_id != null) {
                        	$this->load->model('playlists_model');
                        	foreach ($playlists as $r) {
                        		$playlist = $this->playlists_model->get_by_id($r);
                        		if ($playlist != null) {
                        			$total_track = (int) $playlist[0]->number_of_track + 1;
                        			$this->playlists_model->update(array(
                        				'number_of_track' => $total_track
                        			), array(
                        				'id' => $r
                        			));
                        		}
                        	}
                        }

                        $this->session->set_flashdata('msg_ok', $this->lang->line('add_successfully'));
                        redirect(base_url() . 'admin/audios/create');
                      } else {
                       try {
                        unlink($path);
                      }
                      catch (Exception $e) {

                      }

                      $this->session->set_flashdata('msg_error', 'Upload failed, Please choose thumbnail - ' . $this->upload->display_errors());
                      redirect(base_url() . 'admin/audios/create');
                    }
                  } else {
                   try {
                    unlink($path);
                  }
                  catch (Exception $e) {

                  }
                  $this->session->set_flashdata('msg_error', 'Upload failed, Please choose thumbnail');
                }
              } else {
               try {
                unlink($path);
              }
              catch (Exception $e) {

              }
              $this->session->set_flashdata('msg_error', 'Upload failed, Try Again');
              redirect(base_url() . 'admin/audios/create');
            }
          }
          $this->load->model('categories_model');
          $data['categories'] = $this->categories_model->get();
          $this->template->write_view('content', 'backends/audios/add', $data);
          $this->template->render();
        }

        public function edit_get()
        {
         if (isset($_GET['id'])) {
          $id          = $this->input->get('id');
          $data['obj'] = $this->audios_model->get_by_id($id);
          $this->load->model('categories_model');
          $data['categories'] = $this->categories_model->get();
          $this->load->model('audios_model');
          $this->template->write_view('content', 'backends/audios/edit', $data);
          $this->template->render();
        }
      }

      public function edit_post()
      {
       if (isset($_POST['id'])) {
        $id  = $_POST['id'];
        $obj = $this->audios_model->get_by_id($id);
        if ($obj == null) {
         redirect('notfound');
       }

       $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[1]|max_length[200]|xss_clean');
       $this->form_validation->set_rules('duration','duration', 'trim|required|xss_clean');
       $this->form_validation->set_rules('categories', 'categories', 'required');

       if ($this->form_validation->run()) {
         $data= array();
         if (!empty($_FILES['image']['tmp_name'])) {
          $filename                = $_FILES['image']['name'];
          $_FILES['image']['name'] = rename_upload_file($filename);
          $dir                     = create_sub_dir_upload('uploads/audios/');
          $config['allowed_types'] = 'JPEG|jpg|JPG|png';
          $config['max_size']      = '25000';
          $config['upload_path']   = $dir;
          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('image')) {
           $this->session->set_flashdata('msg_failed', $this->upload->display_errors());
           redirect(base_url() . 'admin/audios/edit_get?id=' . $id);
         } else {
           try {
            unlink($obj[0]->path);
          }
          catch (Exception $e) {
            echo $e;
          }


          $image       = $dir . '/' . $_FILES['image']['name'];
          $upload_data = $this->upload->data();
          $width       = $upload_data['image_width'];
          $height      = $upload_data['image_height'];

          $thumb_width = $width;

          if ($thumb_width > 1000) {
            $thumb_width = floor(($width * 50) / 100);
          }
          $thumb_heigth = ceil(($thumb_width * $height) / $width);

          $config = array(
                            "source_image" => $image, //get original image
                            "new_image" => $dir, //save as new image //need to create thumbs first
                            "maintain_ratio" => true,
                            "width" => $thumb_width,
                            "height" => $thumb_heigth
                          );

          $this->load->library('image_lib', $config);
          $this->image_lib->resize();

          $thumb                 = $dir . '/' . $_FILES['image']['name'];
          $data['thumb']         = $thumb;
          $data['width']         = $thumb_width;
          $data['height']        = $thumb_heigth;
        }
      }

      $user                  = $_SESSION['user'][0];
      $categories            = $this->input->post('categories');
      $categories            = implode(',', $categories);
      $data['description']   = $this->input->post('description');
      $data['tags']          = $this->input->post('tags');
      $data['categories_id'] = $categories;
      $data['user_id']       = $user->id;
      $data['name']          = $this->input->post('name');
      $data['path']          = $this->input->post('path');
      $data['duration']      = $this->input->post('duration');

      $playlist_id = '';
      $playlists   = json_decode($this->input->post('playlists_list'), true);
      foreach ($playlists as $r) {
       $playlist_id .= $r . ',';
     }
     $playlist_id = rtrim($playlist_id, ',');

     $album_id=$this->input->post('albums_list');

     $artist_id = '';
     $artist    = json_decode($this->input->post('artists_list'), true);
     foreach ($artist as $r) {
       $artist_id .= $r . ',';
     }
     $artist_id           = rtrim($artist_id, ',');
     $data['playlist_id'] = $playlist_id;
     $data['album_id']    = $album_id;
     $data['artist_id']   = $artist_id;

     $this->load->model('playlists_model');
     foreach ($playlists as $r) {
      $playlist = $this->playlists_model->get_by_id($r);
      if ($playlist != null) {
       $total_track = (int) $playlist[0]->number_of_track + 1;
       $this->playlists_model->update(array(
        'number_of_track' => $total_track
      ), array(
        'id' => $r
      ));
     }
   }


   $this->audios_model->update($data, array(
     'id' => $id
   ));
   $this->session->set_flashdata('msg_ok', $this->lang->line('edit_successfully'));
   redirect(base_url() . 'admin/audios/edit_get?id=' . $id);
 }
 $this->load->model('categories_model');
 $data['categories'] = $this->categories_model->get();
 $data['obj']        = $this->audios_model->get_by_id($id);
 $this->template->write_view('content', 'backends/audios/edit', $data);
 $this->template->render();
}
}

public function delete()
{
 if (isset($_GET['id'])) {
  $id  = $this->input->get('id');
  $obj = $this->audios_model->get_by_id($id);
  try {
   unlink($obj[0]->path);
   unlink($obj[0]->thumb);
 }
 catch (Exception $e) {

 }
 $this->audios_model->remove_by_id($id);
 redirect('admin/audios');
}
}


public function activate()
{
 if (isset($_GET['id'])) {
  $id = $this->input->get('id');
  echo $id;
  $this->audios_model->update(array(
   'activated' => 1
 ), array(
   'audios.id' => $id
 ));
}
redirect('admin/audios');
}

public function deactivate()
{
 if (isset($_GET['id'])) {
  $id = $this->input->get('id');
  $this->audios_model->update(array(
   'activated' => 0
 ), array(
   'audios.id' => $id
 ));
}
redirect('admin/audios');
}

public function search()
{
 if (isset($_GET['query'])) {
  $query                = $this->input->get('query');
  $data                 = parent::getDataView();
  $page                 = $this->input->get('page') ? $this->input->get('page') : 0;
  $per_page             = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
  $order                = $this->input->get('order') ? $this->input->get('order') : 'DESC';
  $config['total_rows'] = $this->audios_model->total(array(), array(
    'audios.name' => $query
  ));
  $config['base_url']   = base_url() . 'index.php/admin/audios/search?order=' . $order . '&query=' . $query;
  $config['per_page']   = $per_page;
  $data['msg_label']    = $this->config->item('msg_label');
  $this->pagination->initialize($config);
  $data['list']         = $this->audios_model->get_by_name($query, $page, $per_page);
  $data['page_link']    = $this->pagination->create_links();
  $data['search_title'] = 'Result search for "' . $query . '"';
  $this->template->write_view('content', 'backends/audios/index', $data);
  $this->template->render();
}
}
}
?>