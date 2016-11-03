<?php 
session_start();
include "koneksi.php";
if(isset($_SESSION['id_user'])){

	$id_user=$_SESSION['id_user'];
	$query=mysql_fetch_array(mysql_query("select * from user where id_user='$id_user'"));	
	$username=$query['username'];
	$status=$query['status'];
	
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
        	<div class="thumbnail">
            <div class="thumbnail" style="background-color:#EAEAEA">
            <h3><b><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Data Kriteria</b></h3>
            </div>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" width="auto">
  <tr>
    <td>NO</td>
    <td>Kriteria</td>
    <td>Nilai Bobot</td>
  </tr>
  <tr>
    <td>1</td>
    <td>Nilai Raport</td>
    <td><?php $kwj=number_format($wj1,4); echo "$kwj";?></td>
  </tr>
  <tr>
    <td>2</td>
    <td>Nilai Kepribadian</td>
    <td><?php $kwj2=number_format($wj2,4); echo "$kwj2";?></td>
  </tr>
  <tr>
    <td>3</td>
    <td>Jumlah Saudara</td>
    <td><?php $kwj3=number_format($wj3,4); echo "$kwj3";?></td>
  </tr>
  <tr>
    <td>4</td>
    <td>Status</td>
    <td><?php $kwj4=number_format($wj4,4); echo "$kwj4";?></td>
  </tr>
  <tr>
    <td>5</td>
    <td>Penghasilan</td>
    <td><?php $kwj5=number_format($wj5,4); echo "$kwj5";?></td>
  </tr>
</table>

<br>
            <div class="thumbnail" style="background-color:#EAEAEA">
            <h3><b><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Update Bobot <?php if(($status == user)){ ?><small><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></small><?php } ?></b></h3>
            </div>
                 <form method="post" action="update.php">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" width="auto">
  <tr>
    <td><div align="center"><b>raport</b></div></td>
    <td><div align="center"><b>kepribadian</b></div></td>
    <td><div align="center"><b>saudara</b></div></td>
    <td><div align="center"><b>status</b></div></td>
    <td><div align="center"><b>penghasilan</b></div></td>
    <td><div align="center"><b></b></div></td>

  </tr>
  <tr>
    <td><div align="center"><input type='text' name='j1' value="<?php echo "$j[j1]";?>" class='form-control'></div></td>
    <td><div align="center"><input type='text' name='j2' value="<?php echo "$j[j2]";?>" class='form-control'></div></td>
    <td><div align="center"><input type='text' name='j3' value="<?php echo "$j[j3]";?>" class='form-control'></div></td>
    <td><div align="center"><input type='text' name='j4' value="<?php echo "$j[j4]";?>" class='form-control'></div></td>
    <td><div align="center"><input type='text' name='j5' value="<?php echo "$j[j5]";?>" class='form-control'></div></td>
    <td><div align="center"><input type='submit' name='perbaikan' value="update" class="btn btn-primary"></div></td>
  </tr>
</table>
                </form>

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