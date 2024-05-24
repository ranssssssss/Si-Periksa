<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Pengaturan extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      $this->load->library('form_validation');
      
	 // error_reporting(0);
	 if($this->session->userdata('superadmin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_pengaturan');
	}

    //judul
    public function index($value='')
    {
     $view = array('judul'     =>'Pengaturan',
                   'data'      =>$this->m_pengaturan->view(),);
      $this->load->view('superadmin/pengaturan/form',$view);
    }

    public function jadwal_praktek($value='')
    {
     $view = array('judul'     =>'Jadwal Praktek',
                   'data'      =>$this->m_pengaturan->view(),);
      $this->load->view('superadmin/jadwal_praktek/form',$view);
    }


      //API edit judul
      public function api_edit($id='', $SQLupdate='')
      {
        $rules = array(
          array(
            'field' => 'nama_judul',
            'label' => 'nama_judul',
            'rules' => 'required'
          ),
          array(
            'field' => 'meta_keywords',
            'label' => 'meta_keywords',
            'rules' => 'required'
          ),
          array(
            'field' => 'meta_description',
            'label' => 'meta_description',
            'rules' => 'required'
          )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
          $response = [
            'status' => false,
            'message' => 'Tidak ada data'
          ];
        } else {
          $SQLupdate = [
            'nama_judul'        => $this->input->post('nama_judul'),
            'meta_keywords'     => $this->input->post('meta_keywords'),
            'meta_description'  => $this->input->post('meta_description')
          ];
          if ($this->m_pengaturan->update($id, $SQLupdate)) {
            $response = [
              'status' => true,
              'message' => 'Berhasil mengubah data'
            ];
          } else {
            $response = [
              'status' => false,
              'message' => 'Gagal mengubah data'
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
      }


      //mengompres ukuran gambar
      private function compress($source, $destination, $quality) 
      {
          $info = getimagesize($source);
          if ($info['mime'] == 'image/jpeg') 
              $image = imagecreatefromjpeg($source);
          elseif ($info['mime'] == 'image/gif') 
              $image = imagecreatefromgif($source);
          elseif ($info['mime'] == 'image/png') 
              $image = imagecreatefrompng($source);
          imagejpeg($image, $destination, $quality);
          return $destination;
      }

      private function berkas($id='')
    {
      if ($_FILES['foto']['name'] != '') {
      $config['upload_path']          = './themes/foto_background/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG';
      $config['max_size']             = 10000;
      $config['max_width']            = 10000;
      $config['max_height']           = 10000;
      $config['file_name']            = 'header_' . uniqid();
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('foto')) {
        $error = array('error' => $this->upload->display_errors());
        $this->session->set_flashdata('error', $error['error']);
        redirect('superadmin/judul');
      } else {
        $data = array('upload_data' => $this->upload->data());
        $this->compress($data['upload_data']['full_path'], $data['upload_data']['full_path'], 90);
        return $data['upload_data']['file_name'];
      }
    } else {
      return '';
    }
    }

      //API upload foto ke database dan folder
      public function api_upload($id='', $SQLupdate='')
      {
        if (empty($_FILES['foto']['name'])) {
          $data = [
            'status'  => 'error',
            'message' => 'Tidak Ada File Yang Diupload',
          ];
        } else {
          $SQLupdate = [
            'background'    => $this->berkas($id)
          ];
          if ($this->m_pengaturan->update($id, $SQLupdate)) {
            $data = [
              'status'  => 'success',
              'message' => 'Berhasil Upload File',
            ];
          } else {
            $data = [
              'status'  => 'error',
              'message' => 'Gagal Upload File',
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($data));
      }

      public function api_edit_jadwal($id='', $SQLupdate='')
      {
        $rules = array(
          array(
            'field' => 'jdwl_praktek',
            'label' => 'jdwl_praktek',
            'rules' => 'required'
          ),
          array(
            'field' => 'jam_praktek',
            'label' => 'jam_praktek',
            'rules' => 'required'
          ),
          array(
            'field' => 'jdwl_pendaftaran',
            'label' => 'jdwl_pendaftaran',
            'rules' => 'required'
          )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
          $response = [
            'status' => false,
            'message' => 'Tidak ada data'
          ];
        } else {
          $SQLupdate = [
            'jdwl_praktek'      => $this->input->post('jdwl_praktek'),
            'jam_praktek'       => $this->input->post('jam_praktek'),
            'jdwl_pendaftaran'  => $this->input->post('jdwl_pendaftaran')            
          ];
          if ($this->m_pengaturan->update($id, $SQLupdate)) {
            $response = [
              'status' => true,
              'message' => 'Berhasil mengubah data'
            ];
          } else {
            $response = [
              'status' => false,
              'message' => 'Gagal mengubah data'
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
      }

      //API edit status
      public function api_editstatus($id='', $SQLupdate='')
      {
        $rules = array(
          array(
            'field' => 'akses_pendaftaran',
            'label' => 'akses_pendaftaran',
            'rules' => 'required'
          )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
          $response = [
            'status' => false,
            'message' => 'Tidak ada data'
          ];
        } else {
          $SQLupdate = [
            'akses_pendaftaran'    => $this->input->post('akses_pendaftaran')
          ];
          if ($this->m_pengaturan->update($id, $SQLupdate)) {
            $response = [
              'status' => true,
              'message' => 'Berhasil mengubah data'
            ];
          } else {
            $response = [
              'status' => false,
              'message' => 'Gagal mengubah data'
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
      }
      
       
      //API hapus data dari database dan folder
      public function api_hapus($id='')
      {
        if (empty($id)) {
          $response = [
            'status' => false,
            'message' => 'Tidak ada data'
          ];
        } else {
          $data = $this->m_pengaturan->view_id($id)->row_array();
          $file = $data['background'];
          unlink('./themes/foto_background/' . $file);

          //SQL update
          $SQLupdate = [
            'background'    => ''
          ];
          if ($this->m_pengaturan->update($id, $SQLupdate)) {
            $response = [
              'status' => true,
              'message' => 'Berhasil menghapus data'
            ];
          } else {
            $response = [
              'status' => false,
              'message' => 'Gagal menghapus data'
            ];
          }

        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
      }
          
	
}