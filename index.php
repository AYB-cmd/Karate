<?php
    session_start();

    include 'library/config.php';
    include 'library/db.php';
	include 'classes/class.staff.php';
	include 'classes/class.client.php';
	include 'classes/class.promo.php';
	include 'classes/class.category.php';

    $module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';

    $staff = new staff();
	$customer = new Client();
	$promo = new Promo();
	$category = new Category();

    date_default_timezone_set('Utc');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="cache-control" content="no-cache">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">

		<title>6100 Martial Arts & Fitness</title>
            
        <link rel="icon" href="img/logo.png">

		<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed" rel="stylesheet">
		<link href="rsc/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="rsc/magnific-popup/magnific-popup.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/login.css" rel="stylesheet">
        <link href='css/module/fullcalendar.css' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="../../css/module/bootstrap_modal.css">
		<link rel="stylesheet" type="text/css" href="../../css/module/modal.css">
            
        <script src="rsc/jquery/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="js/jquery.cslide.js" type="text/javascript"></script>
        
        <script src="rsc/bootstrap/js/bootstrap.js"></script>
        <script src="js/bootstrapv337.min.js"></script>
        <script src="rsc/scrollreveal/scrollreveal.min.js"></script>
        <script src="rsc/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script src="js/main.js"></script>
            
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            
        <script type="text/javascript">
            $(document).ready(function(){
                $("#cslide-slides").cslide();
                
                $(document).on('submit', '#login', function(event){
                   event.preventDefault();
                    console.log($('email'));
                   console.log($('password').val());
                   var email = $('email').val();
                   var password = $('password').val();
                   var operation = $('operation').val();
                    console.log(password);
                   if(email != '' && password != ''){
                       $.ajax({
                            url:"login.php",
                            method:"POST",
                            data:new FormData(this),
                            dataType:"JSON",
                            contentType:false,
                            processData:false,
                            success:function(data)
                            {
                                if(data.login){
                                    var link = "modules/" + data.level + "/index.php"

                                    window.location.href=link;
                                }
                                else{
                                    alert("Invalid login information.");
                                }
                            }
                       });
                   }
                   else
                       alert("Enter all required fields.")
               });
            });
        </script>
    </head>

    <body id="page-top">
        

            <?php
                if(isset($_SESSION['login'])){
            ?>
            <div class="container-fluid user-loggedin">
                <div class="user-buttons">
                    <div>Welcome, <?php echo $_SESSION['username'];?>&nbsp;|&nbsp;</div>
                    <div><a href="modules/<?php echo strtolower($_SESSION['level']);?>/index.php">Profile</a></div>
                </div>
            </div>
            <?php
                }
            ?>
        </nav>

        <?php
            if($module == ''){
        ?>
       
        <?php
            }
        ?>
        
        <script type="text/javascript">
			$("#slideshow > div:gt(0)").hide();

			setInterval(function() {
			  $('#slideshow > div:first')
				.fadeOut(1000)
				.next()
				.fadeIn(1000)
				.end()
				.appendTo('#slideshow');
			}, 5000);
		</script>

        <div class="content-container">
            <?php
                switch($module){                  
                    default:
                        require_once 'main.php';
                    break;
                }
            ?>
        </div>
    </body>
</html>
