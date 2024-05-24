<?php $this->load->view('template/header'); ?>
<?= $this->session->flashdata('pesan'); ?>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
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
                                        <th>Tgl Periksa</th>
                                        <th>Keluhan</th>
                                        <th>Catatan Dokter</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php $no=1; foreach($data as $periksa): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= tgl_indo($periksa['tgl_periksa']) ?></td>
                                    <td><?= $periksa['keluhan'] ?></td>
                                    <td><?= $periksa['catatan'] ?></td>
                                    <td>
                                        <?php if ($periksa['status'] == 'BL') { ?>
                                                <span class="btn btn-warning">Dalam Antrian</span>
                                            <?php } else if ($periksa['status'] == 'D') { ?>
                                                <span class="btn btn-info">Diperiksa</span>
                                            <?php } else if ($periksa['status'] == 'S') { ?>
                                                <span class="btn btn-success">Sudah Diperiksa</span>
                                            <?php } else if ($periksa['status'] == 'BTL') { ?>
                                                <span class="btn btn-danger">Batal Diperiksa</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-warning" data-toggle="modal"
                                            data-target="#edit<?= $periksa['id_periksa'] ?>"><i class="fa fa-edit"></i>
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
                            <td><label for="keluhan">Keluhan:</label></td>
                        </tr>
                        <tr>
                            <td><textarea name="keluhan" id="keluhan" class="form-control" cols="30" rows="5"
                                    required><?= $periksa['keluhan'] ?></textarea></td>
                        </tr>
                      
                        <tr>
                            <td>
                                <br><input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                               
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
        url: "<?php echo site_url('pasien/periksa/api_edit/') ?>" + form_data.get(
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

</script>

<?php $this->load->view('template/footer'); ?>

<?php
function bulan($bln)
{
    $bulan = array(
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    );
    return $bulan[$bln];
}

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
?>