<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="images/favicon.png"/>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | Montalban Waterpark</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Montalban </b>Waterpark</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    
    
    <h2>
		     <?php
							if(isset($_GET['res'])){
			    				$resp = $_GET['res'];
			    				if ($resp=="Log-in successful"){
			    					echo "
			    					<script>
			    					    window.location.href='index.php';
			    					</script>
			    					";
			    				}
								else{
									echo $resp;
			    				}
			    			}
							else{
								echo "Please Log-in";
							}
			  ?>
		</h2>
		<form action="in.php" method="post">
			<div class="form-group has-feedback">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				<input type="text" class="form-control" name="name" class="name" placeholder="" required="" maxlength="30">
				<div class="clearfix"></div>
				
			</div>
			<div class="form-group has-feedback">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				<input type="password" class="form-control"  maxlength="30" name="password" class="password" placeholder="" required="">				
				<div class="clearfix"></div>
			</div>
			<div class="login-w3">
					<input type="submit" class="btn btn-primary btn-block btn-flat" class="login" name="login" value="Sign In">
			</div>
			<div class="clearfix"></div>
		</form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstra 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
