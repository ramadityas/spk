<?php
session_start();

if(isset($_SESSION['id_user'])){

if(isset($_GET['idsiswa'])){
		$idsiswa=$_GET['idsiswa'];
	}

include"koneksi.php";

 $exe=mysql_query("DELETE FROM siswa WHERE id_siswa = '$idsiswa'") ;

 if($exe)
 {
 echo "<script>window.location='javascript:history.go(-2)'</script>";
 }
 else { 
 echo "<script>window.location='javascript:history.go(-2)'</script>";
 }

}else{
	header("Location:index.php");
}

 ?>