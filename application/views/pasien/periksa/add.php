<?php $this->load->view('template/header'); ?>
<?= $this->session->flashdata('pesan'); ?>

    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">
                <div>
                    <h2 class="text-center">Buat Jadwal Periksa</h2>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table class="" style="width:100%">
                                <form id="add" method="post">
                                    <tr>
                                        <td width="20%">Nama Pasien</td>
                                        <td width="80%">
                                            <input type="hidden" name="id_pasien" id="id_pasien" class="form-control" placeholder="id_pasien" autocomplete="off" required="" value="<?= $id_pasien ?>" readonly>
                                            <input type="text" id="nama" class="form-control" placeholder="nama" autocomplete="off" required="" value="<?= $nama ?>" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Umur (Tahun)</td>
                                        <td width="80%">
                                            <input type="text" name="umur" id="umur" class="form-control" placeholder="umur" autocomplete="off" value="<?= $umur ?>" required="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Tgl Periksa</td>
                                        <td width="80%">
                                            <input type="date" name="tgl_periksa" id="tgl_periksa" class="form-control" placeholder="tgl_periksa" autocomplete="off" min="<?= date('Y-m-d', strtotime('0 day')) ?>" max="<?= date('Y-m-d', strtotime('+7 day')) ?>" value="<?= date('Y-m-d') ?>" required="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Keluhan</td>
                                        <td width="80%">
                                            <textarea name="keluhan" id="keluhan" class="form-control" placeholder="keluhan" autocomplete="off" required=""></textarea>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td colspan="2"><br>
                                            <a href="<?= base_url('pasien/home') ?>" class="btn btn-danger btn-sm">Kembali</a>
                                            <button type="submit" class="btn btn-primary btn-sm" name="submit" value="submit">Simpan</button>
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

<script>
    //add data
    $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('pasien/periksa/api_add') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    if (data.status) {
                        $('#add');
                        $('#add')[0].reset();
                        swal({
                            title: "Berhasil",
                            text: "Data berhasil ditambahkan",
                            type: "success",
                            showConfirmButton: true,
                            confirmButtonText: "OKEE",
                        }).then(function() {
                            window.location.href = "<?= site_url('pasien/home') ?>";
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
</script>

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

?>
<?php $this->load->view('template/footer'); ?>
