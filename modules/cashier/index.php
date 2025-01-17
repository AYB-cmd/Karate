<?php
	session_start();
	
	include '../../library/config.php';
	include '../../classes/class.staff.php';
	include '../../classes/class.client.php';

	$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
    $sub = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : 'all';
	
	$staff = new Staff();
	$client = new Client();
	
	if(!$staff->get_session()){header('location: ../../index.php');}
		
	

    date_default_timezone_set('UTC');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="cache-control" content="no-cache">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
		
		<title>Cashier Module</title>
            
        <link rel="icon" href="../../img/logo.png">
		
		<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed" rel="stylesheet">
		<link href="../../rsc/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../../rsc/magnific-popup/magnific-popup.css" rel="stylesheet">
        
		<link rel="stylesheet" type="text/css" href="../../css/module/module.css">
		<link rel="stylesheet" type="text/css" href="../../css/module/bootstrap_modal.css">
		<link rel="stylesheet" type="text/css" href="../../css/module/modal.css">
		<link rel="stylesheet" type="text/css" href="../../css/main.css">
            
        <script src="../../rsc/jquery/jquery.js"></script>
        <script src="../../rsc/bootstrap/js/bootstrap.js"></script>
            
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="../../rsc/scrollreveal/scrollreveal.min.js"></script>
        <script src="../../rsc/magnific-popup/jquery.magnific-popup.min.js"></script>

        <script src="../../js/main.js"></script>
            
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="http://html2canvas.hertzen.com/build/html2canvas.js"></script>
	</head>
	
	<body id="page-top">
		<div id="HEADER">
			<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                        </button>
                      
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a class="page-scroll" href="index.php?mod=client">Athlits</a>
                            </li>
                     
                            <li class="login-btn hover-menu">
                                <a class="page-scroll"><?php echo strtoupper($_SESSION['username']);?><?php echo file_get_contents("../../svg/dropdown.svg");?></a>
                                
                                <ul class="dropdown-menu">
                                    <a class="page-scroll" href="index.php?mod=profile"><li>Profile</li></a>
                                    <a class="page-scroll" href="index.php?mod=settings"><li>Settings</li></a>
                                    <a class="page-scroll" href="../../logout.php"><li>Logout</li></a>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
		</div>
		
		<div id="MAIN_CONTENT">
			<?php
				switch($module){
					
                    case 'profile':
                        require_once 'datatable/profile/index.php';
                    break;
                    case 'settings':
						require_once 'datatable/settings.php';
                    break;
					default:
						require_once 'datatable/client/index.php';
					break;
				}
			?>
		</div>
	</body>
</html>