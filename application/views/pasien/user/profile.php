<?php $this->load->view('template/header'); ?>
<style>
#preview_foto {
    display: none;
}
</style>

<?php 
if($aksi == "lihat"):
?>
<?= $this->session->flashdata('pesan') ?>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <tr>
                                        <th>Nama</th>
                                        <td>
                                            <?= $nama ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td>
                                            <?= $nik ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>
                                            <?= tgl_indo($tgl_lahir) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>
                                            <?= $jenis_kelamin ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>No HP</th>
                                        <td>
                                            <?= $no_hp ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>
                                            <?= $alamat ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kelurahan</th>
                                        <td>
                                            <?= $kelurahan ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <td>
                                            <?= $kec ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten</th>
                                        <td>
                                            <?= $kab ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Email</th>
                                        <td>
                                            <?= $email ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td>
                                            <a href="" class="btn btn-info" data-toggle="modal"
                                                data-target="#ganti_password"><i class="fa fa-key"></i> Ganti
                                                Password</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Foto Profil</th>
                                        <td>
                                            <?php $stt = $foto_profile ?>
                                            <?php if($stt == ""): ?>
                                            <img src="<?= base_url('themes/no_images.png') ?>"
                                                class="img-thumbnail" width="100px">
                                            <a href="" class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#editfoto"><i class="fa fa-edit"></i> Edit Foto</a>
                                            <?php else: ?>
                                            <img src="<?= base_url('themes/foto_profile/'.$foto_profile) ?>"
                                                class="img-thumbnail" width="100px">
                                            <a href="javascript:void(0)" onclick="hapusfoto('<?= $id_pasien ?>')"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus
                                                Foto</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="../pasien/home" class="btn btn-primary">Kembali</a>
                                            &nbsp;&nbsp;
                                            <a href="" class="btn btn-warning" data-toggle="modal"
                                                data-target="#editAkun"><i class="fa fa-edit"></i> Perbarui
                                                Data</a>
                                        </td>
                                    </tr>

                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal edit data akun -->
<div class="modal fade" id="editAkun" tabindex="-1" role="dialog" aria-labelledby="editAkunLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAkunLabel">Edit <?= $judul ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="" style="width:100%">
                  <form id="edit" method="post">
                    <input type="hidden" name="id_pasien" value="<?= $id_pasien ?>" class="form-control" readonly>
                    <tr>
                        <td>
                            <label for="nama">Nama</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $nama ?>"
                                autocomplete="off" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nik">NIK</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="nik" id="nik" class="form-control" value="<?= $nik ?>"
                                autocomplete="off" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="tgl_lahir">Tanggal Lahir</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="<?= $tgl_lahir ?>"
                                autocomplete="off" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" <?php if($jenis_kelamin == "Laki-laki"){echo "selected";} ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if($jenis_kelamin == "Perempuan"){echo "selected";} ?>>Perempuan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="no_hp">No HP</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= $no_hp ?>"
                                autocomplete="off" required>
                        </td>
                    </tr>
                    <div id="modal-default">
                    <tr>
                        <td>
                            <label for="provinsi">Provinsi</label>
                    </tr>
                    <tr>
                        <td>
                            <select name="provinsi" id="provinsi" class="form-control select2" style="width: 100%;" onchange="populateKabupaten()" required>
                                <option value="">Pilih Provinsi</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="kab">Kabupaten</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="kab" id="kabupaten" class="form-control select2" style="width: 100%;" onchange="populateKecamatan()" required disabled>
                                <option value=""><?= $kab ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="kec">Kecamatan</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="kec" id="kecamatan" class="form-control select2" style="width: 100%;" onchange="populateKelurahan()" required disabled>
                                <option value=""><?= $kec ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="kelurahan">Kelurahan</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="kelurahan" id="kelurahan" class="form-control select2" style="width: 100%;" onchange="populateAlamat()" required disabled>
                                <option value=""><?= $kelurahan ?></option>
                            </select>
                        </td>
                    </tr>
                    </div>
                    <tr>
                        <td>
                            <label for="alamat">Alamat</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $alamat ?>"
                                autocomplete="off" required disabled>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label for="email">Email</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $email ?>"
                                autocomplete="off" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <button type="submit" name="kirim" class="btn btn-primary">Simpan
                                Perubahan</button>
                        </td>
                    </tr>
                    
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal ganti password  -->
<div class="modal fade" id="ganti_password" tabindex="-1" role="dialog" aria-labelledby="ganti_passwordLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ganti_passwordLabel">Ganti Password
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="" style="width:100%">
                  <form id="gantipassword" method="post">
                    <input type="hidden" name="id_pasien" value="<?= $id_pasien ?>" class="form-control" readonly>
                    <tr>
                        <td>
                            <label for="password">Password Baru</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password Baru" autocomplete="off" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="konfirmasi_password">Konfirmasi Password
                                Baru</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control"
                                placeholder="Konfirmasi Password Baru" autocomplete="off" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" onclick="viewPassword()"> Lihat
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <button type="submit" name="kirim" class="btn btn-primary">Simpan
                                Perubahan</button>
                        </td>
                    </tr>
                    
                    </form>
                </table>                
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal edit foto -->
<div class="modal fade" id="editfoto" tabindex="-1" role="dialog" aria-labelledby="editfotoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editfotoLabel">Ganti Password
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="" style="width:100%">
                   <form id="editfoto" method="post">
                    <input type="hidden" name="id_pasien" value="<?= $id_pasien ?>" class="form-control" readonly>
                    <tr>
                        <td>
                            <label for="foto">Foto Profile</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="file" name="foto" id="bukti_foto_profile" class="form-control"
                                onchange="previewLOGO()" autocomplete="off" accept="image/*" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img id="preview_foto" alt="image preview" width="50%" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <button type="submit" name="kirim" class="btn btn-primary">Simpan
                                Perubahan</button>
                        </td>
                    </tr>

                    </form>
                </table>                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
