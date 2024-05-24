<?php $this->load->view('template/header'); ?>
<?= $this->session->flashdata('pesan') ?>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPasien"><i
                        class="fa fa-plus"></i>
                    Tambah</a>
        

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Tgl Lahir</th>
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php $no=1; foreach($data as $pasien): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $pasien['nama'] ?></td>
                                    <td><?= $pasien['nik'] ?></td>
                                    <td><?= tgl_indo($pasien['tgl_lahir']) ?></td>
                                    <td>
                                        <?= umur(new DateTime($pasien['tgl_lahir'])) ?> Tahun
                                    </td>
                                    <td><?= $pasien['jenis_kelamin'] ?></td>
                                    <td><?= $pasien['no_hp'] ?></td>
                                    <td><?= $pasien['alamat'] ?>, <?= $pasien['kelurahan'] ?>, <?= $pasien['kec'] ?>, <?= $pasien['kab'] ?></td>
                                    <td>
                                        <a href="" class="btn btn-warning" data-toggle="modal"
                                            data-target="#edit<?= $pasien['id_pasien'] ?>"><i class="fa fa-edit"></i>
                                            Edit</a>
                                    </td>
                                </tr>
                                <?php $no++; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>
</div>


<!-- modal tambah pasien -->
<div class="modal fade" id="modalTambahPasien" tabindex="-1" role="dialog" aria-labelledby="modalTambahPasienLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPasienLabel">Tambah <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="" style="width:100%">
                    <form id="add" method="post">
                        <tr>
                            <td><label for="nama">Nama:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="nama" id="nama" class="form-control" autocomplete="off"
                                    required placeholder="Nama Pasien"></td>
                        </tr>
                        <tr>
                            <td><label for="nik">NIK:</label></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="nik" id="nik" class="form-control" autocomplete="off"
                                    required placeholder="NIK" maxlength="16" minlength="16"></td>
                        </tr>
                        <tr>
                            <td><label for="tgl_lahir">Tanggal Lahir:</label></td>
                        </tr>
                        <tr>
                            <td><input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control"
                                    autocomplete="off" required value="<?= date('Y-m-d'); ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="jenis_kelamin">Jenis Kelamin:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="no_hp">No HP:</label></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="no_hp" id="no_hp" class="form-control" autocomplete="off"
                                    required placeholder="No HP"></td>
                        </tr>
                        <tr>
                            <td><label for="provinsi">Provinsi:</label></td>
                        </tr>
                        <div id="modal-default">
                        <tr>
                            <td>
                                <select id="provinsi" onchange="populateKabupaten()" class="form-control select2" required="" style="width: 100%;">
                                <!-- Pilihan Provinsi akan diisi secara dinamis dari API -->
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="kab">Kabupaten:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <select id="kabupaten" name="kab" onchange="populateKecamatan()" class="form-control select2" style="width: 100%;" required="" disabled>
                                    <option value=''>Pilih Kabupaten/Kota</option>
                                </select>
                            </td>
                        </tr>                       
                        <tr>
                            <td><label for="kec">Kecamatan:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <select id="kecamatan" name="kec" onchange="populateKelurahan()" class="form-control select2" style="width: 100%;" required="" disabled>
                                    <option value=''>Pilih Kecamatan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="kelurahan">Kelurahan:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <select id="kelurahan" name="kelurahan" onchange="populateAlamat()" class="form-control select2" style="width: 100%;" required="" disabled>
                                    <option value=''>Pilih Kelurahan/Desa</option>
                                </select>
                            </td>
                        </tr>
                        </div>
                        <tr>
                            <td><label for="alamat">Alamat:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required="" autocomplete="off" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="email">Email:</label></td>
                        </tr>
                        <tr>
                            <td><input type="email" name="email" id="email" class="form-control" autocomplete="off"
                                    required placeholder="Email"></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password:</label></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password" id="password" class="form-control"
                                    autocomplete="off" required placeholder="Password"></td>
                        </tr>

                        <tr>
                            <td><br><input type="submit" name="kirim" value="Simpan" class="btn btn-success"></td>
                        </tr>
                    </form>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- modal edit pasien -->
