<?php 
session_start();
if (!isset($_SESSION['nom'])) {
      header('Location: ../front/login.php');
    }
    include ('../config/config_db.php');

    $conn=mysqli_connect($dbhost,$dbuser,$dbpassword,$db) or die('errer de connection');
    $sql="SELECT * FROM member";
    $res=mysqli_query($conn,$sql);
    $nbr_member=mysqli_num_rows($res);

    $mumbre='';
    $admin='';
    $add='';
    if (isset($_GET['page'])) {
        $page=$_GET['page'];
        $$page='active';
    }


?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="css/style.css?v=2.1.1" rel="stylesheet"/>
    <link href="css/rtl.css?v=1.1" rel="stylesheet"/>
    <link href="css/demo.css" rel="stylesheet"/>
    <title>ADMIN</title>

<link href="https://fonts.googleapis.com/css2?family=Amiri:ital@1&family=Cairo&family=El+Messiri:wght@500&family=Markazi+Text&family=Tajawal&display=swap" rel="stylesheet">

<!--    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
    <link href="//cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">

    <!-- Style Just for persian demo purpose, don't include it in your project -->
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4 {
            font-family: 'Tajawal', sans-serif;
        }
        .note-popover .popover-content .note-para .note-dropdown-menu, .note-toolbar .note-para .note-dropdown-menu {
            min-width: 216px;
            padding: 5px;
            width: max-content !important;
        }
        .note-popover .popover-content .note-dropdown-menu, .note-toolbar .note-dropdown-menu {
            min-width: 160px;
            width: max-content !important;
        }
    </style>
</head>
<body>
<div class="wrapper" id="app">
 <div class="sidebar" data-color="purple" data-background-color="white">
        <div class="logo">
            <a href="./" class="simple-text logo-normal">
                لوحة التحكم
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item <?php echo $mumbre; ?>">
                    <a class="nav-link" href="?page=mumbre">
                        <i class="fas fa-indent"></i>
                        <p>الحسابات المنشورة</p>
                    </a>
                </li>
                <li class="nav-item <?php echo $add; ?> ">
                    <a class="nav-link" href="?page=add">
                        <i class="fas fa-plus"></i>
                        <p>اضافة مشاركين</p>
                    </a>
                </li>
                <li class="nav-item <?php echo $admin; ?> ">
                    <a class="nav-link" href="?page=admin">
                        <i class="fas fa-user-lock"></i>
                        <p>اعدادات الادمن</p>
                    </a>
                </li>
                <li class="nav-item ${active8} ">
                    <a class="nav-link" href="../front/logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>تسجيل الخروج</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>     


    <div class="main-panel">

        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#pablo">لوحة التحكم</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">

        <?php 
        $page='';
        if (isset($_GET['page'])) {
            $page=$_GET['page'];
        }
        switch ($page) {
            case 'add': ?>
               
                        <!-- $BB add_user -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary ">
                                    <h4 class="card-title">اضافة الحساب</h4>
                                </div>
                                <div class="card-body">
                                    <?php 
                                    if(isset($_GET['m'])){
                                        $m=$_GET['m']-1;
                                    echo "<div class='col'><div class='alert alert-info alert-dismissible fade show' role='alert'>";
                                    echo "تم تحميل ".$m." عضوية"; 
                                    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                                    echo "<span aria-hidden='true'>&times;</span></button></div></div>";
                                }
                                     ?>
                                    <form  method="POST" class="card row" action="upload.php" enctype="multipart/form-data">
                                        <div class="col-md-12">
                                            <div class="col-md-12">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-file-upload form-file-multiple">

                                                            <input type="file" id="file" class="" onchange="$('.inputFileVisible').val($(this)[0].files[0].name)" name="file" style="display: block !important;" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required="true" class="btn btn-default waves-effect"/>
                                                            <div class="input-group">
                                                                <label class="bmd-label-floating" style="color: #000;"> الملف
                                                                    :</label>
                                                                <input  onclick="$('[name=file]').click()" type="text" class="form-control inputFileVisible">
                                                                <span class="input-group-btn">
                                                                    <label for="file" class="btn btn-fab btn-round btn-primary">
                                                                        <i class="fa fa-file"></i>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="submit" name="save"
                                                       class="btn btn-primary pull-right btn-lg btn-block" value="حفظ">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- $EB add_user -->
               <?php 
                break;
            case 'admin': ?>
               <!-- $BB admin -->
                           <?php 
                         
                    if (isset($_POST['save'])){

                        $sql="UPADE user SET nom='".$_POST['user']."'";
                        mysqli_query($conn,$sql); 

                        if (strlen($_POST['pass']) != 0) {
                            if (strlen($_POST['pass']) == strlen($_POST['pas2'])) {
                                Put_Value("admin_pass",md5($_POST['pass']));
                            } else {

                                echo '<script type="text/javascript">
                    <!--
                    window.location = "index.php?page=admin&post=2"
                    //-->
                    </script>';
                            }

                        }
                    }
                    $sql_data="SELECT * FROM user";
                    $usr=mysqli_query($conn,$sql_data);
                    $usr=mysqli_fetch_assoc($usr);
                    $admin_name=$usr['nom'];

                    if (isset($_REQUEST['post']) == 1){
                        $tpl->setVariable ("msg",'<div class="alert alert-success">تم حفظ التغيرات</div>');
                    }
                    if (isset($_REQUEST['post']) == 2){
                        $tpl->setVariable ("msg",'<div class="alert alert-danger">كلمتي المرور غير متطابقة</div>');
                    }
                ?>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-info">
                                    <h4 class="card-title">اعدادات الادمن</h4>
                                </div>
                                

                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">

                                        <div class="input-group mb-3" style="direction:ltr;">
                                            <input type="text" class="form-control" style="text-align: right;"
                                                   name="user" value="<?php echo $admin_name; ?>">
                                            <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">
                            يوزر الادمن
                    </span>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="text-center">
                                            - في حال كنت لاتريد تغير كلمة المرور اتركها فارغة
                                        </div>
                                        <hr>

                                        <div class="input-group mb-3" style="direction:ltr;">
                                            <input type="text" class="form-control" name="pass">
                                            <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">
                            كلمة المرور الجديدة
                    </span>
                                            </div>
                                        </div>


                                        <div class="input-group mb-3" style="direction:ltr;">
                                            <input type="text" class="form-control" name="pas2">
                                            <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">
                            تاكيد كلمة المرور
                    </span>
                                            </div>
                                        </div>

                                        <br/>

                                        <input type="submit" class="btn btn-info pull-right btn-lg btn-block"
                                               name="save" value="حفظ التغيرات">

                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- $EB admin -->
               <?php 
                break;
            default: ?>
                  <!-- $BB index -->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon"><i class="fas fa-street-view"></i>
                                </div>
                                <p class="card-category">عدد المشاركين</p>
                                <h3 class="card-title">
                                    <?php echo $nbr_member; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon"><i class="fas fa-print"></i>
                                </div>
                                <p class="card-category"> عدد التحميلات </p>
                                <h3 class="card-title">
                                    .
                                </h3>
                            </div>
                        </div>
                    </div>
                <?php
                break;
        }
         ?>
                    </div>
                </div>

            </div>
        </div>
        <!--   Core JS Files   -->
        <script src="js/core/jquery.min.js" type="text/javascript"></script>
        <script src="js/core/popper.min.js" type="text/javascript"></script>
