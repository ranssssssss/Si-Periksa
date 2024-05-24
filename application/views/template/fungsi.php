<?php 
//membuat format rupiah dengan PHP 
function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
}

//membuat shortname
function shortname($name){
	$short = explode(" ", $name);
	$shortname = $short[0];
	return $shortname;
}

//membuat format tanggal indonesia
function tanggal($tanggal){
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

//menampilkan hasil nilai dengan format rating ( * )
function rating($nilai){
	$hasil = "";
	for ($i=0; $i < $nilai; $i++) { 
		$hasil .= "<span class='fa fa-star checked'></span>";
	}
	return $hasil;
}
?>