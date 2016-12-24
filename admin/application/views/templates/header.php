<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<link rel="shortcut icon" href="<?=$appPublic?>/images/favicon.ico">
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
 <!-- Stylesheets
    ============================================= -->

     <!-- Bootstrap Core CSS -->
    <link href="<?=$appPublic?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=$appPublic?>/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=$appPublic?>/css/dist/styles.css" rel="stylesheet">
    <link href="<?=$appPublic?>/css/dist/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=$appPublic?>/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=$appPublic?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Jquery UI CSS -->
    <link href="<?=$appPublic?>/vendor/jquery-ui/css/jquery-ui.css" rel="stylesheet" type="text/css">

    <?php  
        if (!empty($dataTables)){ 
    ?>
    <!-- DataTables CSS -->
    <link href="<?=$appPublic?>/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="<?=$appPublic?>/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <?php } ?>

   <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper">

<!-- top menu -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=$appUrlBase?>"><i class="fa fa-code" aria-hidden="true"></i> <?=$titleAdmin?> </a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="background-color:<?=$this->config->item('baseColor')?> !important;">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?=$appUrlLogOut?>"><i class="fa fa-sign-out fa-fw"></i><?=$lang['salir']?></a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <!-- .top menu -->

    <!-- left menu -->
    <div class="navbar-default sidebar" role="navigation" id="leftMenu">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" id="searchModules" onkeyup="searchModules()" placeholder="<?=$lang['buscar']?>...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="<?=$appUrlBase?>"><i class="fa fa-dashboard fa-fw"></i> <?=$lang['inicio']?></a>
                </li>
                <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> <?=$lang['usuarios']?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <!--
                                <li>
                                    <a href="<?=$this->config->item('appResourcesURLlist')?>users"><?=$lang['adminisitrar']?></a>
                                </li>
                                -->
                                <li>
                                    <a href="<?=$appUrlLogOut?>"><?=$lang['salir']?></a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                <?=$this->data['htmlMenuModules']?>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<!-- .left menu -->
