<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Backup extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
   $this->load->helper('url');
   // needed ???
   $this->load->database();
   $this->load->library('session');
   $this->load->dbutil(); // Load Database Utility Library
  $this->load->helper('file'); // Load File Helper
	 // error_reporting(0);
	 if($this->session->userdata('superadmin') != TRUE){
    redirect(base_url(''));
     exit;
	};
   $this->load->model('m_admin'); 
}


  public function index() {
        $folderPath = FCPATH . 'themes/backup/';  // Path ke folder yang ingin Anda baca
        $files = scandir($folderPath);

        // Menyaring entri "`.`" dan "`..`" dari daftar file
        $filteredFiles = array_diff($files, array('.', '..'));

        $view = array('judul'     =>'Backup Database',
                      'files'     => $filteredFiles  ,
        );

    $this->load->view('superadmin/backup/form',$view);
  }

  public function backupDatabase() {
    // Nama file backup
    date_default_timezone_set('Asia/Jakarta');
    $timestamp = date('d-F-Y_H-i-s');
    $backup_file_name = 'backup_' . $timestamp . '.sql';

    // Konfigurasi database
    $db_config = array(
        'format'      => 'sql', // Format backup
        'filename'    => $backup_file_name, // Nama file backup
        'add_drop'    => TRUE, // Menambahkan perintah DROP TABLE
        'add_insert'  => TRUE, // Menambahkan perintah INSERT INTO
        'newline'     => "\n", // Karakter baris baru
    );

    // Backup database
    $backup = $this->dbutil->backup($db_config);

    // Simpan file backup di direktori tertentu (misal: themes/backup/)
    write_file('themes/backup/' . $backup_file_name, $backup);

    if ($backup) {
        $response = array(
            'status' => 'success',
            'message' => 'Database backup successful',
            'filename' => $backup_file_name
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Database backup failed'
        );
    }

    // Set response content type to JSON
    $this->output->set_content_type('application/json');
    // Encode the response as JSON and send it to the client
    $this->output->set_output(json_encode($response));
  }

  public function restoreDatabase() {
    $file_path = 'themes/backup/' . $_FILES['file']['name'];

    // Disable foreign key constraints
    $this->db->query('SET FOREIGN_KEY_CHECKS=0');

    // Baca isi file cadangan SQL
    $sql = file_get_contents($file_path);

    // Pisahkan pernyataan SQL
    $sql_commands = explode(";\n", $sql);

    // Mulai transaksi
    $this->db->trans_start();

    // Eksekusi pernyataan SQL kembali untuk mengembalikan data
    foreach ($sql_commands as $command) {
        if (trim($command) !== "") {
            $this->db->query($command);
        }
    }

    // Selesaikan transaksi
    $this->db->trans_complete();

    // Enable foreign key constraints
    $this->db->query('SET FOREIGN_KEY_CHECKS=1');

    if ($this->db->trans_status() === FALSE) {
        // Transaksi gagal, ada kesalahan dalam mengembalikan data
        $response = array(
            'status' => 'error',
            'message' => 'Failed to restore data'
        );
    } else {
        // Transaksi berhasil, data telah dikembalikan
        $response = array(
            'status' => 'success',
            'message' => 'Database restore successful'
        );
    }

    // Set response content type to JSON
    $this->output->set_content_type('application/json');
    // Encode the response as JSON and send it to the client
    $this->output->set_output(json_encode($response));
}


public function hapusBackup() {
    $backup = $this->input->post('backup'); // Ambil nilai dari parameter backup

    if ($backup !== null) {
        $file_path = FCPATH . 'themes/backup/' . $backup;

        // Hapus file backup
        if (unlink($file_path)) {
            $response = array(
                'status' => 'success',
                'message' => 'Database backup deleted'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Database backup failed to delete'
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Invalid backup parameter'
        );
    }

    // Set response content type to JSON
    $this->output->set_content_type('application/json');
    // Encode the response as JSON and send it to the client
    $this->output->set_output(json_encode($response));
}



}