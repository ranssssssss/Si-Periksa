<?php
/**
 * PHP for Codeigniter
 *
 * @package        	CodeIgniter
 * @pengembang		Kassandra Production (https://kassandra.my.id)
 * @Author			@erikwahyudy
 * @version			3.0
 */

defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends CI_controller
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
	  $this->load->model('m_periksa');
}

	public function index($id='')
	{
		$data=$this->m_periksa->view_id_pasien($id)->row_array();
		$tgl_periksa = $data['tgl_periksa'];

		$kode_tgl = date('Y-m-d');

		$view = array('judul'      			=> 'Home',
						'aksi'      		=> 'lihat',
						'data'      		=> $this->m_periksa->view($tgl=$kode_tgl)->result_array(),
						'tgl_periksa'		=> $tgl_periksa,
						'antrian_berikut' 	=> $this->m_periksa->view($tgl=$tgl_periksa)->result_array(),
						'kode_tgl'			=> $kode_tgl,
	  );

	 $this->load->view('pasien/home',$view);
	}
	
}