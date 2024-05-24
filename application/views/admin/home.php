<?php $this->load->view('template/header'); ?>
<?= $this->session->flashdata('pesan') ?>

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

<div id="target-div">

<?php if($data == null): ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel text-center">
                    <h1>Tidak Ada Antrian Periksa</h1>
                    <div class="clearfix"></div>
            </div>
        </div>
    </div>

<?php else: ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h5>Antrian Periksa <?= tgl_indo($kode_tgl) ?> </h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">No Antrian</th>
                                            <th>Nama</th>
                                            <th>Umur</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <?php $no=1; foreach($data as $periksa): ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $periksa['nama'] ?></td>
                                        <td><?= $periksa['umur'] ?></td>
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
<?php endif; ?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
    setInterval(function() {
    $("#target-div").load(location.href + " #target-div>*", "");
    }, 1000);
    });
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