<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Pasien extends CI_controller
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
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_pasien');
	}

    //Lihat Data
    public function index($value='')
    {
     $view = array('judul'      =>'Data Pasien',
                    'aksi'      =>'lihat',
                    'data'      =>$this->m_pasien->view()->result_array(),
                  );

      $this->load->view('admin/pasien/lihat',$view);
    }

    //Tambah Data
    public function tambah_data($value='')
    {
     $view = array('judul'      =>'Tambah Data Pasien',
                    'aksi'      =>'tambah',
                  );

      $this->load->view('admin/pasien/tambah',$view);
    }

    private function acak_id($panjang)
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{$pos};
        }
        return $string;
    }
    
     //mengambil id urut terakhir
     private function id_pasien_urut($value='')
     {
     $this->m_pasien->id_urut();
     $query   = $this->db->get();
     $data    = $query->row_array();
     $id      = $data['id_pasien'];
     $karakter= $this->acak_id(6);
     $urut    = substr($id, 1, 3);
     $tambah  = (int) $urut + 1;
     
     if (strlen($tambah) == 1){
     $newID = "P"."00".$tambah.$karakter;
         }else if (strlen($tambah) == 2){
         $newID = "P"."0".$tambah.$karakter;
             }else (strlen($tambah) == 3){
             $newID = "P".$tambah.$karakter
             };
         return $newID;
     }

  //API add
  public function api_add($value='')
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
          'rules' => 'required|is_unique[tb_pasien.nik]',
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
          'rules' => 'required|is_unique[tb_pasien.no_hp]',
          'errors' => array(
              'required' => 'No HP tidak boleh kosong',
              'is_unique' => 'No HP sudah terdaftar, silahkan gunakan No HP lain',
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
          'rules' => 'required|valid_email|is_unique[tb_pasien.email]',
          'errors' => array(
              'required' => 'Email tidak boleh kosong',
              'valid_email' => 'Email tidak valid',
              'is_unique' => 'Email sudah terdaftar',
            ),
          ),
      array(
          'field' => 'password',
          'label' => 'Password',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Password tidak boleh kosong',
            ),
          ),
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == FALSE) {
      $response = [
        'status' => false,
        'message' => validation_errors(),
      ];
    } else {
      $SQLinsert = [
        'id_pasien'      =>$this->id_pasien_urut(),
        'nama'           =>$this->input->post('nama'),
        'nik'            =>$this->input->post('nik'),
        'tgl_lahir'      =>$this->input->post('tgl_lahir'),
        'jenis_kelamin'  =>$this->input->post('jenis_kelamin'),
        'no_hp'          =>$this->input->post('no_hp'),
        'alamat'         =>$this->input->post('alamat'),
        'kelurahan'      =>$this->input->post('kelurahan'),
        'kec'            =>$this->input->post('kec'),
        'kab'            =>$this->input->post('kab'),
        'email'          =>$this->input->post('email'),
        'password'       =>md5($this->input->post('password')),
      ];
      if ($this->m_pasien->add($SQLinsert)) {
        $response = [
          'status' => true,
          'message' => 'Berhasil menambahkan data'
        ];
      } else {
        $response = [
          'status' => false,
          'message' => 'Gagal menambahkan data'
        ];
      }
  }
  
  $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
}

      //API edit
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
              'rules' => 'required|valid_email',
              'errors' => array(
                  'required' => 'Email tidak boleh kosong',
                  'valid_email' => 'Email tidak valid',
                ),
              ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
          $response = [
            'status' => false,
            'message' => validation_errors(),
          ];
        } else {
          $SQLupdate = [
            'nama'           =>$this->input->post('nama'),
            'nik'            =>$this->input->post('nik'),
            'tgl_lahir'      =>$this->input->post('tgl_lahir'),
            'jenis_kelamin'  =>$this->input->post('jenis_kelamin'),
            'no_hp'          =>$this->input->post('no_hp'),
            'alamat'         =>$this->input->post('alamat'),
            'kelurahan'      =>$this->input->post('kelurahan'),
            'kec'            =>$this->input->post('kec'),
            'kab'            =>$this->input->post('kab'),
            'email'          =>$this->input->post('email'),
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
      

      //API hapus
      public function api_hapus($id='')
      {
        if(empty($id)){
          $response = [
            'status' => false,
            'message' => 'Data kosong'
          ];
        }else{
          if ($this->m_pasien->delete($id)) {
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