//validasi password
function validasi() {
    var password = document.getElementById("password").value;
    var konfirmasi_password = document.getElementById("konfirmasi_password").value;
    if (password != konfirmasi_password) {
        // Display Swal for password mismatch
        swal({
            title: "Password Tidak Sama",
            text: "Silakan pastikan password yang dimasukkan sama dengan password baru anda",
            type: "error",
            showConfirmButton: true,
            confirmButtonText: "OKEE",
        });
        return false;
    }
    return true;
}

//view password
function viewPassword() {
    var password = document.getElementById("password");
    var konfirmasi_password = document.getElementById("konfirmasi_password");
    if (password.type === "password") {
        password.type = "text";
        konfirmasi_password.type = "text";
    } else {
        password.type = "password";
        konfirmasi_password.type = "password";
    }
}

//preview Logo
function previewLOGO() {
    document.getElementById("preview_foto").style.display = "block";
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("bukti_foto_profile").files[0]);

    oFReader.onload = function(oFREvent) {
        document.getElementById("preview_foto").src = oFREvent.target.result;
    };

};

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

</script>


<?php endif; ?>

<script>
//edit akun
$(document).on('submit', '#edit', function(e) {
    e.preventDefault();
    var form_data = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('pasien/profile/api_edit/') ?>" +
            form_data.get('id_pasien'),
        dataType: "json",
        data: form_data,
        processData: false,
        contentType: false,
        //memanggil swall ketika berhasil
        success: function(data) {
            $('#edit' + form_data.get('id_pasien'));
            swal({
                title: "Berhasil",
                text: "Data Berhasil Diubah",
                type: "success",
                showConfirmButton: true,
                confirmButtonText: "OKEE",
            }).then(function() {
                location.reload();
            });
        },
        //memanggil swall ketika gagal
        error: function(data) {
            swal({
                title: "Gagal",
                text: "Data Gagal Diubah",
                type: "error",
                showConfirmButton: true,
                confirmButtonText: "OKEE",
            }).then(function() {
                location.reload();
            });
        }
    });
});

//edit akun
$(document).on('submit', '#gantipassword', function(e) {
    e.preventDefault();

    // Call the validation function
    if (!validasi()) {
        return; // Do not proceed with the submission if validation fails
    }

    var form_data = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('pasien/profile/api_password/') ?>" +
            form_data.get('id_pasien'),
        dataType: "json",
        data: form_data,
        processData: false,
        contentType: false,
        // memanggil swall ketika berhasil
        success: function(data) {
            $('#gantipassword' + form_data.get('id_pasien'));
            swal({
                title: "Berhasil",
                text: "Data Berhasil Diubah",
                type: "success",
                showConfirmButton: true,
                confirmButtonText: "OKEE",
            }).then(function() {
                location.reload();
            });
        },
        // memanggil swall ketika gagal
        error: function(data) {
            swal({
                title: "Gagal",
                text: "Data Gagal Diubah",
                type: "error",
                showConfirmButton: true,
                confirmButtonText: "OKEE",
            }).then(function() {
                location.reload();
            });
        }
    });
});

//upload logo
$(document).on('submit', '#editfoto', function(e) {
    e.preventDefault();
    var form_data = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('pasien/profile/api_upload/') ?>" +
            form_data.get(
                'id_pasien'),
        dataType: "json",
        data: form_data,
        processData: false,
        contentType: false,
        //memanggil swall ketika berhasil
        success: function(data) {
            $('#editfoto' + form_data.get('id_pasien'));
            swal({
                title: "Berhasil",
                text: "Data Berhasil Diubah",
                type: "success",
                showConfirmButton: true,
                confirmButtonText: "OKEE",
            }).then(function() {
                location.reload();
            });
        },
        //memanggil swall ketika gagal
        error: function(data) {
            swal({
                title: "Gagal",
                text: "Data Gagal Diubah",
                type: "error",
                showConfirmButton: true,
                confirmButtonText: "OKEE",
            }).then(function() {
                location.reload();
            });
        }
    });
});


//ajax hapus foto
function hapusfoto(id_pasien) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Foto Akan Dihapus",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Tidak, Batalkan!",
        closeOnConfirm: false,
        closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
    }).then(function(result) {
        if (result
            .value
        ) { // Only delete the data if the user clicked on the confirm button
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('pasien/profile/api_hapus/') ?>" +
                    id_pasien,
                dataType: "json",
            }).done(function() {
                swal({
                    title: "Berhasil",
                    text: "Foto Berhasil Dihapus",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                }).then(function() {
                    location.reload();
                });
            }).fail(function() {
                swal({
                    title: "Gagal",
                    text: "Foto Gagal Dihapus",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                }).then(function() {
                    location.reload();
                });
            });
        } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
            swal("Batal hapus", "Foto Tidak Jadi Dihapus", "error");
        }
    });
}
</script>


<?php $this->load->view('template/footer'); ?>
<?php 

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}

//format tanggal indonesia
function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
  
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

?>