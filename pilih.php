<?php
ini_set( "display_errors", 0);
include "koneksi.php";
$exe = $_POST['pilihkelas'];   
$exe2 = $_POST['pilihsemester'];
$cek = mysql_query("SELECT * FROM siswa WHERE kelas ='$exe' AND semester='$exe2'");

if (mysql_num_rows($cek)==0) die ("<script>alert('Tidak ada data');window.location='javascript:history.go(-1)';</script>");

if ($exe == '' OR $exe2 == '') die ("<script>alert('Anda belum memilih kelas atau semester');window.location='javascript:history.go(-1)';</script>");

if ($exe == 'XII-IPA' AND $exe2 == 2) die ("<script>alert('Tidak ada data siswa kelas XII-IPA semester 2');window.location='javascript:history.go(-1)';</script>");

if ($exe == 'XII-IPS' AND $exe2 == 2) die ("<script>alert('Tidak ada data siswa kelas XII-IPS semester 2');window.location='javascript:history.go(-1)';</script>");

echo '<script>window.location="proses.php?kelas='.$exe.'&semester='.$exe2.'"</script>';
?>