<?php

include("weblock.php");
?><?php
//include("head.php");
?>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Montalban Waterpark and Garden Resort</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" href="dist/css/devStyle.css">
	<link rel="shortcut icon" href="images/favicon.png"/>

	<!-- Include Required Prerequisites -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.3/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.css"/>
 
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.3/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.js"></script>
	
	<script src="dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
 
	<!-- Include Date Range Picker -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	
	
	
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- Main Header -->
		
		<!-- Left side column. contains the logo and sidebar -->
		<?php
		include("sidebar.php");
		?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<!-- Main content -->
			<section class="content container-fluid">
			
			<div class="row">
				<div id="MyDateDisplay" class="dateDisplay"></div>
				<div id="MyClockDisplay" class="clock"></div>
			</div>

		 
        <section class="content-header">
      <h1>
      
        <small> </small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Change Password</h3>

              <div class="box-tools">
                
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
            <?php
 		        include("php_connect.php");
 		        session_start();
 		        $user = $_SESSION["user"];
 		        $sql = "SELECT * FROM staff WHERE Username='$user'";
 		        $res = mysqli_query($conn, $sql);
 		        $row = mysqli_fetch_array($res);
 		        ?>
 		        
 		        <center>
 		            <div style="width:70%; height:225px;"><img src="<?php echo 'data:image/jpeg;base64,'.base64_encode( $row['ProfilePic'] ).''; ?>" alt="" style="max-height:225px; border: 1px "/></div>
 		        </center>
 		        <center>
			<form action="changepw.php" id="changepwForm" method="post">
 		        <div class="form-group" >
 		        &nbsp;&nbsp;<label for="exampleInputPassword1">Old Password</label>
			<input type="password" style="width:450px;"  name="opw" class="form-control" maxlength="30" required id="opw" >
 		        </div>
 		        
 		        <div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" style="width:450px;" name="pw" class="form-control" maxlength="30" required id="pw" >
		  	</div>
		  	
		  	<div class="form-group">
			<label for="exampleInputPassword1">Confirm Password</label>
			<input type="password" style="width:450px;" class="form-control" name="cpw" required maxlength="30" id="cpw" >
		 	</div>
		 	
		 	<div style="height:20px">
			<button type="submit"  onclick="return chk()" class="btn btn-success">Change Password</button>
			</div>
			</center>
			</form>
 		              
            </div>
             <script>
        function chk(){
            //check if they are the same
            var pw = $("#pw").val();
            var cpw = $("#cpw").val();
            var opw = $("#opw").val();
            
            if(pw == "" || cpw == "" || opw == ""){
                swal("Validation", "Please type a valid input.", "error");
                return false;
            }
            else if(pw != cpw){
                swal("Validation", "Passwords do not match.", "error");
                return false;
            }
            else{ //check if they match with the old password
                //ajax here to check pw
                  
                  $.ajax({
                    type:"post",
                    data:{
                        pw:opw,
                        npw: pw
                    },
                    url:"changepw.php",
                    success:function(data){
                        if(data == "not"){
                            swal("Validation", "Password does not match the old one.", "error");
                            return false;  
                        }
                        else{
                             swal("Success", "Password successfully changed.", "success");
                             $("#opw").val("");
                             $("#cpw").val("");
                             $("#pw").val("");
                        }
                    }
                  });
                  
                  return false;
            }
        }
    </script>
    <br>
    <br>
    <br>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	<?php
	if(isset($_GET["mess"])){
	?>
		<script>
			swal("Success", "Profile successfully updated.", "success");
			history.pushState(null, '', '/profile.php');
		</script>
	<?php
	}
	?>
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">User Profile</h3>
	      
              <div class="box-tools">
                
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
            <form action="update_staff.php" method="post">
            <center>
			    
	<?php
	//$row ung name nng variable
	$as = $_SESSION["as"];
	$name = $row["Name"];
	$number = $row["ContactNumber"];
	$email = $row["Email"];
	$address = $row["Address"];
	?>
			    
	  <div class="form-group">
		<label for="exampleInputEmail1">Username</label>
		<input type="" style="width:450px;" class="form-control" readonly id="exampleInputEmail1" value="<?php echo $user; ?>">
	  </div>
	  
	  
	  <div class="form-group">
		<label for="exampleInputEmail1">Position</label>
		<input type="" style="width:450px;" class="form-control" readonly id="exampleInputEmail1" value="<?php echo $as; ?>">
	  </div>
	  
	  <div class="form-group">
		<label for="exampleInputEmail1">Name</label>
		<input type="text" style="width:450px;" class="form-control" required maxlength="40" id="exampleInputEmail1" name="name" value="<?php echo $name; ?>">
	  </div>
	  
	  <div class="form-group">
		<label for="exampleInputEmail1">Contact Number</label>
		<input type="text" style="width:450px;" class="form-control" required maxlength="15"  id="exampleInputEmail1" name="number" value="<?php echo $number; ?>">
	  </div>
	  
	  <div class="form-group">
		<label for="exampleInputEmail1">Email address</label>
		<input type="email" style="width:450px;" class="form-control"  required maxlength="40" id="exampleInputEmail1" name="email" value="<?php echo $email; ?>">
	  </div>
	  
	  
	  <div class="form-group">
		<label for="exampleInputEmail1">Address</label>
		<input type="text" style="width:450px;" class="form-control"  required maxlength="40"  id="exampleInputEmail1" name="address" value="<?php echo $address; ?>">
	  </div>
	  
	  <div style="height:20px">
	  <button type="submit" name="submit" style="" class="btn btn-success">Submit Changes</button>
	  </div>
	</form>
	</center>
	<br>
	<br>
	<br>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
    </section>
		
			<!-- /.content -->
		</div>
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<!-- Default to the left -->
			<strong>Copyright &copy; 2017
				<a href="#">Montalban Waterpark and Garden Resort</a>.</strong> All rights reserved.
		</footer>

	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED JS SCRIPTS -->
</body>


<script>

Date.prototype.addDays = function(days) {
  var dat = new Date(this.valueOf());
  dat.setDate(dat.getDate() + days);
  return dat;
}

$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + (day);
	$('#txtDate').attr('min', maxDate);
	$('#txtDate').val(maxDate);
	
	var inDate = $("#txtDate").val();
	var inDate_ = new Date(inDate);
	var inDatex = inDate_.addDays(1);
    var month_ = inDatex.getMonth() + 1;
    var day_ = inDatex.getDate();
    var year_ = inDatex.getFullYear();
    if(month_ < 10)
        month_ = '0' + month_.toString();
    if(day_ < 10)
        day_ = '0' + day_.toString();
	var tomorrow = year_ + '-' + month_ + '-' + (day_);
	
	$('#txtDate').attr('min', tomorrow);
	$('#txtDate').val(tomorrow);
});
</script>

	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
	<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->

<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
<!-- morris JavaScript -->	
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>

</html>