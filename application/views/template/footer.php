</div>
    </div>
        <!-- footer content -->
         <footer>
            <center>
                <div class="">
                    <strong>Copyright &copy;
                    <?php echo date('Y'); ?>
                    <?php  $nama_judul = $this->db->get('tb_pengaturan')->row_array(); ?>
                    <a href="https://bit.ly/kassandrahdproduction" target="blank"><?= $nama_judul['nama_judul'] ?>.</a></strong> All rights reserved.
                        <i>Access application with <?php echo "". get_client_browser()."";?>. <?php echo "". get_client_ip()."";?></i>
                </div>
            </center>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <script>
    //ajax keluar dari halaman admin
    function keluar() {
        swal({
            title: "Keluar Dari Halaman ?",
            text: "Anda Akan Keluar Dari Halaman <?php echo $this->session->userdata('nama'); ?> ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3CB371",
            confirmButtonText: "Ya, Keluar!",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result.value) { // Only delete the data if the user clicked on the confirm button
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('keluar') ?>",
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Anda Telah Keluar Dari Halaman <?php echo $this->session->userdata('nama'); ?>",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "Anda Gagal Keluar Dari Halaman <?php echo $this->session->userdata('nama'); ?>",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal Keluar", "Anda Batal Keluar Dari Halaman <?php echo $this->session->userdata('nama'); ?>", "error");
            }
        });
    }

    //full screen
    function toggleFullScreen() {
        if (!document.fullscreenElement && // alternative standard method
            !document.mozFullScreenElement && !document.webkitFullscreenElement) { // current working methods
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen(
                    Element.ALLOW_KEYBOARD_INPUT);
            }
            $('#fullscreen').html('<i class="fa fa-compress"></i>');
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
            $('#fullscreen').html('<i class="fa fa-expand"></i>');
        }
    }
    
	</script>
    <?php
 //menampilkan ip address menggunakan function getenv()
 function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
}

	 //menampilkan jenis web browser pengunjung
function get_client_browser() {
    $browser = '';
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
        $browser = 'Netscape';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
        $browser = 'Firefox';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
        $browser = 'Chrome';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
        $browser = 'Opera';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        $browser = 'Internet Explorer';
  	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Browser'))
        $browser = 'Browser';
    else
        $browser = 'Other';
    return $browser;
}

?> 

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
        //modal
        dropdownParent: $('#modal-default'),
    })
    })
    
</script>

    <!-- jQuery -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="<?= base_url('themes/gentelella') ?>/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Select2 -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/Flot/jquery.flot.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?= base_url('themes/gentelella') ?>/build/js/custom.min.js"></script>

     <!-- Datatables -->
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?= base_url('themes/gentelella') ?>/vendors/pdfmake/build/vfs_fonts.js"></script>
  </body>
</html>