<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notfound extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
        $view = array('judul'  =>'Not Found');
        $this->load->view('error/error',$view);
    }

    public function dalam_pengembangan()
    {   
        $view = array('judul'  =>'Dalam Pengembangan');
        $this->load->view('error/maintenance',$view);
    }

}
