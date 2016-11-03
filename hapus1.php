<?php
session_start();

if(isset($_SESSION['id_user'])){

if(isset($_GET['iduser'])){
		$iduser=$_GET['iduser'];
	}

include"koneksi.php";

 $exe=mysql_query("DELETE FROM user WHERE id_user = '$iduser'") ;

 if($exe)
 {
 echo "<script>window.location='javascript:history.go(-1)'</script>";
 }
 else { 
 echo "<script>window.location='javascript:history.go(-1)'</script>";
 }

}else{
	header("Location:index.php");
}

 ?>