<?php $this->load->view('template/header'); ?>
<?= $this->session->flashdata('pesan') ?>

<?php if($depan == TRUE): ?>
<table class="table table-striped table">
        <form action="" method="POST">
            <tr>
                <th class="col-sm-3">Pilih Tanggal</th>
                <td>
                    <input type="date" name="tgl" class="form-control" value="<?= date("Y-m-d") ?>">
                </td>
            <tr>
                <th></th>
                <td>
                    <input type="submit" name="cari" value="Buka Antrian" class="btn btn-success">
                </td>
            </tr>
        </form>
    </table>

    <?php elseif($depan == FALSE): ?>
    
        <?php
        // Mencari antrian yang belum diproses dan berusia di atas 60 tahun
        $antrian_umur_diatas_60_belum_diproses = [];
        foreach ($data as $periksa) {
            if ($periksa['umur'] >= 60 && $periksa['status'] == 'BL') {
                $antrian_umur_diatas_60_belum_diproses[] = $periksa;
            }
        }

        // Jika ada antrian di atas 60 tahun yang belum diproses, pindahkan satu ke atas
        foreach ($antrian_umur_diatas_60_belum_diproses as $antrian_yang_dipindahkan) {
            // Ambil satu antrian di atas 60 tahun yang belum diproses
            $index_antrian = array_search($antrian_yang_dipindahkan, $data);
            // Pindahkan antrian ke atas satu level jika bukan antrian teratas
            if ($index_antrian > 0) {
                // Hapus antrian dari posisi sebelumnya
                unset($data[$index_antrian]);
                // Masukkan kembali antrian di posisi satu level di atasnya
                array_splice($data, $index_antrian - 2, 0, [$antrian_yang_dipindahkan]);
            }
        }
        ?>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h5>Data Sudah Periksa tgl <?= tgl_indo($tgl) ?></h5>
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
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Keluhan</th>
                                        <th>Catatan Dokter</th>
                                        
                                    </tr>
                                </thead>
                                <?php $no=1; foreach($data as $periksa): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $periksa['nama'] ?></td>
                                    <td><?= $periksa['umur'] ?></td>
                                    <td><?= $periksa['jenis_kelamin'] ?></td>
                                    <td><?= $periksa['keluhan'] ?></td>
                                    <td><?= $periksa['catatan'] ?></td>
                                    
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

<!-- modal edit periksa -->
<?php foreach($data as $periksa): ?>
<div class="modal fade" id="edit<?= $periksa['id_periksa'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="modalEditPeriksaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="modal-title" id="modalEditPeriksaLabel">Edit <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="" style="width:100%">
                    <form id="edit" method="post">
                        <input type="hidden" name="id_periksa" value="<?= $periksa['id_periksa'] ?>">
                        <tr>
                            <td><label for="nama">Nama:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="nama" id="nama" class="form-control" autocomplete="off"
                                    value="<?= $periksa['nama'] ?>" required readonly></td>
                        </tr>
                        <tr>
                            <td><label for="umur">Umur:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="umur" id="umur" class="form-control" autocomplete="off"
                                    value="<?= $periksa['umur'] ?>" required readonly></td>
                        </tr>
                        <tr>
                            <td><label for="jenis_kelamin">Jenis Kelamin:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control"
                                    autocomplete="off" value="<?= $periksa['jenis_kelamin'] ?>" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="keluhan">Keluhan:</label></td>
                        </tr>
                        <tr>
                            <td><textarea name="keluhan" id="keluhan" class="form-control" cols="30" rows="5"
                                    required readonly><?= $periksa['keluhan'] ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="catatan">Catatan dari Dokter:</label></td>
                        </tr>
                        <tr>
                            <td><textarea name="catatan" id="catatan" class="form-control" cols="30" rows="5"
                                    required readonly><?= $periksa['catatan'] ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="status">Status:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="status" id="status" class="form-control">
                                    <option value="BL"
                                        <?php if ($periksa['status'] == 'BL') { echo 'selected'; } ?>>
                                        Belum Diperiksa</option>
                                    <option value="D"
                                        <?php if ($periksa['status'] == 'D') { echo 'selected'; } ?>>
                                        Diperiksa</option>
                                    <option value="S"
                                        <?php if ($periksa['status'] == 'S') { echo 'selected'; } ?>>
                                        Sudah Diperiksa</option>
                                    <option value="BTL"
                                        <?php if ($periksa['status'] == 'BTL') { echo 'selected'; } ?>>
                                        Batal Periksa</option>
                                </select>
                            </td>
                        </tr>

                      
                        <tr>
                            <td>
                                <br><input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                <a href="javascript:void(0)" onclick="hapusperiksa('<?= $periksa['id_periksa'] ?>')"
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


<script>
//edit file
$(document).on('submit', '#edit', function(e) {
    e.preventDefault();
    var form_data = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('admin/periksa/api_edit/') ?>" + form_data.get(
            'id_periksa'),
        dataType: "json",
        data: form_data,
        processData: false,
        contentType: false,
        //memanggil swall ketika berhasil
        success: function(data) {
            $('#edit' + form_data.get('id_periksa'));
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

//ajax hapus periksa
function hapusperiksa(id_periksa) {
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
                url: "<?php echo site_url('admin/periksa/api_hapus/') ?>" +
                    id_periksa,
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

<?php endif; ?>

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