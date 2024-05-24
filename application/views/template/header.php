<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $judul ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <?php  $nama_judul = $this->db->get('tb_pengaturan')->row_array(); ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="keywords" content="<?= $nama_judul['nama_judul'] ?>, <?= $nama_judul['meta_keywords'] ?>, <?= $nama_judul['meta_description'] ?>, kassandra my id, kassandra wifi, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta name="description" content="<?= $nama_judul['meta_description'] ?>">

    <!-- Bootstrap -->
    <link href="<?= base_url('themes/gentelella') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('themes/gentelella') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('themes/gentelella') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?= base_url('themes/gentelella') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('themes/gentelella') ?>/build/css/custom.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Datatables -->
    <link href="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- sweetalert -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

    <!-- select2 -->
    <link rel="stylesheet" href="<?= base_url('themes/gentelella') ?>/vendors/select2/dist/css/select2.min.css">



    <!-- Favicon -->
    <link href="<?= base_url('themes') ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />

  </head>

  <?php
    //error_reporting(0);
    if($this->session->userdata('level') =="1"){
    $id  = $this->session->userdata('id_pengguna');
    $data= $this->db->get_where('tb_pengguna',array('id_pengguna'=>$id))->row_array();
    }elseif($this->session->userdata('level') == "2"){
    $id  = $this->session->userdata('id_pengguna');
    $data= $this->db->get_where('tb_pengguna',array('id_pengguna'=>$id))->row_array();
    }elseif($this->session->userdata('level') == "3"){
    $id  = $this->session->userdata('id_pengguna');
    $data= $this->db->get_where('tb_pengguna',array('id_pengguna'=>$id))->row_array();
    }elseif($this->session->userdata('level') == "4"){
    $id  = $this->session->userdata('id_pasien');
    $data= $this->db->get_where('tb_pasien',array('id_pasien'=>$id))->row_array();
    }
  ?>
  <body class="nav-md ">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
            <?php  $nama_judul = $this->db->get('tb_pengaturan')->row_array(); ?>
              <a href="" class="site_title"><span><?= $nama_judul['nama_judul'] ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <?php if($this->session->userdata('level') == "1"){ ?>
                  <?php if($data['foto_profile'] == ""){ ?>
                  <img src="<?= base_url('themes/no_images.png') ?>" alt="..." class="img-circle profile_img">
                  <?php }else{ ?>
                    <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt="..." class="img-circle profile_img">
                  <?php } ?>
                
                    <?php }elseif($this->session->userdata('level') == "2"){ ?>\
                      <?php if ($data['foto_profile'] == "") { ?>
                        <img src="<?= base_url('themes/no_images.png') ?>" alt="..." class="img-circle profile_img">
                      <?php } else { ?>
                        <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt="..." class="img-circle profile_img">
                      <?php } ?>

                        <?php }elseif($this->session->userdata('level') == "3"){ ?>
                          <?php if ($data['foto_profile'] == "") { ?>
                            <img src="<?= base_url('themes/no_images.png') ?>" alt="..." class="img-circle profile_img">
                          <?php } else { ?>
                            <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt="..." class="img-circle profile_img">
                        <?php } ?>

                        <?php }elseif($this->session->userdata('level') == "4"){ ?>
                          <?php if ($data['foto_profile'] == "") { ?>
                            <img src="<?= base_url('themes/no_images.png') ?>" alt="..." class="img-circle profile_img">
                          <?php } else { ?>
                            <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt="..." class="img-circle profile_img">
                        <?php } ?>
                <?php } ?>

              </div>
              <div class="profile_info">
                <h2><?= $data['nama'] ?></h2>
                <span>
                    <?php if($this->session->userdata('level') == "1"){ ?>
                    Superadmin
                        <?php }elseif($this->session->userdata('level') == "2"){ ?>
                        Admin
                            <?php }elseif($this->session->userdata('level') == "3"){ ?>
                            User
                                <?php }elseif($this->session->userdata('level') == "4"){ ?>
                                Pasien
                                <?php } ?>
                </span>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <?php if($this->session->userdata('level') == "1"){ ?>
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url('superadmin/home') ?>"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="<?= base_url('superadmin/pasien') ?>"><i class="fa fa-child"></i> Data Pasien</a></li>
                  <li><a><i class="fa fa-hospital-o"></i> Data Periksa <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url('superadmin/periksa/add_periksa') ?>">Tambah Data Periksa</a></li>
                      <li><a href="<?= base_url('superadmin/periksa/blm_periksa') ?>">Antrian Periksa</a></li>
                      <li><a href="<?= base_url('superadmin/periksa/sdh_periksa') ?>">Sudah Periksa</a></li>
                      <li><a href="<?= base_url('superadmin/periksa/btl_periksa') ?>">Batal Periksa</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-male"></i> Data Administrator <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url('superadmin/pengguna/admin') ?>">Data Admin</a></li>
                      <li><a href="<?= base_url('superadmin/pengguna/user_superadmin') ?>">Data Superadmin</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url('superadmin/profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
                  <li><a href="<?= base_url('superadmin/pengaturan') ?>"><i class="fa fa-cogs"></i> Pengaturan</a></li>
                  <li><a href="<?= base_url('superadmin/backup') ?>"><i class="fa fa-database"></i> Backup Database</a></li>
                </ul>
              </div>

              <?php }elseif($this->session->userdata('level') == "2"){ ?>
                <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url('admin/home') ?>"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="<?= base_url('admin/pasien') ?>"><i class="fa fa-child"></i> Data Pasien</a></li>
                  <li><a><i class="fa fa-hospital-o"></i> Data Periksa <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url('admin/periksa/add_periksa') ?>">Tambah Data Periksa</a></li>
                      <li><a href="<?= base_url('admin/periksa/blm_periksa') ?>">Antrian Periksa</a></li>
                      <li><a href="<?= base_url('admin/periksa/sdh_periksa') ?>">Sudah Periksa</a></li>
                      <li><a href="<?= base_url('admin/periksa/btl_periksa') ?>">Batal Periksa</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-male"></i> Data Administrator <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url('admin/pengguna/admin') ?>">Data Admin</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url('admin/profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
                </ul>
              </div>

              <?php }elseif($this->session->userdata('level') == "3"){ ?>
                <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url('user/home') ?>"><i class="fa fa-home"></i> Home</a></li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url('user/profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
                </ul>
              </div>

              <?php }elseif($this->session->userdata('level') == "4"){ ?>
                <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url('pasien/home') ?>"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="<?= base_url('pasien/periksa/add_periksa') ?>"><i class="fa fa-child"></i> Daftar Antrian</a></li>
                  <li><a href="<?= base_url('pasien/periksa') ?>"><i class="fa fa-hospital-o"></i> Data Riwayat Periksa</a></li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url('pasien/profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
                </ul>
              </div>


              <?php } ?>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings" href="<?= base_url('superadmin/pengaturan') ?>">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen" href="javascript:void(0)" onclick="toggleFullScreen()">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Dark Mode" href="javascript:void(0)" onclick="darkMode()">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="javascript:void(0)" onclick="keluar()">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
              
                <?php if($this->session->userdata('level') == "1"){ ?>
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <?php if($data['foto_profile'] == ""){ ?>
                      <img src="<?= base_url('themes/no_images.png') ?>" alt=""> <?= $data['nama'] ?>
                      <?php }else{ ?>
                        <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt=""> <?= $data['nama'] ?>
                      <?php } ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <!-- menampilkan foto profile -->
                      <div class="dropdown-item">
                        <?php if($data['foto_profile'] == ""){ ?>
                        <img src="<?= base_url('themes/no_images.png') ?>" alt="" class="img-circle profile_img">
                        <?php }else{ ?>
                          <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt="" class="img-circle profile_img">
                        <?php } ?>
                      </div>
                      <a class="dropdown-item"  href="<?= base_url('superadmin/profile') ?>"> Profile</a>
                        <a class="dropdown-item"  href="<?= base_url('superadmin/pengaturan') ?>">
                          <span class="badge bg-red pull-right">50%</span>
                          <span>Settings</span>
                        </a>
                      <a href="javascript:void(0)" onclick="keluar()" class="dropdown-item"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
                </ul>
                    <?php }elseif($this->session->userdata('level') == "2"){ ?>
                    <ul class=" navbar-right">
                      <li class="nav-item dropdown open" style="padding-left: 15px;">
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                          <?php if ($data['foto_profile'] == "") { ?>
                            <img src="<?= base_url('themes/no_images.png') ?>" alt=""> <?= $data['nama'] ?>
                          <?php } else { ?>
                            <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt=""> <?= $data['nama'] ?>
                          <?php } ?>
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                          <!-- menampilkan foto profile -->
                          <div class="dropdown-item">
                            <?php if ($data['foto_profile'] == "") { ?>
                              <img src="<?= base_url('themes/no_images.png') ?>" alt="" class="img-circle profile_img">
                            <?php } else { ?>
                              <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt="" class="img-circle profile_img">
                            <?php } ?>
                          </div>
                          <a class="dropdown-item"  href="<?= base_url('admin/profile') ?>"> Profile</a>
                          <a href="javascript:void(0)" onclick="keluar()" class="dropdown-item"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                      </li>
                    </ul>
                      <?php }elseif($this->session->userdata('level') == "3"){ ?>
                      <ul class=" navbar-right">
                        <li class="nav-item dropdown open" style="padding-left: 15px;">
                          <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <?php if ($data['foto_profile'] == "") { ?>
                              <img src="<?= base_url('themes/no_images.png') ?>" alt=""> <?= $data['nama'] ?>
                            <?php } else { ?>
                              <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt=""> <?= $data['nama'] ?>
                            <?php } ?>
                          </a>
                          <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <!-- menampilkan foto profile -->
                            <div class="dropdown-item">
                              <?php if ($data['foto_profile'] == "") { ?>
                                <img src="<?= base_url('themes/no_images.png') ?>" alt="" class="img-circle profile_img">
                              <?php } else { ?>
                                <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt="" class="img-circle profile_img">
                              <?php } ?>
                            </div>
                            <a class="dropdown-item"  href="<?= base_url('admin/profile') ?>"> Profile</a>
                            <a href="javascript:void(0)" onclick="keluar()" class="dropdown-item"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                          </div>
                        </li>
                      </ul>
                        <?php }elseif($this->session->userdata('level') == "4"){ ?>
                        <ul class=" navbar-right">
                          <li class="nav-item dropdown open" style="padding-left: 15px;">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                              <?php if ($data['foto_profile'] == "") { ?>
                                <img src="<?= base_url('themes/no_images.png') ?>" alt=""> <?= $data['nama'] ?>
                              <?php } else { ?>
                                <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt=""> <?= $data['nama'] ?>
                              <?php } ?>
                            </a>
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                              <!-- menampilkan foto profile -->
                              <div class="dropdown-item">
                                <?php if ($data['foto_profile'] == "") { ?>
                                  <img src="<?= base_url('themes/no_images.png') ?>" alt="" class="img-circle profile_img">
                                <?php } else { ?>
                                  <img src="<?= base_url('themes/foto_profile') ?>/<?= $data['foto_profile'] ?>" alt="" class="img-circle profile_img">
                                <?php } ?>
                              </div>
                              <a class="dropdown-item"  href="<?= base_url('pasien/profile') ?>"> Profile</a>
                              <a href="javascript:void(0)" onclick="keluar()" class="dropdown-item"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                            </div>
                          </li>
                        </ul>
                <?php } ?>

              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h4><i class="fa fa-dashboard"></i>
                            Dashboard | <small><?= $judul ?></small></h4>
                    </div>
                </div>
                <div class="clearfix"></div>

       