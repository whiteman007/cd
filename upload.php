<?php 
set_time_limit(300);

session_start();
if (!isset($_SESSION['nom'])) {
      header('Location: ../front/login.php');
    }
    include ('../config/config_db.php');
    require_once('PHPExcel/Classes/PHPExcel.php');
include("PHPExcel/Classes/PHPExcel/IOFactory.php");
    $conn=mysqli_connect($dbhost,$dbuser,$dbpassword,$db) or die('errer de connection');
    mysqli_set_charset ($conn,"utf8");
    $sql="SELECT * FROM member";

$erreur=FALSE;
$extension_upload = strtolower(  substr(  strrchr($_FILES['file']['name'], '.')  ,1)  );
// $target_dir = "chargements/";
// $target_file = $target_dir .date(NOW());
// /* Requête SQL de récupération des modèles LG  */
// $req_acreer="SELECT * FROM `lg_modele` WHERE `ns`='0' and `id`='$idmodele'";
// $don_acreer=mysql_query($req_acreer);
// $resultatacreer=mysql_fetch_array($don_acreer);
// $target_file = $target_dir . $resultatacreer['modele']."-".$resultatacreer['lot']."-".$resultatacreer['taillelot'].".".$extension_upload;
// //$target_file = $target_dir . basename($_FILES["file"]["name"]);

$uploadOk = 1;
// //echo "start ".$target_file;

// function check_doc_mime( $tmpname ) {
//     // MIME types: http://filext.com/faq/office_mime_types.php
//     $finfo = finfo_open( FILEINFO_MIME_TYPE );
//     $mtype = finfo_file( $finfo, $tmpname );
//     finfo_close( $finfo );
//     if( $mtype == ( "application/vnd.ms-excel" ) ||
//         $mtype == ( "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) ) {
//         return TRUE;
//     }
//     else {
//         return FALSE;
//     }
// }
/*if(isset($_POST["submit"])) {
	if( function_exists( "check_doc_mime" ) ) {
		echo "1";
	    if ( !check_doc_mime( $_FILES['file']['tmp_name'] ) ) {
	        /*
	         * Not a MIME type we want uploaded to our site, stop here
	         * and return an error message, or just die();
	         */
	        /*echo "<script>
			alert('Veuillez charger un fichier excel!');
			window.location.href='../gest-modele-lg.php#listes';
			</script>";
	    }else{*/
	    	// Check if file already exists
			// if (file_exists($target_file)) {
			//     echo "<script>
			// 		alert('Erreur! Un fichier avec le meme nom déjà chargé.');
			// 		window.location.href='../gest-modele-lg.php#listes';
			// 		</script>";
			//     $uploadOk = 0;
			// }
			// Check file size
			if ($_FILES["file"]["size"] > 500000) {
			    echo "<script>
					alert('Erreur! Le fichier à chrager dépasse la taille max du chargement');
					window.location.href='../gest-modele-lg.php#listes';
					</script>";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "<script>
					alert('Erreur lors du chargement du fichier!');
					window.location.href='../gest-modele-lg.php#listes';
					</script>";
			// if everything is ok, try to upload file
			} else {
				/***************************************************************************/
				// $uploaded=FALSE;
			 //    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			 //    	//header('../gest-modele-lg.php#listes');
			 //    	$uploaded=TRUE; 
			 //    }
			 //    if ($uploaded) {
			 //    	/*Upload in database*/
		  //           // Read your Excel workbook 
			 //        try { 

			 	// if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			  //   	//header('../gest-modele-lg.php#listes');
			  //   	$uploaded=TRUE; 
			  //   }

			            $objPHPExcel = PHPExcel_IOFactory::load($_FILES["file"]["tmp_name"]); // create object of PHPExcel library by using load() method and in load method define path of selected file
			            /*One sheet accepted*/
			            // Get worksheet dimensions 
			            $sheet = $objPHPExcel->getSheet(0); 
			            $highestRow = $sheet->getHighestRow(); 
			            $highestColumn = $sheet->getHighestColumn(); 
			            $i=1;
			            $name= $sheet->getCellByColumnAndRow(0, $i)->getValue();
			            $number= $sheet->getCellByColumnAndRow(1, $i)->getValue();
			                while (strlen($name)>0) {
			                    
									//insert data
				                  	$query = "INSERT INTO `member`(`nom`, `number`) VALUES ('".$name."', '".$number."')";
				                  	$exe_query=mysqli_query($conn,$query);
				                  	$i+=1;
						$name= $sheet->getCellByColumnAndRow(0, $i)->getValue();
			            $number= $sheet->getCellByColumnAndRow(1, $i)->getValue();
			                    } 
			                }
			                header('Location: index.php?page=add&m='.$i);

?>