<?php 
session_start();
include "koneksi.php";
if(isset($_SESSION['id_user'])){

	$id_user=$_SESSION['id_user'];
	$query=mysql_fetch_array(mysql_query("select * from user where id_user='$id_user'"));	
	$username=$query['username'];
	$status=$query['status'];

$id_siswa=$_GET['id_siswa'];
$query_siswa=mysql_fetch_array(mysql_query("select * from siswa where id_siswa = '$id_siswa'"));
$e_nis=$query_siswa['nis'];
$e_nama=$query_siswa['nama'];
$e_kelas=$query_siswa['kelas'];
$e_semester=$query_siswa['semester'];
$e_raport=$query_siswa['raport'];
$e_kepribadian=$query_siswa['kepribadian'];
$e_saudara=$query_siswa['saudara'];
$e_ortu=$query_siswa['ortu'];
$e_penghasilan=$query_siswa['penghasilan'];
	
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
        	<div class="thumbnail" style="height:930">
<?php
if(isset($_POST['ubah2'])){
$u_nis = $_POST['u_nis'];
$u_nama = $_POST['u_nama'];
$u_kelas = $_POST['u_kelas'];
$u_semester = $_POST['u_semester'];
$u_nilai1 = $_POST['u_nilai1'];
$u_nilai2 = $_POST['u_nilai2'];
$u_saudara = $_POST['u_saudara'];
$u_penghasilan = $_POST['u_penghasilan'];
$u_ortu = $_POST['u_ortu'];

mysql_query("update siswa set nis='$u_nis', nama='$u_nama', kelas='$u_kelas', semester='$u_semester', raport='$u_nilai1', kepribadian='$u_nilai2', saudara='$u_saudara', ortu='$u_ortu', penghasilan='$u_penghasilan' where id_siswa='$id_siswa'");
echo "<script>alert('Data berhasil diubah');window.location='javascript:history.go(-2)';</script>";

}
?>
<br>
            <div class="thumbnail">
            <a href="hapus2.php?idsiswa=<?php echo $id_siswa; ?>"><small><span style="color:red" class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus data siswa</small></a>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <div class="thumbnail" style="background-color:#EAEAEA">
            <h4>Identitas Siswa</h4>
            </div>
            <form action="" enctype="multipart/form-data"  method="post" name="postform">
            <p><input type='text' name='u_nis' value='<?php echo $e_nis; ?>' size='50' placeholder='No. Induk Peserta Didik' class='form-control' required/></p>
            <p><input type='text' name='u_nama'  value='<?php echo $e_nama; ?>' size='50' placeholder='Nama Lengkap' class='form-control' required /></p>
            <p><select name='u_kelas' class='form-control' />
            <option value='X'>Kelas X</option>
            <option value='XI-IPA'>Kelas XI-IPA</option>
            <option value='XI-IPS'>Kelas XI-IPS</option>
            <option value='XII-IPA'>Kelas XII-IPA</option>
            <option value='XII-IPS'>Kelas XII-IPS</option>
            </select>
            </p>
            <a style="text-decoration:none; color:grey"><small>Data saat ini : Kelas <?php echo $e_kelas; ?></small></a>
            <p><select name='u_semester' class='form-control' />
            <option value='1'>Semester 1</option>
            <option value='2'>Semester 2</option>
            </select>
            </p>
            <a style="text-decoration:none; color:grey"><small>Data saat ini : Semester <?php echo $e_semester; ?></small></a>
            <div class="thumbnail" style="background-color:#EAEAEA">
            <h4>Nilai Mata Pelajaran</h4>
            </div>
            <p>Nilai Rata-Rata Pelajaran :<input type='text' name='u_nilai1' value='<?php echo $e_raport;?>' size='50' class='form-control'/></p>
            <div class="thumbnail" style="background-color:#EAEAEA">
            <h4>Nilai Kepribadian</h4>
            </div>
            <p>Nilai Rata-Rata Kepribadian :<input type='text' name='u_nilai2' value='<?php echo $e_kepribadian;?>' size='50' class='form-control'/></p>
            <div class="thumbnail" style="background-color:#EAEAEA">
            <h4>Keterangan Lain</h4>
            </div>
            <p> Jumlah Saudara :<input type='text' name='u_saudara' value='<?php echo $e_saudara;?>' size='50' placeholder='Jumlah Saudara (Hanya angka)' class='form-control' required/></p>
            <p>Penghasilan Orang Tua :<input type='text' name='u_penghasilan' value='<?php echo $e_penghasilan;?>' size='50' placeholder='Penghasilan Orang Tua (Hanya angka)' class='form-control' required/></p>
            <p>Keterangan Orang Tua Siswa :<select name='u_ortu' class='form-control' />
            <option value='Kedua Ortu Masih Hidup'>Kedua Orang Tua Masih Hidup</option>
            <option value='Yatim'>Yatim</option>
            <option value='Piatu'>Piatu</option>
            <option value='Yatim Piatu'>Yatim Piatu</option>
            </select>
            </p>
            <a style="text-decoration:none; color:grey"><small>Data saat ini : <?php echo $e_ortu; ?></small></a>
            <p><input type='submit' id='submit' name='ubah2' value="UBAH" class="btn btn-primary"></p>
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