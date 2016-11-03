<?php 
session_start();
ini_set( "display_errors", 0);
include "koneksi.php";
if(isset($_SESSION['id_user'])){

	$id_user=$_SESSION['id_user'];
	$query=mysql_fetch_array(mysql_query("select * from user where id_user='$id_user'"));	
	$username=$query['username'];
	$status=$query['status'];

$dipilih=$_GET['kelas'];
$dipilih2=$_GET['semester'];

	$j=mysql_fetch_array(mysql_query("select * from bobot"));
	$j1=$j['j1'];
	$j2=$j['j2'];
	$j3=$j['j3'];
	$j4=$j['j4'];
	$j5=$j['j5'];
	$wj1=$j1 / ($j1+ $j2 + $j3 + $j4 + $j5) ;
	$wj2=$j2 / ($j1+ $j2 + $j3 + $j4 + $j5) ;
	$wj3=$j3 / ($j1+ $j2 + $j3 + $j4 + $j5) ;
	$wj4=$j4 / ($j1+ $j2 + $j3 + $j4 + $j5) ;
	$wj5=$j5 / ($j1+ $j2 + $j3 + $j4 + $j5) ;
	
if ($dipilih != 'semua'){
				 $d=mysql_query("select * from siswa where kelas = '$dipilih' and semester = '$dipilih2' order by id_siswa asc");
                   while ($r=mysql_fetch_array($d))
				   {
					   $a = $r['raport'];
					   $b = str_replace( '.', '', $a );
					   $vraport=pow($b,$wj1);
					   $x = $r['kepribadian'];
					   $y = str_replace( '.', '', $x );
					   $vkepribadian=pow($y,$wj2);
					   $mwj=-$wj5;// pengurangan penghasilan
					   $vpenghasilan=pow($r['penghasilan'],$mwj);
					   $ids=$r['id_siswa'];
					   
					   if ($r['saudara']>=0)
					   {
					   $vsaudara=pow(2,$wj3);
					   }
					   if ($r['saudara']>=2)
					   {
					   $vsaudara=pow(3,$wj3);
					   }
					   if ($r['saudara']>=4) {
					   $vsaudara=pow(4,$wj3);
					   }
					
					   if ($r['ortu']=='Piatu')
					   {
					   $vyatim=pow(3,$wj4);
					   }
					   if ($r['ortu']=='Yatim')
					   {
					   $vyatim=pow(4,$wj4);
					   }
					   if ($r['ortu'] =='Yatim Piatu' ) {
					   $vyatim=pow(5,$wj4);
					   }
					   if ($r['ortu'] =='Kedua Ortu Masih Hidup' )
					   {
					   $vyatim=pow(2,$wj4);   
					   }
					   $vektor= $vyatim * $vpenghasilan * $vsaudara * $vkepribadian * $vraport ;
					   $svekektor= $svekektor + $vektor;
					   $cv=mysql_fetch_array(mysql_query("select * from vektor where id_vektor='1'"));
					   $preferensi= $vektor / $cv['vektor'];
					   mysql_query("update siswa set preferensi='$preferensi' where id_siswa='$ids'");
				   }
				   mysql_query ("update vektor set vektor ='$svekektor' where id_vektor='1'");
				   if ($preferensi == 0){
					   header("Refresh:0");
				   }
}
header("Refresh:3; url=siswa.php?kelas=$dipilih&semester=$dipilih2");
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>SPK Beasiswa SMA Sejahtera 1 Depok</title>
<link href="style.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body background="background.jpg" style="background-repeat:repeat"">

<br><br>
<div class="col-md-2">
</div>
<div class="col-md-8">
	<div class="thumbnail">
    <center><img src="header.png" class="img-responsive"/></center>
	</div>
    
    	<div class="col-md-3">
        	<div class="thumbnail">
            <a style="text-decoration:none; color:grey"><b><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $username; ?></b></a><br>
            <a style="text-decoration:none; color:grey"><b><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Status : <?php echo $status; ?></b></a>
            <br><br>
            <center><a class="btn btn-primary" href="siswa.php" style="width:150"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah User</a></center>
            <br>
            <center><a class="btn btn-danger" href="logout.php" style="width:150"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log Out</a></center>
            </div>
        	<div class="thumbnail">
            <a href="awal.php" style="text-decoration:none; color:grey"><center><b><span class="glyphicon glyphicon-chevron-right"></span> Halaman Utama</b></center></a>
            <hr>
            <a href="siswa.php?kelas=semua" style="text-decoration:none; color:grey"><center><b><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Data Siswa</b></center></a>
            <hr>
            <a href="kriteria.php" style="text-decoration:none; color:grey"><center><b><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Data Kriteria</b></center></a>
            <hr>
            </div>
        </div>
        <div class="col-md-9">
        	<div class="thumbnail">
            <br><br>
            <p><center><h3 style="color:grey"><b>Memperbarui Data</b></h3></center></p>
            <p><center><img src="loading.gif" class="img-responsive img-rounded"></center></p>
            <br><br>
            </div>
        </div>

</div>
<div class="col-md-2">
</div>

</body>
</html>
<?php
}else{
	header("Location:index.php");
}
?>