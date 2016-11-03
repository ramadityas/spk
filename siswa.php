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
	
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>SPK Beasiswa SMA Sejahtera 1 Depok</title>
<link href="style.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
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
<?php
if(isset($_POST['tambah'])){
$user = $_POST['user'];
$password = $_POST['pass'];
$cek = mysql_query("SELECT * FROM user WHERE username ='$user'");
if(mysql_num_rows($cek)==0){
mysql_query("INSERT into user (id_user,username,password,status)values(null,'$user','$password','user')");
echo '<div class="alert alert-success" role="alert"><center><b>User telah berhasil ditambahkan</b></center></div>';
}
else
{
echo '<div class="alert alert-danger" role="alert"><center><b>User yang anda masukan sudah ada</b></center></div>';
}
}
?>
    	<div class="col-md-3">
<!-- Modal-->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah / Edit User</h4>
        </div>
        <div class="modal-body">
<?php if(($status == admin)){ ?>
<br>
<form action="" enctype="multipart/form-data"  method="post" name="postform">
<table cellpadding="0" cellspacing="0" border="0" class="table" width="auto">
  <tr>
    <td><div align="center"><input type='text' name='user' class='form-control' placeholder="Username" required ></div></td>
    <td><div align="center"><input type='password' name='pass' class='form-control' placeholder="Password" required ></div></td>
    <td><div align="center"><input type='submit' name='tambah' value="Tambah" class="btn btn-primary"></div></td>
  </tr>
</table>
</form>
<br>
<?php
$quser=mysql_query("select * from user where status='user' ORDER BY id_user ASC");
while($quser_row=mysql_fetch_array($quser)){ 
$iduser=$quser_row['id_user'];
$username2=$quser_row['username'];
$password2=$quser_row['password'];
?>
<div class="thumbnail">
<form action="ubah.php?iduser=<?php echo $iduser; ?>" enctype="multipart/form-data"  method="post" name="postform">
<div class="col-md-9">
<div class="col-md-6">
<div class="input-group">
  <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
  <input type="text" name='user_2' class="form-control" placeholder="Username" value="<?php echo $username2; ?>">
</div>
</div>
<div class="col-md-6">
<div class="input-group">
  <span class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
  <input type="password" name='pass_2' class="form-control" placeholder="Password" value="<?php echo $password2; ?>">
</div>
</div>
</div>
<div class="col-md-3">
<center><input type='submit' name='ubah' value="Edit" class="btn btn-success" style="width:100"></center>
</div>
<br><br>
</form>
<a href="hapus1.php?iduser=<?php echo $iduser; ?>"><small><span style="color:red" class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus</small></a>
</div>
<?php }?>
<?php }?>
<?php if(($status == user)){ ?>
<h3><center><p><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Tidak dapat menambah atau</p><p>mengedit user selain Admin</p></center></h3>
<?php } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- Modal-->
        	<div class="thumbnail">
            <a style="text-decoration:none; color:grey"><b><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $username; ?></b></a><br>
            <a style="text-decoration:none; color:grey"><b><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Status : <?php echo $status; ?></b></a>
            <br><br>
            <center><a class="btn btn-primary" href="#myModal2" data-toggle="modal" style="width:150"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah User</a></center>
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
        
<!-- Modal-->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-pie-chart" aria-hidden="true"></i> Analisis Data <?php echo 'Kelas '.$dipilih.' Semester '.$dipilih2.''?></h4>
        </div>
        <div class="modal-body">
