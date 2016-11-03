<?php
ini_set( "display_errors", 0);
include "koneksi.php";
	if(isset($_GET['iduser'])){
		$iduser=$_GET['iduser'];
	}
$user_2 = $_POST['user_2'];
$password_2 = $_POST['pass_2'];
mysql_query("UPDATE user SET username='$user_2', password='$password_2' WHERE id_user='$iduser'");
echo "<script>alert('Data user berhasil diubah');window.location='javascript:history.go(-1)';</script>";
?>