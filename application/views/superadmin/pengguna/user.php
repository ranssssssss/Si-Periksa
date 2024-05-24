<?php $this->load->view('template/header'); ?>
<?= $this->session->flashdata('pesan') ?>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPengguna"><i
                        class="fa fa-plus"></i>
                    Tambah</a>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php $no=1; foreach($data as $pengguna): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $pengguna['nama'] ?></td>
                                    <td><?= $pengguna['no_hp'] ?></td>
                                    <td><?= $pengguna['keterangan'] ?></td>
                                    <td><?= $pengguna['email'] ?></td>
                                    <td>
                                        <?php 
                                            if($pengguna['id_level'] == 1){
                                                echo "Superadmin";
                                            }elseif($pengguna['id_level'] == 2){
                                                echo "Admin";
                                            }elseif($pengguna['id_level'] == 3){
                                                echo "User";
                                            }
                                            ?>
                                    <td>
                                        <a href="" class="btn btn-warning" data-toggle="modal"
                                            data-target="#edit<?= $pengguna['id_pengguna'] ?>"><i
                                                class="fa fa-edit"></i> Edit</a>
                                        <a href="" class="btn btn-info" data-toggle="modal"
                                            data-target="#ganti_password<?= $pengguna['id_pengguna'] ?>"><i
                                                class="fa fa-key"></i> Ganti
                                            Password</a>
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


<!-- modal tambah pengguna -->
<div class="modal fade" id="modalTambahPengguna" tabindex="-1" role="dialog" aria-labelledby="modalTambahPenggunaLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPenggunaLabel">Tambah <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="" style="width:100%">
                    <form id="add" method="post">
                        <tr>
                            <td>
                                <label for="nama">Nama:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nama" id="nama" class="form-control" autocomplete="off"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="no_hp">No HP:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" name="no_hp" id="no_hp" class="form-control" autocomplete="off"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="alamat">Alamat:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="keterangan" id="keterangan" class="form-control"
                                    autocomplete="off" required>
                            </td>
                        </tr>
                      
                        <tr>
                            <td>
                                <label for="email">Email:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="email" name="email" id="email" class="form-control" autocomplete="off"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Password:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" name="password" id="password" class="form-control"
                                    autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="id_level">Level:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="id_level" class="form-control">
                                    <?php foreach($level as $lev): ?>
                                    <?php if($lev['id_level'] == 3): ?>
                                    <option value="<?= $lev['id_level'] ?>">
                                        <?= $lev['level'] ?>
                                    </option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                            </td>
                        </tr>
                    </form>
                </table>                       
            </div>
        </div>
    </div>
</div>

<!-- modal edit pengguna -->
<?php foreach($data as $pengguna): ?>
<div class="modal fade" id="edit<?= $pengguna['id_pengguna'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="edit<?= $pengguna['id_pengguna'] ?>Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit<?= $pengguna['id_pengguna'] ?>Label">Edit <?= $judul ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="" style="width:100%">
                  <form id="edit" method="post">
                    <input type="hidden" name="id_pengguna" value="<?= $pengguna['id_pengguna'] ?>">
                        <tr>
                            <td>
                                <label for="nama">Nama:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required
                                    value="<?= $pengguna['nama'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="no_hp">No HP:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" name="no_hp" id="no_hp" class="form-control" autocomplete="off" required
                                    value="<?= $pengguna['no_hp'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="alamat">Alamat:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" autocomplete="off" required
                                    value="<?= $pengguna['keterangan'] ?>">
                            </td>
                        </tr>                       
                        <tr>
                            <td>
                                <label for="email">Email:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="email" name="email" id="email" class="form-control" autocomplete="off" required
                                    value="<?= $pengguna['email'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="id_level">Level:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="id_level" class="form-control">
                                    <?php foreach($level as $lev): ?>
                                    <?php if($lev['id_level'] == 3): ?>
                                    <option value="<?= $lev['id_level'] ?>">
                                        <?= $lev['level'] ?>
                                    </option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                <a href="javascript:void(0)" onclick="hapuspengguna('<?= $pengguna['id_pengguna'] ?>')"
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
<?php foreach($data as $pengguna): ?>
<div class="modal fade" id="ganti_password<?= $pengguna['id_pengguna'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="ganti_password<?= $pengguna['id_pengguna'] ?>Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ganti_password<?= $pengguna['id_pengguna'] ?>Label">Edit <?= $judul ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form id="gantipassword" method="post">
                    <input type="hidden" name="id_pengguna" value="<?= $pengguna['id_pengguna'] ?>">
                        <tr>
                            <td>
                                <label for="ganti_password<?= $pengguna['id_pengguna'] ?>">Ganti Password:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" id="password<?= $pengguna['id_pengguna'] ?>" name="password"
                                class="form-control" required="" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="konfirmasi_password<?= $pengguna['id_pengguna'] ?>">Konfirmasi Password:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" id="konfirmasi_password<?= $pengguna['id_pengguna'] ?>"
                                name="konfirmasi_password" class="form-control" autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" onclick="viewPassword('<?= $pengguna['id_pengguna'] ?>')"> Lihat Password
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
function validasi(id_pengguna) {
    var password = document.getElementById("password" + id_pengguna).value;
    var konfirmasi_password = document.getElementById("konfirmasi_password" + id_pengguna).value;

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
function viewPassword(id_pengguna) {
    var password = document.getElementById("password" + id_pengguna);
    var konfirmasi_password = document.getElementById("konfirmasi_password" + id_pengguna);
    if (password.type === "password") {
        password.type = "text";
        konfirmasi_password.type = "text";
    } else {
        password.type = "password";
        konfirmasi_password.type = "password";
    }
}
</script>


<script>
//add data
$(document).ready(function() {
    $('#add').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('superadmin/pengguna/api_add') ?>",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                if (data.status) {
                    $('#modalTambahPengguna');
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
        url: "<?php echo site_url('superadmin/pengguna/api_edit/') ?>" + form_data.get(
            'id_pengguna'),
        dataType: "json",
        data: form_data,
        processData: false,
        contentType: false,
        //memanggil swall ketika berhasil
        success: function(data) {
            $('#edit' + form_data.get('id_pengguna'));
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
    if (!validasi($(this).find('input[name="id_pengguna"]').val())) {
        return; // Do not proceed with the submission if validation fails
    }
    var form_data = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('superadmin/pengguna/api_password/') ?>" + form_data.get(
            'id_pengguna'),
        dataType: "json",
        data: form_data,
        processData: false,
        contentType: false,
        //memanggil swall ketika berhasil
        success: function(data) {
            $('#ganti_password' + form_data.get('id_pengguna'));
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


//ajax hapus pengguna
function hapuspengguna(id_pengguna) {
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
                url: "<?php echo site_url('superadmin/pengguna/api_hapus/') ?>" +
                    id_pengguna,
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