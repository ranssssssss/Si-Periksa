<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Profile extends CI_controller
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
	 if($this->session->userdata('pasien') != TRUE){
    redirect(base_url(''));
     exit;
	};
   $this->load->model('m_pasien'); 
}


  public function index($id='')
  {

  $data=$this->m_pasien->view_id_pasien($id)->row_array();
  $x = array(
    'aksi'            =>'lihat',
    'judul'           =>'Data Akun Profile',
    'id_pasien'       =>$data['id_pasien'],
    'nama'            =>$data['nama'],
    'nik'             =>$data['nik'],
    'tgl_lahir'       =>$data['tgl_lahir'],
    'jenis_kelamin'   =>$data['jenis_kelamin'],
    'no_hp'           =>$data['no_hp'],
    'alamat'          =>$data['alamat'],
    'kelurahan'       =>$data['kelurahan'],
    'kec'             =>$data['kec'],
    'kab'             =>$data['kab'],
    'email'           =>$data['email'],
    'password'        =>$data['password'],
    'foto_profile'    =>$data['foto_profile'],
  );
    $this->load->view('pasien/user/profile',$x);
  }

  //API edit pasien
  public function api_edit($id='', $SQLupdate='')
  {
    $rules = array(
      array(
        'field' => 'nama',
        'label' => 'Nama Pasien',
        'rules' => 'required',
        'errors' => array(
            'required' => 'Nama pasien tidak boleh kosong',
          ),
        ),
      array(
          'field' => 'nik',
          'label' => 'NIK',
          'rules' => 'required',
          'errors' => array(
              'required' => 'NIK tidak boleh kosong',
              'is_unique' => 'NIK sudah terdaftar',
            ),
          ),
      array(
          'field' => 'tgl_lahir',
          'label' => 'Tanggal Lahir',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Tanggal Lahir tidak boleh kosong',
            ),
          ),
      array(
          'field' => 'jenis_kelamin',
          'label' => 'Jenis Kelamin',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Jenis Kelamin tidak boleh kosong',
            ),
          ),
      array(
          'field' => 'no_hp',
          'label' => 'No HP',
          'rules' => 'required',
          'errors' => array(
              'required' => 'No HP tidak boleh kosong',
            ),
          ),
      array(
          'field' => 'alamat',
          'label' => 'Alamat',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Alamat tidak boleh kosong',
            ),
          ),
      array(
          'field' => 'kelurahan',
          'label' => 'Kelurahan',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Kelurahan tidak boleh kosong',
            ),
          ),
      array(
          'field' => 'kec',
          'label' => 'Kecamatan',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Kecamatan tidak boleh kosong',
            ),
          ),
      array(
          'field' => 'kab',
          'label' => 'Kabupaten',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Kabupaten tidak boleh kosong',
            ),
          ),
      array(
          'field' => 'email',
          'label' => 'Email',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Email tidak boleh kosong',
              'is_unique' => 'Email sudah terdaftar',
            ),
          ),
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == FALSE) {
      $response = [
        'status' => false,
        'message' => 'Tidak ada data'
      ];
    } else {
      $SQLupdate = [
        'nama'            => $this->input->post('nama'),
        'nik'             => $this->input->post('nik'),
        'tgl_lahir'       => $this->input->post('tgl_lahir'),
        'jenis_kelamin'   => $this->input->post('jenis_kelamin'),
        'no_hp'           => $this->input->post('no_hp'),
        'alamat'          => $this->input->post('alamat'),
        'kelurahan'       => $this->input->post('kelurahan'),
        'kec'             => $this->input->post('kec'),
        'kab'             => $this->input->post('kab'),
        'email'           => $this->input->post('email'),
      ];
      if ($this->m_pasien->update($id, $SQLupdate)) {
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

  //API edit password
  public function api_password($id='', $SQLupdate='')
  {
    $rules = array(
      array(
        'field' => 'password',
        'label' => 'password',
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
        'password'        => md5($this->input->post('password'))
      ];
      if ($this->m_pasien->update($id, $SQLupdate)) {
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
      $config['upload_path']          = './themes/foto_profile/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG';
      $config['max_size']             = 10000;
      $config['max_width']            = 10000;
      $config['max_height']           = 10000;
      $config['file_name']            = 'profile_' . uniqid();
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('foto')) {
        $error = array('error' => $this->upload->display_errors());
        $this->session->set_flashdata('error', $error['error']);
        redirect('pasien/profile/' . $id . '');
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
            'foto_profile'    => $this->berkas($id)
          ];
          if ($this->m_pasien->update($id, $SQLupdate)) {
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
      
       //API hapus data dari database dan folder
       public function api_hapus($id='')
       {
         if (empty($id)) {
           $response = [
             'status' => false,
             'message' => 'Tidak ada data'
           ];
         } else {
           $data = $this->m_pasien->view_id_pasien($id)->row_array();
           $file = $data['foto_profile'];
           unlink('./themes/foto_profile/' . $file);
 
           //SQL update
           $SQLupdate = [
             'foto_profile'    => ''
           ];
           if ($this->m_pasien->update($id, $SQLupdate)) {
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