<!--        <script src="js/core/bootstrap-material-design.min.js" type="text/javascript"></script>-->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" type="text/javascript"></script>

        <script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Chartist JS -->
        <script src="js/plugins/chartist.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="js/plugins/bootstrap-notify.js"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
<!--        <script src="js/demo.js"></script>-->
        <!-- Bootstrap markdown -->
<!--        <script src="js/ckeditor.js"></script>-->

        <!-- marked-->
<!--        <script src="js/bootstrap3-wysihtml5.all.js"></script>-->

        <!-- to markdown -->
<!--        <script src="js/editor.js"></script>-->
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="//cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

        <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
        <script>
            $('textarea:not(.notsum)').each(function () {
                CKEDITOR.replace($(this).attr('id'), {
                    // filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    // filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    // filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    // filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
                    font_names : "Cairo;Tajawal;Amiri;Markazi Text;El Messiri",
                    contentsCss : 'https://fonts.googleapis.com/css2?family=Amiri:ital@1&family=Cairo&family=El+Messiri:wght@500&family=Markazi+Text&family=Tajawal&display=swap'
    
                });
            });
        </script>
        <script>
            // $('textarea:not(.notsum)').summernote({
            //     placeholder: 'المحتوى',
            //     height: 300,
            //     focus: false,
            // });
        </script>
        <!-- $BB imgs -->
        <script type="text/javascript">
            $(document).ready(function () {

                // Load more data
                $('.load-more').click(function () {
                    var row = Number($('#row').val());
                    var allcount = Number($('#all').val());
                    row = row + 6;

                    if (row <= allcount) {
                        $("#row").val(row);

                        $.ajax({
                            url: 'moreimgs.php',
                            type: 'post',
                            data: {row: row},
                            beforeSend: function () {
                                $(".load-more").html('<i class="fas fa-spinner fa-pulse"></i> جاري التحميل');
                                $('.load-more').css("background", "#32cc63");
                            },
                            success: function (response) {

                                // Setting little delay while displaying new content
                                setTimeout(function () {
                                    // appending posts after last post with class="post"
                                    $(".col-md-4:last").after(response).show().fadeIn("slow");

                                    var rowno = row + 6;

                                    // checking row value is greater than allcount or not
                                    if (rowno > allcount) {

                                        // Change the text and background
                                        $('.load-more').text("وصلت الى نهاية الملفات");
                                        $('.load-more').css("background", "#e52020");
                                    } else {
                                        $(".load-more").text("شاهد المزيد من الملفات");
                                    }
                                }, 2000);


                            }
                        });
                    } else {
                        $('.load-more').html('<i class="fas fa-spinner fa-pulse"></i> جاري التحميل');


                        // Setting little delay while removing contents
                        setTimeout(function () {

                            // When row is greater than allcount then remove all class='post' element after 3 element
                            $('.col-md-4:nth-child(6)').nextAll('.col-md-4').remove().fadeIn("slow");

                            // Reset the value of row
                            $("#row").val(0);

                            // Change the text and background
                            $('.load-more').text("شاهد المزيد من الملفات");

                        }, 2000);


                    }

                });

            });
        </script>

        <!-- $EB imgs -->
</body>
</html>