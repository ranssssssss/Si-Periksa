<?php $this->load->view('template/header'); ?>
<style>
#preview_logo {
    display: none;
}
</style>
<?= $this->session->flashdata('pesan') ?>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <?php foreach($data->result_array() as $pengaturan): ?>
                                <thead>
                                <tbody>
                                    <tr>
                                        <th>Judul</th>
                                        <td><?= $pengaturan['nama_judul'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Meta Keywords</th>
                                        <td><?= $pengaturan['meta_keywords'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Meta Deskripsi</th>
                                        <td><?= $pengaturan['meta_description'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Aksi</th>
                                        <td>
                                            <a href="" class="btn btn-warning" data-toggle="modal"
                                                data-target="#edit<?= $pengaturan['id_pengaturan'] ?>"><i
                                                    class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Foto Background</th>
                                        <td>
                                            <?php $stt = $pengaturan['background']  ?>
                                            <?php if($stt == ''){ ?>
                                            <img src="<?= base_url('themes/admin/no_images.png') ?>" width="50px">
                                            <a href="" class="btn btn-xs btn-warning" data-toggle="modal"
                                                data-target="#editlogo<?= $pengaturan['id_pengaturan'] ?>"><i
                                                    class="fa fa-edit"></i></a>
                                            <?php }else{ ?>
                                            <img src="<?= base_url('themes/foto_background/'.$pengaturan['background']) ?>"
                                                width="200px">
                                            <a href="javascript:void(0)"
                                                onclick="hapusfoto('<?= $pengaturan['id_pengaturan'] ?>')"
                                                class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    </thead>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>


    <!-- Modal edit judul-->
    <?php foreach($data->result_array() as $pengaturan): ?>
    <div class="modal fade" id="edit<?= $pengaturan['id_pengaturan'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="edit<?= $pengaturan['id_pengaturan'] ?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit<?= $pengaturan['id_pengaturan'] ?>Label">Edit
                        <?= $judul ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="" style="width:100%">
                        <form id="edit" method="post">
                            <input type="hidden" name="id_pengaturan" value="<?= $pengaturan['id_pengaturan'] ?>" class="form-control" readonly>
                            <tr>
                                <td>
                                    <label>Judul</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_judul" value="<?= $pengaturan['nama_judul'] ?>" class="form-control" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Meta Keywords</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="meta_keywords" value="<?= $pengaturan['meta_keywords'] ?>" class="form-control" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Meta Deskripsi</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="meta_description" value="<?= $pengaturan['meta_description'] ?>" class="form-control" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br>
                                    <button href="" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                    &nbsp;&nbsp;
                                </td>
                            </tr>
                        </form>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal edit judul-->

    <!-- Modal edit logo-->
    <?php foreach($data->result_array() as $pengaturan): ?>
    <div class="modal fade" id="editlogo<?= $pengaturan['id_pengaturan'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="editlogo<?= $pengaturan['id_pengaturan'] ?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editlogo<?= $pengaturan['id_pengaturan'] ?>Label">Edit
                        <?= $judul ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="" style="width:100%">
                        <form id="editlogo" method="post">
                            <input type="hidden" name="id_pengaturan" value="<?= $pengaturan['id_pengaturan'] ?>"
                                class="form-control" readonly>
                            <tr>
                                <td>
                                    <label>Foto Background</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="file" name="foto" id="bukti_background" class="form-control"
                                        onchange="previewLOGO()">
                                    <img id="preview_logo" alt="image preview" width="50%" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br>
                                    <button href="" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                    &nbsp;&nbsp;
                                </td>
                            </tr>
                        </form>                   
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <script>
    //edit pengaturan
    $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('superadmin/pengaturan/api_edit/') ?>" +
                form_data.get(
                    'id_pengaturan'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_pengaturan'));
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

    //upload logo
    $(document).on('submit', '#editlogo', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('superadmin/pengaturan/api_upload/') ?>" +
                form_data.get(
                    'id_pengaturan'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#editlogo' + form_data.get('id_pengaturan'));
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
    function hapusfoto(id_pengaturan) {
        swal({
            title: "Apakah Anda Yakin?",
            text: "Background Akan Dihapus",
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
                    url: "<?php echo site_url('superadmin/pengaturan/api_hapus/') ?>" +
                        id_pengaturan,
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Background Berhasil Dihapus",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "Background Gagal Dihapus",
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

    //preview Logo
    function previewLOGO() {
        document.getElementById("preview_logo").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("bukti_background").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("preview_logo").src = oFREvent.target.result;
        };

    };
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