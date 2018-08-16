<?php
require 'php_connect.php';
date_default_timezone_set('Asia/Manila');
include("head.php");
?>
	
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<!-- tables -->
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<!-- //tables -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<style>
            @media print
            {    
                .no-print, .no-print *
                {
                    display: none !important;
                }
            }
            </style>
	<body onload="printpage()">
	<div class="container">
	<div style="">
	<center>
<img src="images/MONTALBAN.jpg" width="180px" Height="auto" style="">

	</center>
	</div>
	<br>
	 <form method="post" action="print.php">
                            
				<center>
             <table id="table-breakpoint">
                <?php
                    $pname=$_GET['name'];
					$type=$_GET['type'];
					$start=$_GET['start'];
					$end=$_GET['end'];
					$start = date("Y-m-d", strtotime($start));
					$end = date("Y-m-d", strtotime($end));
					    
					if($type=="Sales Report")
					{
					    $tableheader= "
					    <th>OR Number</th>
					    <th>Date Paid</th>
    					<th>Amount Paid</th>
    					<th>Staff Received</th>
    					";
    					$query="SELECT * FROM payment WHERE DatePaid >= '$start' AND DatePaid <= '$end'";
    					$res = mysqli_query($conn,$query);
    					$total=0;
    					while ($row=mysqli_fetch_array($res))
    					    {
    					        $ornumber=$row['ORNumber'];
    					        $datepaid=$row['DatePaid'];
    					        $amountpaid=$row['AmountPaid'];
    					        $staffreceived=$row['StaffReceived'];
    					       
    					        
    					        $print1="<tr><td>$ornumber</td>";
    					        $print2="<td>$datepaid</td>";
    					        $print3="<td>$amountpaid</td>";
    					        $print4="<td>$staffreceived</td></tr>";
    					        $total += $amountpaid;
    					        
    					        $tabledata.=$print1.$print2.$print3.$print4;
    					    }
    					    $total = number_format($total,2);
    					    $start1 = date("F j, Y", strtotime("$start"));
    					    $end1 = date("F j, Y", strtotime("$end"));
    					    $print5="<tr ><td colspan='4'>Total Amount Paid from $start1 up to $end1 is : Php $total</td></tr>";
    					    $tabledata.=$print5;
					}
					elseif($type=="Cancelled Reservation Report" || $type=="Confirmed Reservation Report" || $type=="Pending Reservation Report" || $type=="All Reservation Report")
					{
					    if($type=="Cancelled Reservation Report")
					    {
					        
					        $status="CANCELLED";
					    }
					    elseif($type=="Confirmed Reservation Report")
					    {
					        $status="CONFIRMED";
					    }
					    elseif($type=="Pending Reservation Report")
					    {
					        $status="PENDING";
					    }
					    else
					    {
					       $status=""; 
					    }
					    $tableheader="
					    <tr>
					        <th>Client Name</th>
					        <th>Reservation Code</th>
					        <th>Reservation Date</th>
					        <th>Check-in Date</th>
					        <th>Check-out Date</th>
					        <th>Guests</th>
					        <th width='20%'>Number of Night(s) Stayed</th>
					    </tr>
					    ";
					    if($status=="")
					    {
					       $query="SELECT * FROM reservation JOIN client ON reservation.ClientID=client.ClientID WHERE ReservationDate >= '$start' and ReservationDate <= '$end'";
					    }
					    else
					    {
					       $query="SELECT * FROM reservation JOIN client ON reservation.ClientID=client.ClientID WHERE ReservationDate >= '$start' and ReservationDate <= '$end' and reservation.Status='$status'";
					    }
					    //echo $query;
					    $res = mysqli_query($conn,$query);
    					$total=0;
    					while ($row=mysqli_fetch_array($res))
    					    {
    					        $name=$row['Name'];
    					        $reserDate=$row['ReservationDate'];
    					        $checkin=$row['CheckinDate'];
    					        $checkout=$row['CheckoutDate'];
    					        $checkin1=strtotime($checkin);
    					        $checkout1=strtotime($checkout);
    					        $datediff=$checkout1-$checkin1;
    					        $datedifference = floor($datediff / (60 * 60 * 24));
    					        $reserDate = date("F j, Y", strtotime("$reserDate"));
    					        $checkin = date("F j, Y", strtotime("$checkin"));
    					        $checkout = date("F j, Y", strtotime("$checkout"));
    					        $guests=$row['Guests'];
    					        $resCode=$row['ResCode'];
    					        
    					        $print1="<tr><td>$name</td>";
    					        $print2="<td>$resCode</td><td>$reserDate</td>";
    					        $print3="<td>$checkin</td>";
    					        $print4="<td>$checkout</td>";
    					        $print5="<td>$guests</td>";
    					        $print6="<td>$datedifference</td></tr>";
    					        
    					        $tabledata.=$print1.$print2.$print3.$print4.$print5.$print6;
    					        
    					    }
					}
					elseif($type=="Check-in Report")
					{
					    $tableheader="
					    <tr>
					        <th>Client Name</th>
					        <th>Check-in Date</th>
					        <th>Check-out Date</th>
					        <th>Guests</th>
					        <th width='20%'>Number of Night(s) Stayed</th>
					    </tr>
					    ";
					    function outputload()
					    {
					        
					    }
					    $query="SELECT * FROM checkin JOIN walkin ON walkin.WalkinID=checkin.WalkinID WHERE CheckinDateTime >= '$start' and CheckinDateTime <= '$end'";
					    $res = mysqli_query($conn,$query);
        					$total=0;
        					while ($row=mysqli_fetch_array($res))
        					{
    					        $name=$row['ClientName'];
    					       // $reserDate=$row['ReservationDate'];
    					        $checkin=$row['CheckinDateTime'];
    					        $checkout=$row['CheckoutDateTime'];
    					        $checkin1=strtotime($checkin);
    					        $checkout1=strtotime($checkout);
    					        $datediff=$checkout1-$checkin1;
    					        $datedifference = floor($datediff / (60 * 60 * 24));
    					        //$reserDate = date("F j, Y", strtotime("$reserDate"));
    					        $checkin = date("F j, Y", strtotime("$checkin"));
    					        $checkout = date("F j, Y", strtotime("$checkout"));
    					        $guests=$row['Guests'];
    					        
    					        $print1="<tr><td>$name</td>";
    					        //$print2=null;
    					        $print3="<td>$checkin</td>";
    					        $print4="<td>$checkout</td>";
    					        $print5="<td>$guests</td>";
    					        $print6="<td>$datedifference</td></tr>";
    					        
    					        $tabledata.=$print1.$print3.$print4.$print5.$print6;
    					        
        					}
					    $query="SELECT * FROM checkin JOIN reservation ON reservation.ReservationID=checkin.ReservationID JOIN client ON reservation.ClientID=client.ClientID WHERE CheckinDateTime >= '$start' and CheckinDateTime <= '$end'";
					        $res = mysqli_query($conn,$query);
        					$total=0;
        					while ($row=mysqli_fetch_array($res))
        					{
    					        $name=$row['Name'];
    					       // $reserDate=$row['ReservationDate'];
    					        $checkin=$row['CheckinDateTime'];
    					        $checkout=$row['CheckoutDateTime'];
    					        $checkin1=strtotime($checkin);
    					        $checkout1=strtotime($checkout);
    					        $datediff=$checkout1-$checkin1;
    					        $datedifference = floor($datediff / (60 * 60 * 24));
    					        //$reserDate = date("F j, Y", strtotime("$reserDate"));
    					        $checkin = date("F j, Y", strtotime("$checkin"));
    					        $checkout = date("F j, Y", strtotime("$checkout"));
    					        $guests=$row['Guests'];
    					        
    					        $print1="<tr><td>$name</td>";
    					        //$print2=null;
    					        $print3="<td>$checkin</td>";
    					        $print4="<td>$checkout</td>";
    					        $print5="<td>$guests</td>";
    					        $print6="<td>$datedifference</td></tr>";
    					        
    					        $tabledata.=$print1.$print3.$print4.$print5.$print6;
    					        
        					}
					    
					    
					}
					else
					{
					    
					}
								
				?>
                <thead>
                <tr>
                    
                    <?php echo "<h3>$type</h3>".$tableheader; ?>
                </tr>
                </thead>
                 <tbody>
		
                        <?php
                        echo $tabledata;
                        
						?>
							   
				</tbody>
				</table>
				
				</center>
						
							<br>
							 <input class="no-print" id="printpagebutton" type="button" value="Print This page" onclick="printpage()"/>
