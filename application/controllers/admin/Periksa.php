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
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
    $this->load->model('m_pasien');
    $this->load->model('m_periksa');
	}

    //Lihat Data
    public function add_periksa($value='')
    {
     $view = array('judul'      =>'Buat Jadwal Periksa',
                    'aksi'      =>'lihat',
                    'data'      =>$this->m_pasien->view()->result_array(),
                  );

      $this->load->view('admin/periksa/add',$view);
    }

    //diperiksa
    public function data_periksa($tgl='')
    {
      if (isset($_POST['cari'])) {
        $tgl = $this->input->post('tgl');

        $view = array('judul'      =>'Data Periksa',
                        'aksi'      =>'lihat',
                        'data'      =>$this->m_periksa->view_diperiksa($tgl)->result_array(),
                        'tgl'       =>$tgl,
                        'depan'    =>FALSE,
                      );

          $this->load->view('admin/periksa/diperiksa',$view);
        }else{
          $view = array('judul'     =>'Buka Data Periksa',
                        'aksi'      =>'buka_periksa',
                        'depan'    =>TRUE,
                      );
          $this->load->view('admin/periksa/diperiksa',$view);
        }
      }

    //sdh periksa
    public function sdh_periksa($tgl='')
    {
      if (isset($_POST['cari'])) {
        $tgl = $this->input->post('tgl');

        $view = array('judul'      =>'Data Sudah Periksa',
                        'aksi'      =>'lihat',
                        'data'      =>$this->m_periksa->view_sdh($tgl)->result_array(),
                        'tgl'       =>$tgl,
                        'depan'    =>FALSE,
                      );

          $this->load->view('admin/periksa/sdh_periksa',$view);
        }else{
          $view = array('judul'     =>'Buka Data Periksa',
                        'aksi'      =>'buka_periksa',
                        'depan'    =>TRUE,
                      );
          $this->load->view('admin/periksa/sdh_periksa',$view);
        }
      }

    //Belum periksa
    public function blm_periksa($tgl='')
    {
      if (isset($_POST['cari'])) {
        $tgl = $this->input->post('tgl');

        $view = array('judul'      =>'Data Antrian Periksa',
                        'aksi'      =>'lihat',
                        'data'      =>$this->m_periksa->view_blm($tgl)->result_array(),
                        'tgl'       =>$tgl,
                        'depan'    =>FALSE,
                      );

          $this->load->view('admin/periksa/blm_periksa',$view);
        }else{
          $view = array('judul'     =>'Buka Data Antrian',
                        'aksi'      =>'buka_antrian',
                        'depan'    =>TRUE,
                    );
          $this->load->view('admin/periksa/blm_periksa',$view);
        }
      }

    //Batal periksa
    public function btl_periksa($tgl='')
    {
      if (isset($_POST['cari'])) {
        $tgl = $this->input->post('tgl');

        $view = array('judul'      =>'Data Batal Periksa',
                        'aksi'      =>'lihat',
                        'data'      =>$this->m_periksa->view_btl($tgl)->result_array(),
                        'tgl'       =>$tgl,
                        'depan'    =>FALSE,
                      );

          $this->load->view('admin/periksa/btl_periksa',$view);
        }else{
          $view = array('judul'     =>'Buka Data Batal Periksa',
                        'aksi'      =>'buka_btlperiksa',
                        'depan'    =>TRUE,
                    );
          $this->load->view('admin/periksa/btl_periksa',$view);
        }
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
          array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Status tidak boleh kosong',
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
            'status'          =>$this->input->post('status'),
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
      
      

      //API hapus
      public function api_hapus($id='')
      {
        if(empty($id)){
          $response = [
            'status' => false,
            'message' => 'Data kosong'
          ];
        }else{
          if ($this->m_periksa->delete($id)) {
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


    //API diperiksa
    public function diperiksa($id='') {
      if(empty($id)){
        $response = [
          'status' => false,
          'message' => 'Tidak ada data yang dipilih'
        ];
      }else{
        $SQLupdate=array(
          'status'                    =>'D'
        );
        $cek=$this->m_periksa->update($id,$SQLupdate);
        if($cek){
          $response = [
            'status' => true,
            'message' => 'Berhasil'
          ];
          //mengirim email ke pelanggan dengan phpmailer
          //dibawahini untuk script phpmailer
        }else{
          $response = [
            'status' => false,
            'message' => 'Gagal'
          ];
        }
      }
      echo json_encode($response);
    }

     //API sdh periksa
     public function sudah_periksa($id='', $SQLupdate='')
     {
       $rules = array(
         array(
           'field' => 'catatan',
           'label' => 'catatan',
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
           'catatan'                   =>$this->input->post('catatan'),
           'status'                    =>'S',
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

    //API batal_periksa
    public function batal_periksa($id='') {
      if(empty($id)){
        $response = [
          'status' => false,
          'message' => 'Tidak ada data yang dipilih'
        ];
      }else{
        $SQLupdate=array(
          'status'                    =>'BTL'
        );
        $cek=$this->m_periksa->update($id,$SQLupdate);
        if($cek){
          $response = [
            'status' => true,
            'message' => 'Berhasil'
          ];
          //mengirim email ke pelanggan dengan phpmailer
          //dibawahini untuk script phpmailer
        }else{
          $response = [
            'status' => false,
            'message' => 'Gagal'
          ];
        }
      }
      echo json_encode($response);
    }

	
}