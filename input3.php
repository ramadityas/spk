<?php 
session_start();
include "koneksi.php";
if(isset($_SESSION['id_user'])){

	$id_user=$_SESSION['id_user'];
	$query=mysql_fetch_array(mysql_query("select * from user where id_user='$id_user'"));	
	$username=$query['username'];
	$status=$query['status'];
	
$ni = $_POST['ni2'];
$nama = $_POST['nama2'];
$kelas = $_POST['kelas2'];
$semester = $_POST['semester2'];

$p1 = $_POST['agama'];
$p2 = $_POST['pkn'];
$p3 = $_POST['b_indo'];
$p4 = $_POST['b_ing'];
$p5 = $_POST['mtk'];
$p6 = $_POST['fisika'];
$p7 = $_POST['bio'];
$p8 = $_POST['kimia'];
$p9 = $_POST['sejarah'];
$p10 = $_POST['geografi'];
$p11 = $_POST['ekonomi'];
$p12 = $_POST['sosiologi'];
$p13 = $_POST['senibudaya'];
$p14 = $_POST['penjaskes'];
$p15 = $_POST['tik'];
$tn=$p1 + $p2 + $p3 + $p4 + $p5 + $p6 + $p7 + $p8 + $p9 + $p10 + $p11 + $p12 + $p13 + $p14 + $p15;
$tn_ipa=$p1 + $p2 + $p3 + $p4 + $p5 + $p6 + $p7 + $p8 + $p9 + $p13 + $p14 + $p15;
$tn_ips=$p1 + $p2 + $p3 + $p4 + $p5 + $p9 + $p10 + $p11 + $p12 + $p13 + $p14 + $p15;

if ($kelas == 'X') {
	$nr1=$tn / 15;
}
if ($kelas == 'XI-IPA' OR $kelas == 'XII-IPA') {
	$nr1=$tn_ipa / 12;
}
if ($kelas == 'XI-IPS' OR $kelas == 'XII-IPS') {
	$nr1=$tn_ips / 12;
}
	
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
  <script type="text/javascript">
  function moveWin()
  {  
    window.scroll(0,10000);
  }
  </script>
</head>
<body onLoad="moveWin();" background="background.jpg" style="background-repeat:repeat">

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
        <div class="col-md-9">
        	<div class="thumbnail" style="height:950">
<div class="progress">
  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
    Proses Input Data
  </div>
</div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <div class="thumbnail" style="background-color:#EAEAEA">
            <h4>Identitas Siswa <a style="color:green"><span class="glyphicon glyphicon-ok"></span></a></h4>
            </div>
            <form method="post" action="input4.php" >
            <p>Nomor Induk Siswa :<input type='text' name='ni' value='<?php echo $ni;?>' size='50' class='form-control' required/></p>
            <p>Nama Lengkap :<input type='text' name='nama'  value='<?php echo $nama;?>' size='50' class='form-control' required /></p>
            <p>Kelas :<select name='kelas' class='form-control' />
            <option value='<?php echo $kelas;?>'>Kelas <?php echo $kelas;?></option>
            </select>
            </p>
            <p> Semester :<select name='semester' class='form-control' />
            <option value='<?php echo $semester;?>'>Semester <?php echo $semester;?></option>
            </select>
            </p>
            <div class="thumbnail" style="background-color:#EAEAEA">
            <h4>Nilai Mata Pelajaran <a style="color:green"><span class="glyphicon glyphicon-ok"></span></a></h4>
            </div>
            <p>Nilai Rata-Rata Pelajaran :<input type='text' name='nilai1' value='<?php $nr1=number_format($nr1,2); echo $nr1;?>' size='50' class='form-control'/></p>
            <div class="thumbnail" style="background-color:#EAEAEA">
            <h4>Nilai Kepribadian</h4>
            </div>
            <div class="col-md-6">
            <p>Kedisiplinan :<select name='kedisiplinan' class='form-control' />
            <option value='100'>A - Sangat Baik (100)</option>
            <option value='75'>B - Cukup Baik (75)</option>
            <option value='50'>C - Kurang Baik (50)</option>
            </select>
            </p>
            <p>Kebersihan :<select name='kebersihan' class='form-control' />
            <option value='100'>A - Sangat Baik (100)</option>
            <option value='75'>B - Cukup Baik (75)</option>
            <option value='50'>C - Kurang Baik (50)</option>
            </select>
            </p>
            <p>Kesehatan :<select name='kesehatan' class='form-control' />
            <option value='100'>A - Sangat Baik (100)</option>
            <option value='75'>B - Cukup Baik (75)</option>
            <option value='50'>C - Kurang Baik (50)</option>
            </select>
            </p>
            <p>Tanggungjawab :<select name='tanggungjawab' class='form-control' />
            <option value='100'>A - Sangat Baik (100)</option>
            <option value='75'>B - Cukup Baik (75)</option>
            <option value='50'>C - Kurang Baik (50)</option>
            </select>
            </p>
            <p>Sopan Santun :<select name='sopansantun' class='form-control' />
            <option value='100'>A - Sangat Baik (100)</option>
            <option value='75'>B - Cukup Baik (75)</option>
            <option value='50'>C - Kurang Baik (50)</option>
            </select>
            </p>
            </div>
            <div class="col-md-6">
            <p>Percaya Diri :<select name='percayadiri' class='form-control' />
            <option value='100'>A - Sangat Baik (100)</option>
            <option value='75'>B - Cukup Baik (75)</option>
            <option value='50'>C - Kurang Baik (50)</option>
            </select>
            </p>
            <p>Kompetitif :<select name='kompetitif' class='form-control' />
            <option value='100'>A - Sangat Baik (100)</option>
            <option value='75'>B - Cukup Baik (75)</option>
            <option value='50'>C - Kurang Baik (50)</option>
            </select>
            </p>
            <p>Hubungan Sosial :<select name='hubsosial' class='form-control' />
            <option value='100'>A - Sangat Baik (100)</option>
            <option value='75'>B - Cukup Baik (75)</option>
            <option value='50'>C - Kurang Baik (50)</option>
            </select>
            </p>
            <p>Kejujuran :<select name='kejujuran' class='form-control' />
            <option value='100'>A - Sangat Baik (100)</option>
            <option value='75'>B - Cukup Baik (75)</option>
            <option value='50'>C - Kurang Baik (50)</option>
            </select>
            </p>
            <p>Pelaksanaan Ibadah :<select name='ibadah' class='form-control' />
            <option value='100'>A - Sangat Baik (100)</option>
            <option value='75'>B - Cukup Baik (75)</option>
            <option value='50'>C - Kurang Baik (50)</option>
            </select>
            </p>
            </div>
            <p><input type='submit' id='submit' name='lanjut2' value="Lanjut" class="btn btn-primary"></p>
            </form>
            </div>
            <div class="col-md-2"></div>
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