<?php foreach($data as $pasien): ?>
<div class="modal fade" id="edit<?= $pasien['id_pasien'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="modalEditPasienLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="modal-title" id="modalEditPasienLabel">Edit <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="" style="width:100%">
                    <form id="edit" method="post">
                        <input type="hidden" name="id_pasien" value="<?= $pasien['id_pasien'] ?>">
                        <tr>
                            <td><label for="nama">Nama:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="nama" id="nama" class="form-control" autocomplete="off"
                                    value="<?= $pasien['nama'] ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="nik">NIK:</label></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="nik" id="nik" class="form-control" autocomplete="off"
                                    value="<?= $pasien['nik'] ?>" required maxlength="16" minlength="16"></td>
                        </tr>
                        <tr>
                            <td><label for="tgl_lahir">Tanggal Lahir:</label></td>
                        </tr>
                        <tr>
                            <td><input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control"
                                    autocomplete="off" value="<?= $pasien['tgl_lahir'] ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="jenis_kelamin">Jenis Kelamin:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="Laki-laki"
                                        <?php if ($pasien['jenis_kelamin'] == 'Laki-laki') { echo 'selected'; } ?>>
                                        Laki-laki</option>
                                    <option value="Perempuan"
                                        <?php if ($pasien['jenis_kelamin'] == 'Perempuan') { echo 'selected'; } ?>>
                                        Perempuan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="no_hp">No HP:</label></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="no_hp" id="no_hp" class="form-control" autocomplete="off"
                                    value="<?= $pasien['no_hp'] ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="alamat">Alamat:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off"
                                    value="<?= $pasien['alamat'] ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="kelurahan">Kelurahan:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="kelurahan" id="kelurahan" class="form-control" autocomplete="off"
                                    value="<?= $pasien['kelurahan'] ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="kec">Kecamatan:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="kec" id="kec" class="form-control" autocomplete="off"
                                    value="<?= $pasien['kec'] ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="kab">Kabupaten:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="kab" id="kab" class="form-control" autocomplete="off"
                                    value="<?= $pasien['kab'] ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email:</label></td>
                        </tr>
                        <tr>
                            <td><input type="email" name="email" id="email" class="form-control" autocomplete="off"
                                    value="<?= $pasien['email'] ?>" required></td>
                        </tr>  
                        <tr>
                            <td><label for="password">Password:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password<?= $pasien['id_pasien'] ?>"><i
                                class="fa fa-key"></i> Ganti Password</a>
                            </td>
                        </tr>                    
                      
                        <tr>
                            <td>
                                <br><input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                <a href="javascript:void(0)" onclick="hapuspasien('<?= $pasien['id_pasien'] ?>')"
                                    class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- modal ganti password -->
<?php foreach($data as $pasien): ?>
<div class="modal fade" id="ganti_password<?= $pasien['id_pasien'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="ganti_password<?= $pasien['id_pasien'] ?>Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ganti_password<?= $pasien['id_pasien'] ?>Label">Edit <?= $judul ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form id="gantipassword" method="post">
                    <input type="hidden" name="id_pasien" value="<?= $pasien['id_pasien'] ?>">
                        <tr>
                            <td>
                                <label for="ganti_password<?= $pasien['id_pasien'] ?>">Ganti Password:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" id="password<?= $pasien['id_pasien'] ?>" name="password"
                                class="form-control" required="" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="konfirmasi_password<?= $pasien['id_pasien'] ?>">Konfirmasi Password:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" id="konfirmasi_password<?= $pasien['id_pasien'] ?>"
                                name="konfirmasi_password" class="form-control" autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" onclick="viewPassword('<?= $pasien['id_pasien'] ?>')"> Lihat Password
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <br><br>
                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                            </td>
                        </tr>
                    </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


