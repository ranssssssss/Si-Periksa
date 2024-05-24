<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $judul ?></title>
    <meta name="keywords" content="<?= $nama_judul ?>, <?= $meta_keywords ?>, <?= $meta_description ?>, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta name="description" content="<?= $nama_judul ?>, <?= $meta_keywords ?>, <?= $meta_description ?>">
    <meta name="author" content="KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta content='index,follow' name='robots'/>

    <!-- Bootstrap -->
    <link href="<?= base_url('themes/gentelella') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('themes/gentelella') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('themes/gentelella') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url('themes/gentelella') ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('themes/gentelella') ?>/build/css/custom.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- select2 -->
    <link rel="stylesheet" href="<?= base_url('themes/gentelella') ?>/vendors/select2/dist/css/select2.min.css">

    <!-- Favicon -->
    <link href="<?= base_url('themes') ?>/favicon.ico" rel="icon">

    <!-- sweetalert -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  </head>

  <body class="login" background="<?= base_url('themes/foto_background/'.$background) ?>" style="background-size: cover; background-attachment: fixed;">
  <?= $this->session->flashdata('pesan') ?>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <form action="" method="post">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" name="email" placeholder="Email" required="" autocomplete="off" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" autocomplete="off" />
              </div>
              <div>
                <button type="submit" name="login" class="btn btn-primary submit">Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Belum punya akun?
                  <a href="#signup" class="to_register"><u> Daftar sekarang </u></a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
					<strong>Copyright &copy; <?php echo date('Y'); ?>
                        <?php  $nama_judul = $this->db->get('tb_pengaturan')->row_array(); ?>
					    <a href="https://bit.ly/kassandrahdproduction" target="blank"><?= $nama_judul['nama_judul'] ?>.</a></strong> <br> All rights reserved.
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form id="add" method="post">
              <h1>Create New Account Pasien</h1>
              <div>
                <span class="col-md-12" style="text-align: left;">Nama Lengkap :</span>
                <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap anda" required="" autocomplete="off" />
              </div>

              <div>
                <span class="col-md-12" style="text-align: left;">Nomor Induk Kependudukan (NIK) :</span>
                <input type="text" class="form-control" name="nik" placeholder="Masukkan NIK dengan benar" required="" autocomplete="off" maxlength="16" minlength="16">
              </div>

              <div>
                <span class="col-md-12" style="text-align: left;">Tanggal Lahir :</span>
                <input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir" required="" autocomplete="off" value="<?= date('Y-m-d') ?>" />
              </div>
                  <br>
              <div>
                <span class="col-md-12" style="text-align: left;">Jenis Kelamin :</span>
                <select name="jenis_kelamin" class="form-control" required="">
                  <option value="">-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
                  <br>
              <div>
                <span class="col-md-12" style="text-align: left;">Nomor HP :</span>
                <input type="number" class="form-control" name="no_hp" placeholder="Masukkan No HP dengan benar" required="" autocomplete="off" />
              </div>
                  <br>
                  
              <div>
                <span class="col-md-12" style="text-align: left;">Provinsi :</span>
                <select id="provinsi" onchange="populateKabupaten()" class="form-control select2" required="">
                  <!-- Pilihan Provinsi akan diisi secara dinamis dari API -->
                </select>
              </div>
                  <br>
              <div>
                 <span class="col-md-12" style="text-align: left;">Kabupaten/Kota :</span>
                  <select id="kabupaten" name="kab" onchange="populateKecamatan()" class="form-control select2" required="" disabled>
                    <option value=''>Pilih Kabupaten/Kota</option>
                  </select>
              </div>
                  <br>
              <div>
                  <span class="col-md-12" style="text-align: left;">Kecamatan :</span>
                  <select id="kecamatan" name="kec" onchange="populateKelurahan()" class="form-control select2" required="" disabled>
                    <option value=''>Pilih Kecamatan</option>
                  </select>
              </div>
                  <br>
              <div>
                  <span class="col-md-12" style="text-align: left;">Kelurahan/Desa :</span>
                  <select id="kelurahan" name="kelurahan" class="form-control select2" required="" onchange="populateAlamat()" disabled>
                    <option value=''>Pilih Kelurahan/Desa</option>
                  </select>
              </div>
                  <br>
              <div>
                  <span class="col-md-12" style="text-align: left;">Alamat :</span>
                  <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required="" autocomplete="off" disabled>
              </div>
              <div>
                <span class="col-md-12" style="text-align: left;">Email :</span>
                <input type="email" class="form-control" name="email" placeholder="Masukkan email aktif anda" required="" autocomplete="off" />
              </div>
              <div>
                <span class="col-md-12" style="text-align: left;">Password :</span>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" autocomplete="off" />
              </div>
              <br>
              <div>
                <button type="submit" class="btn btn-primary submit">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Sudah punya akun ?
                  <a href="#signin" class="to_register"><u> Log in </u></a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
					<strong>Copyright &copy; <?php echo date('Y'); ?>
                        <?php  $nama_judul = $this->db->get('tb_pengaturan')->row_array(); ?>
					    <a href="https://bit.ly/kassandrahdproduction" target="blank"><?= $nama_judul['nama_judul'] ?>.</a></strong> <br> All rights reserved.
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

