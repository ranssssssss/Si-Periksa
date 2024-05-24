<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Periksa extends CI_controller
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
    $this->load->model('m_periksa');
	}

    //Lihat Data
    public function index($id='')
    {
     $view = array('judul'      =>'Riwayat Periksa',
                    'aksi'      =>'lihat',
                    'data'      =>$this->m_periksa->view_id_pasien($id)->result_array(),
                  );

      $this->load->view('pasien/periksa/lihat',$view);
    }

    //Tambah Data
    public function add_periksa($id='')
    {
      $data=$this->m_pasien->view_id_pasien($id)->row_array();

      $view = array('judul'       =>'Buat Jadwal Periksa',
                    'aksi'        =>'lihat',
                    'id_pasien'   =>$data['id_pasien'],
                    'nama'        =>$data['nama'],
                    'umur'        =>$tgl_lahir = date('Y') - substr($data['tgl_lahir'], 0, 4),
                  );

      $this->load->view('pasien/periksa/add',$view);
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
     private function id_periksa_urut($value='')
     {
     $this->m_periksa->id_urut();
     $query   = $this->db->get();
     $data    = $query->row_array();
     $id      = $data['id_periksa'];
     $karakter= $this->acak_id(6);
     $urut    = substr($id, 1, 3);
     $tambah  = (int) $urut + 1;
     
     if (strlen($tambah) == 1){
     $newID = "A"."00".$tambah.$karakter;
         }else if (strlen($tambah) == 2){
         $newID = "A"."0".$tambah.$karakter;
             }else (strlen($tambah) == 3){
             $newID = "A".$tambah.$karakter
             };
         return $newID;
     }

  //API add
  public function api_add($value='')
  {
    $rules = array(
      array(
        'field' => 'id_pasien',
        'label' => 'ID Pasien',
        'rules' => 'required',
        'errors' => array(
            'required' => 'ID Pasien tidak boleh kosong',
          ),
        ),
      array(
          'field' => 'umur',
          'label' => 'Umur',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Umur tidak boleh kosong',
            ),
          ),
      array(
          'field' => 'tgl_periksa',
          'label' => 'Tanggal Periksa',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Tanggal Periksa tidak boleh kosong',
            ),
          ),
      array(
          'field' => 'keluhan',
          'label' => 'Keluhan',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Keluhan tidak boleh kosong',
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
        'id_periksa'      =>$this->id_periksa_urut(),
        'id_pasien'       =>$this->input->post('id_pasien'),
        'umur'            =>$this->input->post('umur'),
        'tgl_periksa'     =>$this->input->post('tgl_periksa'),
        'keluhan'         =>$this->input->post('keluhan'),
        'status'          =>'BL',
      ];
      if ($this->m_periksa->add($SQLinsert)) {
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
            'field' => 'keluhan',
            'label' => 'Keluhan',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Keluhan tidak boleh kosong',
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
            'keluhan'         =>$this->input->post('keluhan'),
          ];
          if ($this->m_periksa->update($id, $SQLupdate)) {
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
	
}