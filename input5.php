<?php
session_start();
ini_set( "display_errors", 0);
include "koneksi.php";
$nama=$_POST['nama'];
$raport=$_POST['nilai1'];
$kepribadian=$_POST['nilai2'];
$saudara=$_POST['saudara'];
$penghasilan=$_POST['penghasilan'];
$ortu=$_POST['ortu'];
$nis=$_POST['ni'];
$kelas=$_POST['kelas'];
$semester=$_POST['semester'];
$thn1=date("Y"); $thn2=$thn1-1;
$rnis=mysql_num_rows(mysql_query("select * from siswa where nis='$nis'"));

mysql_query("CREATE TRIGGER tg_siswa_insert
BEFORE INSERT ON siswa
FOR EACH ROW
BEGIN
  INSERT INTO siswa_seq (id) VALUES (NULL);
  SET NEW.id_siswa = CONCAT('S', LPAD(LAST_INSERT_ID(), 3, '0'));
END;");

mysql_query("insert into siswa (nis,nama,kelas,semester,tahun,raport,kepribadian,saudara,ortu,penghasilan)values('$nis','$nama','$kelas','$semester','$thn2 - $thn1','$raport','$kepribadian','$saudara','$ortu','$penghasilan')"); 
header ('location:siswa.php?kelas=semua');
?>