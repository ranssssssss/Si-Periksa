<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $judul ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="keywords"
        content="wifi kassandra my id, kassandra my id, kassandra wifi, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta name="description"
        content="Layanan hotspot wifi unlimited 24 jam non stop tanpa lemot kecuali saat wifi down">
    <meta name="author" content="KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta content='index,follow' name='robots' />

    <!-- Favicon -->
    <link href="<?= base_url('themes') ?>/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

     <!-- Bootstrap 4.5.2 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Favicon -->
    <link href="<?= base_url('themes') ?>/favicon.ico" rel="icon">
</head>

<body>
    <br><br><br>
    <!-- 404 Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            <div class="row justify-content-center">
            <img src="<?= base_url('themes') ?>/maintenance.gif" style="width: 420pt; height: 100%; object-fit: cover;">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-primary"></i>                   
                    <h3 class="mb-4">Page Not Found</h3>
                    <p class="mb-4">We’re sorry, the page you have looked for does not exist in our website! Maybe go to
                        our home page or try to use a search? <br>
                        information by <a href="https://www.kassandra.my.id" target="_blank">kassandra Production</a>
                    </p>
                        <!-- mundur 1 kali ke halaman sebelumnya -->
                    <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 404 End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tautan ke file JavaScript Bootstrap 4 (jika diperlukan) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        // info tahun
        var tahun = new Date().getFullYear();
        document.getElementById("tahun").innerHTML = tahun;
    </script>
</body>

</html>