Printed by: <?php echo $pname."</br>Date: ".date('F j, Y') ?>


<center>
</form>
	</body>
<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
        window.close()
    }
</script>

	  <style type="text/css">
	<!--Button-->
		#printpagebutton
		{
			border-radius: 4px;
			background-color: #f4511e;
			border: none;
			color: #FFFFFF;
			text-align: center;
			font-size: 20px;
			padding: 10px;
			width: 150px;
			transition: all 0.5s;
			cursor: pointer;
			margin: 2px;
		}
		#printpagebutton span
		{
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		#printpagebutton span:after
		{
			content: '\00bb';
			position: absolute;
			opacity: 0;
			top: 0;
			right: -5px;
			transition: 0.5s;
		}
		#printpagebutton:hover span 
		{
			padding-right: 10px;
		}
		#printpagebutton:hover span:after 
		{
			opacity: 1;
			right: 0;
		}
	</style>
	  
	 <!-- <script src="js/jquery.nicescroll.js"></script> -->
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
	<center>
	<style type="text/css">
		#now
		{
			font-family: Arial;
			font-size: 17px;
			margin-left: 300px;
			position: absolute;
			padding: 42px;
			padding-left: 350px;
		}
		#address
		{
			font-family: Arial;
			font-size: 17px;
			margin-left: 300px;
			position: absolute;
			padding: 45px;
			padding-left: 250px;
		}
		h1
		{
			font-family: Arial;
			font-size: 2em;
			margin-left: 300px;
			position: absolute;
			padding: 7px;
			padding-right: 50px;
			padding-left: 200px;
			
			
		}
		b
		{
			font-family: Arial;
			font-size: 1em;
			margin: 0px 5px;
		}
		td
		{
			margin: 0px 20px;
		}
		#printpagebutton
		{
			border-radius: 4px;
			background-color: #f4511e;
			border: none;
			color: #FFFFFF;
			text-align: center;
			font-size: 20px;
			padding: 10px;
			width: 150px;
			transition: all 0.5s;
			cursor: pointer;
			margin: 2px;
		}
		#printpagebutton span
		{
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}
		#printpagebutton span:after
		{
			content: '\00bb';
			position: absolute;
			opacity: 0;
			top: 0;
			right: -5px;
			transition: 0.5s;
		}
		#printpagebutton:hover span 
		{
			padding-right: 10px;
		}
		#printpagebutton:hover span:after 
		{
			opacity: 1;
			right: 0;
		}
	
	</style>
	