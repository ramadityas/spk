<?php
session_start();
ini_set( "display_errors", 0);
include "koneksi.php";

	$id_user=$_SESSION['id_user'];
	$query=mysql_fetch_array(mysql_query("select * from user where id_user='$id_user'"));	
	$status=$query['status'];

if ($status == 'user') die ("<script>alert('Update gagal, user tidak dapat meng-update bobot');window.location='javascript:history.go(-1)';</script>");

$exe = mysql_query("update bobot set j1='$_POST[j1]', j2='$_POST[j2]', j3='$_POST[j3]', j4='$_POST[j4]', j5='$_POST[j5]'");   
if($exe)
 {
echo "<script>window.location='javascript:history.go(-1)'</script>";
 }
?>