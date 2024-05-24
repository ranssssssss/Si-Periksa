<?php $this->load->view('template/header'); ?>
<?= $this->session->flashdata('pesan') ?>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <a href="javascript:void(0)" onclick="backupdatabase()" class="btn btn-primary btn-sm"><i
                        class="fa fa-database"></i> Backup Database</a>
                <!-- rata kiri untuk modal restore database -->
                <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-restore"><i
                        class="fa fa-upload"></i> Restore Database</a>

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
                                        <th>Backup File</th>
                                        <th>Size</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($files as $backup): ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td>
                                            <?= $backup ?>
                                            <a href="<?= base_url('themes/backup/'.$backup) ?>"
                                                class="btn btn-primary btn-sm" target="_blank" download><i
                                                    class="fa fa-download"></i>
                                                Download</a>
                                            <a href="javascript:void(0)" onclick="hapusbackup('<?= $backup ?>')"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                                Hapus</a>
                                        </td>
                                        <td><?= round(filesize('themes/backup/'.$backup)/1024,2) ?> KB</td>
                                    </tr>
                                    <?php $no++; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div>


    <!-- modal restore database -->
    <div class="modal fade" id="modal-restore" tabindex="-1" role="dialog" aria-labelledby="modal-restoreLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-restoreLabel">Tambah <?= $judul ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="" style="width:100%">
                       <form id="restoreDatabase" method="POST" enctype="multipart/form-data">
                        <tr>
                            <td>
                                <label for="">Pilih File Database</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="file" name="file" class="form-control" required="" accept=".sql">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                <a href="" class="btn btn-primary" data-dismiss="modal">Kembali</a>
                                &emsp;
                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                            </td>
                        </tr>
                        </form>
                    </table>                 
                </div>
            </div>
        </div>
    </div>
    <!-- end modal restore database -->


    <script type="text/javascript">
    //ajax backup database
    function backupdatabase() {
        swal({
            title: "Apakah Anda Yakin?",
            text: "Data Akan Di Backup",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Backup!",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result.value) { // Only backup the database if the user clicked "OK"
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('superadmin/Backup/backupDatabase/') ?>",
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Data Berhasil Di Backup",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "Data Gagal Di Backup",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal Backup", "Data Tidak Jadi Di Backup", "error");
            }
        });
    }

    //ajax restore database
    $('#restoreDatabase').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        swal({
            title: "Apakah Anda Yakin?",
            text: "Data Akan Di Restore",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Restore!",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result
                .value
            ) { // Only restore the database if the user clicked "OK"
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('superadmin/Backup/restoreDatabase/') ?>",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Data Berhasil Di Restore",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "Data Gagal Di Restore",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal Restore", "Data Tidak Jadi Di Restore",
                    "error");
            }
        });
    });

    //ajax hapus backup
    function hapusbackup(backup) {
        swal({
            title: "Apakah Anda Yakin?",
            text: "Data Akan Di Hapus",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result.value) { // Only delete the backup if the user clicked "OK"
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('superadmin/Backup/hapusBackup/') ?>",
                    data: {
                        backup: backup
                    },
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Data Berhasil Di Hapus",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "Data Gagal Di Hapus",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal Hapus", "Data Tidak Jadi Di Hapus", "error");
            }
        });
    }
    </script>
    <?php $this->load->view('template/footer'); ?>