<div class="thumbnail">
<center><h4 style="color:grey"><b>Perhitungan Nilai Alternatif</b></h4></center>
</div>
<div style="padding:3px;overflow:auto;width:auto;height:200px;border:0px solid grey" >
<?php
$query3=mysql_query("select * from siswa where kelas = '$dipilih' and semester = '$dipilih2' ORDER BY id_siswa ASC");
while($row4=mysql_fetch_array($query3)){
$nama4=$row4['nama'];
$raport4=$row4['raport'];
$kepribadian4=$row4['kepribadian'];
$saudara4=$row4['saudara'];
$ortu4=$row4['ortu'];
$penghasilan4=$row4['penghasilan'];
if ($ortu4=='Piatu'){ $ortu4=3; }
if ($ortu4=='Yatim'){ $ortu4=4; }
if ($ortu4=='Yatim Piatu'){ $ortu4=5; }
if ($ortu4=='Kedua Ortu Masih Hidup'){ $ortu4=2; }
if ($row4['saudara'] >= 0) {
$saudara4=2;
}
if ($row4['saudara'] >= 2) {
$saudara4=3;
}
if ($row4['saudara'] >= 4) {
$saudara4=4;
}
?>
<p><b><?php echo $nama4 ;?> : </b></p>
<p><small>(<?php echo str_replace( '.', '', $raport4 ) ;?>^(<?php echo number_format($wj1,4) ;?>)) <b>x</b> (<?php echo str_replace( '.', '', $kepribadian4 ) ;?>^(<?php echo number_format($wj2,4) ;?>)) <b>x</b> (<?php echo $saudara4 ;?>^(<?php echo number_format($wj3,4) ;?>)) <b>x</b> (<?php echo $ortu4 ;?>^(<?php echo number_format($wj4,4) ;?>)) <b>x</b> (<?php echo $penghasilan4 ;?>^(-<?php echo number_format($wj5,4) ;?>))</small></p>
<hr>
<?php }?>
</div>
<div class="thumbnail">
<center><h4 style="color:grey"><b>Tabel Nilai</b></h4></center>
</div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" width="auto">
  <tr>
    <td><small><center><b>Nama</b></center></small></td>
    <td><small><center><b>Nilai Alternatif</b></center></small></td>
    <td><small><center><b>Preferensi Nilai</b></center></small></td>
  </tr>
<?php
$query2=mysql_query("select * from siswa where kelas = '$dipilih' and semester = '$dipilih2' ORDER BY id_siswa ASC");
while($row2=mysql_fetch_array($query2)){	
$ids2=$row2['id_siswa'];
$nama2=$row2['nama'];
if (mysql_num_rows($query2)!=1) {
$pref=$row2['preferensi'];
}
if (mysql_num_rows($query2)==1) {
$pref=number_format($row2['preferensi'],0);
}
$a2 = $row2['raport'];
$b2 = str_replace( '.', '', $a2 );
$vraport2=pow($b2,$wj1);
$x2 = $row2['kepribadian'];
$y2 = str_replace( '.', '', $x2 );
$vkepribadian2=pow($y2,$wj2);
$mwj2=-$wj5;// pengurangan penghasilan
$vpenghasilan2=pow($row2['penghasilan'],$mwj2);
					   
if ($row2['saudara']>=0){$vsaudara2=pow(2,$wj3);}
if ($row2['saudara']>=2){$vsaudara2=pow(3,$wj3);}
if ($row2['saudara']>=4){$vsaudara2=pow(4,$wj3);}
					   
if ($row2['ortu']=='Piatu'){$vyatim2=pow(3,$wj4);}
if ($row2['ortu']=='Yatim'){$vyatim2=pow(4,$wj4);}
if ($row2['ortu'] =='Yatim Piatu' ){$vyatim2=pow(5,$wj4);}
if ($row2['ortu'] =='Kedua Ortu Masih Hidup' ){$vyatim2=pow(2,$wj4);}
$vektor2= $vyatim2 * $vpenghasilan2 * $vsaudara2 * $vkepribadian2 * $vraport2 ;
?>
  <tr>
    <td><small><center><?php echo $nama2 ;?></center></small></td>
    <td><small><center><?php echo $vektor2 ;?></center></small></td>
    <td><small><center><?php echo $pref ;?></center></small></td>
  </tr>
<?php }?>
  <tr>
    <td><small><center><b>Total :</b></center></small></td>
<?php
$qv=mysql_query("select * from vektor where id_vektor='1'");
while($rqv=mysql_fetch_array($qv)){	
$jv=$rqv['vektor'];
?>
    <td><small><center><b><?php echo $jv ;?></b></center></small></td>
<?php }?>
	<td></td>
  </tr>
  </tr>