<script type="text/javascript">
  //register data
  $(document).ready(function() {
      $('#add').submit(function(e) {
          e.preventDefault();
          $.ajax({
              url: "<?= site_url('register/api_add') ?>",
              type: "POST",
              data: new FormData(this),
              processData: false,
              contentType: false,
              cache: false,
              async: false,
              success: function(data) {
                  if (data.status) {
                      $('#add')[0].reset();
                      swal({
                          title: "Berhasil",
                          text: "Data berhasil ditambahkan",
                          type: "success",
                          showConfirmButton: true,
                          confirmButtonText: "OKEE",
                      });
                      setTimeout(function() {
                          window.location.href = "<?= site_url('login') ?>";
                      }, 1000);
                  } else {
                      // Hapus tag HTML dari pesan error
                      var errorMessage = $('<div>').html(data.message).text();
                      swal({
                          title: "Gagal",
                          text: errorMessage, // Menampilkan pesan error dari server
                          type: "error",
                          showConfirmButton: true,
                          confirmButtonText: "OK",
                      });
                  }
              },
              error: function(xhr, textStatus, errorThrown) {
                  // Menampilkan pesan error jika terjadi kesalahan pada AJAX request
                  swal({
                      title: "Error",
                      text: "Terjadi kesalahan saat mengirim data",
                      type: "error",
                      showConfirmButton: true,
                      confirmButtonText: "OK",
                  });
              }
          });
      });
  });
  
 //API Wilayah
fetch('https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json')
          .then(response => response.json())
          .then(provinces => {
            var data = provinces;
            var tampung = '<option value="">Pilih Provinsi</option>';
            data.forEach(element => {
              tampung += `<option data-region="${element.id}" value="${element.name}">${element.name}</option>`;
            });
            document.getElementById('provinsi').innerHTML = tampung;
          })

        function populateKabupaten() {
          var provinsi = document.getElementById('provinsi').value;

          // Menonaktifkan dropdown kabupaten
          document.getElementById('kabupaten').disabled = true;

          // Menonaktifkan dropdown kecamatan
          document.getElementById('kecamatan').disabled = true;

          // Menonaktifkan input kelurahan
          document.getElementById('kelurahan').disabled = true;

          // Menonaktifkan input alamat
          document.getElementById('alamat').disabled = true;

          if (provinsi) {
            var region = document.querySelector(`#provinsi option[value="${provinsi}"]`).dataset.region;
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${region}.json`)
              .then(response => response.json())
              .then(regencies => {
                var data = regencies;
                var tampung = '<option value="">Pilih Kabupaten/Kota</option>';
                data.forEach(element => {
                  tampung += `<option data-region="${element.id}" value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('kabupaten').innerHTML = tampung;

                // Mengaktifkan dropdown kabupaten
                document.getElementById('kabupaten').disabled = false;
              })
          }
        }

        function populateKecamatan() {
                var kabupaten = document.getElementById('kabupaten').value;

                // Menonaktifkan dropdown kecamatan
                document.getElementById('kecamatan').disabled = true;

                // Menonaktifkan input kelurahan
                document.getElementById('kelurahan').disabled = true;

                // Menonaktifkan input alamat
                document.getElementById('alamat').disabled = true;

                if (kabupaten) {
                  var region = document.querySelector(`#kabupaten option[value="${kabupaten}"]`).dataset.region;
                  fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${region}.json`)
                    .then(response => response.json())
                    .then(districts => {
                      var data = districts;
                      var tampung = '<option value="">Pilih Kecamatan</option>';
                      data.forEach(element => {
                        tampung += `<option data-region="${element.id}" value="${element.name}">${element.name}</option>`;
                      });
                      document.getElementById('kecamatan').innerHTML = tampung;

                      // Mengaktifkan dropdown kecamatan
                      document.getElementById('kecamatan').disabled = false;
                    })
                }
              }

              function populateKelurahan() {
                var kecamatan = document.getElementById('kecamatan').value;

                // Menonaktifkan input kelurahan
                document.getElementById('kelurahan').disabled = true;

                // Menonaktifkan input alamat
                document.getElementById('alamat').disabled = true;

                if (kecamatan) {
                  var region = document.querySelector(`#kecamatan option[value="${kecamatan}"]`).dataset.region;
                  fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${region}.json`)
                    .then(response => response.json())
                    .then(villages => {
                      var data = villages;
                      var tampung = '<option value="">Pilih Kelurahan/Desa</option>';
                      data.forEach(element => {
                        tampung += `<option value="${element.name}">${element.name}</option>`;
                      });
                      document.getElementById('kelurahan').innerHTML = tampung;

                      // Mengaktifkan input alamat
                      document.getElementById('kelurahan').disabled = false;
                    })
                }
              }
              
              function populateAlamat() {
                var kelurahan = document.getElementById('kelurahan').value;

                // Menonaktifkan input alamat
                document.getElementById('alamat').disabled = true;

                if (alamat) {
                  // Mengaktifkan input alamat
                  document.getElementById('alamat').disabled = false;
                }

                }

    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    })
  
  </script>
<!-- Select2 -->
<script src="<?= base_url('themes/gentelella') ?>/vendors/select2/dist/js/select2.full.min.js"></script>
</body>
</html>