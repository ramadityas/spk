<?php
session_start();
include ("koneksi.php");
if(empty($_SESSION['id_user'])){
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
</div>
<div class="col-md-2">
</div>
<br>

<div class="col-md-4">
</div>

<div class="col-md-4">
	<div class="thumbnail">
    <div class="thumbnail">
    <h3><a style="text-decoration:none; color:green"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Log in</a></h3>
    </div>

<?php
if(isset($_POST['kirim'])){
$user = $_POST['username'];
$password = $_POST['password'];
$cek = mysql_query("SELECT * FROM user WHERE username ='$user' AND password ='$password'");
if(mysql_num_rows($cek)==1){
$hasil=mysql_fetch_array($cek);
$_SESSION['id_user'] = $hasil['id_user'];

echo "<script>window.location='awal.php'</script>";}
else
{
echo '<div class="alert alert-danger" role="alert"><center><b>Username dan password yang anda masukan tidak sesuai, silahkan untuk mengulangi.</b></center></div>';
}
}
?>

	<form action="" enctype="multipart/form-data"  method="post" name="postform">
    <div class="form-group">
	<input type="text" class="form-control" name="username" placeholder="Username" required />
    </div>
    <div class="form-group">
	<input type="password" class="form-control" name="password" placeholder="Password" required />
   	</div>
    <div class="form-group">
	<span class="pull-left"><button type="submit" class="btn btn-primary" value="Masuk" name="kirim">Masuk</button></span>        
    </div>
	</form>
    <br>
    <br>
	</div>
</div>

<div class="col-md-4">
</div>

</body>
</html>
<?php
}
else
{
header("Location:awal.php");
}
?>