</table>
<p>Urutan siswa berdasarkan Preferensi nilai terbesar</p>
<ol>
<?php
$query4=mysql_query("select * from siswa where kelas = '$dipilih' and semester = '$dipilih2' ORDER BY preferensi DESC");
while($row3=mysql_fetch_array($query4)){	
$nama3=$row3['nama'];
?>
<li><?php echo $nama3 ;?></li>
<?php } ?>
</ol>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- Modal-->
        
        <div class="col-md-9">
        	<div class="thumbnail">
            <?php if ($dipilih != 'semua'){ ?>
            <div class="thumbnail" style="background-color:#EFEFEF">
            <center><a style="text-decoration:none; font-size:16px" href="#myModal1" data-toggle="modal"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Tampilkan Hasil Analisis</a></center>
            </div>
            <?php } ?>
            <div class="col-md-3">
            <br>
            <a class="btn btn-success" href="input.php" style="width:150"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Input Data Siswa</a>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-7">
            <br>
            <center>
            <form id='myForm' method='post' action='pilih.php' >                       
<table border="0">
	<tr>
            <td><select name='pilihkelas' class='form-control' />
            <option value='' selected='selected'>Pilih Kelas</option>
			<option value='X'>Kelas X</option>
			<option value='XI-IPA'>Kelas XI-IPA</option>
			<option value='XI-IPS'>Kelas XI-IPS</option>
			<option value='XII-IPA'>Kelas XII-IPA</option>
            <option value='XII-IPS'>Kelas XII-IPS</option>
			</select></td>
            <td><select name='pilihsemester' class='form-control' />
            <option value='' selected='selected'>Pilih Semester</option>
            <option value='1'>Semester 1</option>
			<option value='2'>Semester 2</option>
			</select></td>
            <td><input type='submit' id='submit' name='find' value="Cari" class="btn btn-primary"></td>
	</tr>
</table>
			</form>
			</center>
            </div>
            <?php
			if ($dipilih != 'semua'){ ?>
            <div class="col-md-12">
            <a class="pull-right" style="text-decoration:none; color:grey">Menampilkan data <?php echo 'Kelas '.$dipilih.' Semester '.$dipilih2.''?><b><a href="siswa.php?kelas=semua" style="text-decoration:none">Tampilkan kembali semua data</a></b></a>
            </div>
			<?php } ?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" width="auto">
  <tr>
    <td><small><b>Nama</b></small></td>
    <td><small><b>Nilai Raport</b></small></td>
    <td><small><b>Nilai Kepribadian</b></small></td>
    <td><small><b>Jumlah Saudara</b></small></td>
    <td><small><b>Status</b></small></td>
    <td><small><b>Penghasilan Pribadi/Ortu/Wali</b></small></td>
  </tr>
<?php
if ($dipilih == 'semua'){
$query1=mysql_query("select * from siswa ORDER BY id_siswa ASC");
}
if ($dipilih != 'semua'){
$query1=mysql_query("select * from siswa where kelas = '$dipilih' and semester = '$dipilih2' ORDER BY id_siswa ASC");
}
while($row=mysql_fetch_array($query1)){	
$ids=$row['id_siswa'];
$nis=$row['nis'];
$nama=$row['nama'];
$kelas=$row['kelas'];
$semester=$row['semester'];
$tahun=$row['tahun'];
$raport=$row['raport'];
$kepribadian=$row['kepribadian'];
$saudara=$row['saudara'];
$ortu=$row['ortu'];
$penghasilan=$row['penghasilan'];
?>
  <tr>
    <td><small><a href="edit_siswa.php?id_siswa=<?php echo $ids; ?>" data-toggle="tooltip" title="No Induk: <?php echo $nis ;?> | Kelas: <?php echo $kelas ;?> | Semester: <?php echo $semester ;?> | Tahun: <?php echo $tahun ;?>"><?php echo $nama ;?></a></small></td>
    <td><small><?php echo $raport ;?></small></td>
    <td><small><?php echo $kepribadian ;?></small></td>
    <td><small><?php echo $saudara ;?></small></td>
    <td><small><?php echo $ortu ;?></small></td>
    <td><small><?php $penghasilan=number_format($penghasilan); echo"Rp.$penghasilan";?></small></td>
  </tr>
<?php }?>
  </tr>
</table>
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