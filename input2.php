<?php 
session_start();
include "koneksi.php";
if(isset($_SESSION['id_user'])){

	$id_user=$_SESSION['id_user'];
	$query=mysql_fetch_array(mysql_query("select * from user where id_user='$id_user'"));	
	$username=$query['username'];
	$status=$query['status'];
	
$ni = $_POST['ni'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$semester = $_POST['semester'];

$rni=mysql_num_rows(mysql_query("select * from siswa where nis='$ni' and kelas='$kelas' and semester='$semester'"));
if ($rni > 0)
{
 echo "<script>alert('Data siswa sudah ada di dalam database');window.location='javascript:history.go(-1)';</script>";
}

if ($kelas == 'X' AND $semester == 1) die ("<script>alert('Hanya dapat menginput data kelas X semester 2 hingga kelas XII semester 1');window.location='javascript:history.go(-1)';</script>");
if ($kelas == 'XII-IPA' AND $semester == 2) die ("<script>alert('Hanya dapat menginput data kelas X semester 2 hingga kelas XII semester 1');window.location='javascript:history.go(-1)';</script>");
if ($kelas == 'XII-IPS' AND $semester == 2) die ("<script>alert('Hanya dapat menginput data kelas X semester 2 hingga kelas XII semester 1');window.location='javascript:history.go(-1)';</script>");
	
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
    window.scroll(0,575);
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
        	<div class="thumbnail" style="height:1150">
<div class="progress">
  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
    Proses Input Data
  </div>
</div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <div class="thumbnail" style="background-color:#EAEAEA">
            <h4>Identitas Siswa <a style="color:green"><span class="glyphicon glyphicon-ok"></span></a></h4>
            </div>
            <form method="post" action="input3.php" >
            <p>Nomor Induk Siswa :<input type='text' name='ni2' value='<?php echo $ni;?>' size='50' class='form-control' required /></p>
            <p>Nama Lengkap :<input type='text' name='nama2'  value='<?php echo $nama;?>' size='50' class='form-control' required  /></p>
            <p>Kelas :<select name='kelas2' class='form-control' />
            <option value='<?php echo $kelas;?>'>Kelas <?php echo $kelas;?></option>
            </select>
            </p>
            <p> Semester :<select name='semester2' class='form-control'  />
            <option value='<?php echo $semester;?>'>Semester <?php echo $semester;?></option>
            </select>
            </p>
            <div class="thumbnail" style="background-color:#EAEAEA">
            <h4>Nilai Mata Pelajaran</h4>
            </div>
            <p><input type='text' name='agama' value='' size='50' placeholder='Nilai Pendidikan Agama' class='form-control' required/></p>
            <p><input type='text' name='pkn'  value='' size='50' placeholder='Nilai Pendidikan Kewarganegaraan' class='form-control' required /></p>
            <p><input type='text' name='b_indo' value='' size='50' placeholder='Nilai Bahasa Indonesia' class='form-control' required/></p>
            <p><input type='text' name='b_ing' value='' size='50' placeholder='Nilai Bahasa Inggris' class='form-control' required/></p>
            <p><input type='text' name='mtk' value='' size='50' placeholder='Nilai Matematika' class='form-control' required/></p>
            <?php if ($kelas == 'X' OR $kelas == 'XI-IPA' OR $kelas == 'XII-IPA') { ?>
            <p><input type='text' name='fisika' value='' size='50' placeholder='Nilai Fisika' class='form-control' required/></p>
            <p><input type='text' name='bio' value='' size='50' placeholder='Nilai Biologi' class='form-control' required/></p>
            <p><input type='text' name='kimia' value='' size='50' placeholder='Nilai Kimia' class='form-control' required/></p>
            <?php } ?>
            <p><input type='text' name='sejarah' value='' size='50' placeholder='Nilai Sejarah' class='form-control' required/></p>
            <?php if ($kelas == 'X' OR $kelas == 'XI-IPS' OR $kelas == 'XII-IPS') { ?>
            <p><input type='text' name='geografi' value='' size='50' placeholder='Nilai Geografi' class='form-control' required/></p>
            <p><input type='text' name='ekonomi' value='' size='50' placeholder='Nilai Ekonomi' class='form-control' required/></p>
            <p><input type='text' name='sosiologi' value='' size='50' placeholder='Nilai Sosiologi' class='form-control' required/></p>
            <?php } ?>
            <p><input type='text' name='senibudaya' value='' size='50' placeholder='Nilai Seni Budaya' class='form-control' required/></p>
            <p><input type='text' name='penjaskes' value='' size='50' placeholder='Nilai PENJASKES' class='form-control' required/></p>
            <p><input type='text' name='tik' value='' size='50' placeholder='Nilai Teknologi Informasi dan Komunikasi' class='form-control' required/></p>
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