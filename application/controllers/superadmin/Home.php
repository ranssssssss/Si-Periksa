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
	 if($this->session->userdata('superadmin') != TRUE){
    redirect(base_url(''));
     exit;
	};
	  $this->load->model('m_periksa');
}

	public function index($id='')
	{
		// $data=$this->m_periksa->view_id_periksa($id)->row_array(),
		$kode_tgl = date('Y-m-d');

		$view = array('judul'      		=>'Data Antrian Periksa',
						'aksi'      	=>'lihat',
						'data'      	=>$this->m_periksa->view($tgl=$kode_tgl)->result_array(),
						'kode_tgl'		=>$kode_tgl,
	  );

	 $this->load->view('superadmin/home',$view);
	}
	
}