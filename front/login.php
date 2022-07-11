<?php
ob_start();
?>
<?php 
if (isset($_SESSION['nom'])) {
      header('Location: ../admin/index.php');
      ob_end_flush();
    }
	include ('../config/config_db.php');
	$test=0;$type=0;
	$uname='';
	$conn=mysqli_connect($dbhost,$dbuser,$dbpassword,$db) or die('errer de connection');
	if(isset($_POST['nom']) && isset($_POST['pass'])){   
	    $uname=$_POST['nom'];
	    $password=$_POST['pass'];
	    $sql="select * from user where nom='".$uname."' limit 1";
	   if( $result=mysqli_query($conn,$sql)){
		    while ($ligne=mysqli_fetch_assoc($result)) {
		      	if($ligne['nom']==$uname){
		      		$test=1;
		      		$sql="select * from user where nom='".$uname."'AND pass='".$password."' limit 1";
		      		$result=mysqli_query($conn,$sql);
		      		$ligne=mysqli_fetch_assoc($result);
			      		if($ligne['nom']==$uname&&$ligne['pass']== $password) {
			      			$test=2;	
			      			$type=$ligne['type'];

			      		}   		
		    	}  
		 	}
	 	}
	} 
	mysqli_close($conn);
?>
<html  dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>diplom</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/Pretty-Login-Form.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <div class="row login-form mt-5">
    	<div class="col-md-4"></div>
        <div class="col-md-4 offset-md-4">
            <h2 class="text-center form-heading">لوحة التحكم</h2>
            <form class="custom-form"  method="POST" action="login.php">
                <div class="form-group"><input class="form-control" type="text" name="nom" placeholder="الاسم"></div>
                <div class="form-group"><input class="form-control" type="password" name="pass" placeholder="كلمة السر"></div>
                <input type="submit" type="submit" value="دخول" class="btn btn-light btn-block submit-button"/>
            <br>

 <?php 
 if ($test==0 && $uname!='') {
 	$msg= "الاسم غير موجود";
 }	
if ($test==1) {
	$msg= "كلمة السر خاطئة";
}
if($test==0 && $uname!=''||$test==1){
 	echo "<div class='col'><div class='alert alert-warning alert-dismissible fade show' role='alert'>";
    echo $msg; 
    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span></button></div></div>";
}
if ($test==2) {
	session_start();
	$_SESSION['nom']=$_POST['nom'];
	$_SESSION['type']=$type;
	header('Location: ../admin/index.php');
	}	
  ?>
</form>
        </div>
        <div class="col-md-4"></div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>