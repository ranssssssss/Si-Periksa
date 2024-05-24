<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Keluar extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
   $this->load->helper('url');
   // needed ???
   $this->load->database();
   $this->load->library('session');

  
}


//API keluar dari halaman admin
public function index()
{
    $this->session->sess_destroy(); // hapus semua data sesi pengguna
    $response = array(
        'success' => true,
        'message' => 'Anda berhasil keluar dari halaman menu.'
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}


	
}