<script type="text/javascript">
//validasi password
function validasi(id_pasien) {
    var password = document.getElementById("password" + id_pasien).value;
    var konfirmasi_password = document.getElementById("konfirmasi_password" + id_pasien).value;

    if (password !== konfirmasi_password) {
        // Display Swal for password mismatch
        swal({
            title: "Password Tidak Sama",
            text: "Silakan pastikan password yang dimasukkan sama dengan konfirmasi password",
            type: "error",
            showConfirmButton: true,
            confirmButtonText: "OKEE",
        });
        return false;
    }
    return true;
}


//view password
function viewPassword(id_pasien) {
    var password = document.getElementById("password" + id_pasien);
    var konfirmasi_password = document.getElementById("konfirmasi_password" + id_pasien);
    if (password.type === "password") {
        password.type = "text";
        konfirmasi_password.type = "text";
    } else {
        password.type = "password";
        konfirmasi_password.type = "password";
    }
}

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
                
              
//add data
$(document).ready(function() {
    $('#add').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('superadmin/pasien/api_add') ?>",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                if (data.status) {
                    $('#modalTambahPasien');
                    $('#add')[0].reset();
                    swal({
                        title: "Berhasil",
                        text: "Data berhasil ditambahkan",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE",
                    }).then(function() {
                        location.reload();
                    });
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

//edit file
$(document).on('submit', '#edit', function(e) {
    e.preventDefault();
    var form_data = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('superadmin/pasien/api_edit/') ?>" + form_data.get(
            'id_pasien'),
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

//ganti password
$(document).on('submit', '#gantipassword', function(e) {
    e.preventDefault();
    // Call the validation function
    if (!validasi($(this).find('input[name="id_pasien"]').val())) {
        return; // Do not proceed with the submission if validation fails
    }
    var form_data = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('superadmin/pasien/api_password/') ?>" + form_data.get(
            'id_pasien'),
        dataType: "json",
        data: form_data,
        processData: false,
        contentType: false,
        //memanggil swall ketika berhasil
        success: function(data) {
            $('#ganti_password' + form_data.get('id_pasien'));
            swal({
                title: "Berhasil",
                text: "Password Berhasil Diubah",
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
                text: "Password Gagal Diubah",
                type: "error",
                showConfirmButton: true,
                confirmButtonText: "OKEE",
            }).then(function() {
                location.reload();
            });
        }
    });
});

//ajax hapus pasien
function hapuspasien(id_pasien) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Data Akan Dihapus",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Tidak, Batalkan!",
        closeOnConfirm: false,
        closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
    }).then(function(result) {
        if (result.value) { // Only delete the data if the user clicked on the confirm button
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('superadmin/pasien/api_hapus/') ?>" +
                    id_pasien,
                dataType: "json",
            }).done(function() {
                swal({
                    title: "Berhasil",
                    text: "Data Berhasil Dihapus",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                }).then(function() {
                    location.reload();
                });
            }).fail(function() {
                swal({
                    title: "Gagal",
                    text: "Data Gagal Dihapus",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                }).then(function() {
                    location.reload();
                });
            });
        } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
            swal("Batal hapus", "Data Tidak Jadi Dihapus", "error");
        }
    });
}
</script>

<?php $this->load->view('template/footer'); ?>

<?php

//format tgl indonesia
function tgl_indo($tanggal)
{
    $bulan = array(
        1 => 'Januari',
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
        'Desember');

    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function umur($tgl_lahir)
{
    $tgl_sekarang = new DateTime();
    $umur_tahun = $tgl_lahir->diff($tgl_sekarang)->y;
    $umur_bulan = $tgl_lahir->diff($tgl_sekarang)->m;
    $umur_hari = $tgl_lahir->diff($tgl_sekarang)->d;
    $total_tahun = $umur_tahun;
    
    return $total_tahun;
}
?>