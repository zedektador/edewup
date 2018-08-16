<?php
session_start();
include './auth.php';
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

$re = mysql_query("SELECT * from admin where username = '" . $_SESSION['username'] . "' AND password = '" . $_SESSION['password'] . "' ");
echo mysql_error();
if (mysql_num_rows($re) > 0) {
} else {
    session_destroy();
    // header("location: index.html");
}

if (isset($_POST['booking_id']) && !empty($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];
    $amount_paid = $_POST['amount_paid'];
    $total_amount = $_POST['total_amount'];
    $payment_status = "Pending";
    console_log($_POST);
    if($amount_paid!=0){
        if($total_amount != $amount_paid){
            $payment_status="Pending";
        }
        else{
            $payment_status="Fully Paid";
        }
    }
    $result = mysql_query("UPDATE booking SET amount_paid = '$amount_paid', payment_status = '".$payment_status."' WHERE booking_id='" . $booking_id . "'");
    echo mysql_error();
    header('Refresh: 3;url=view-payment.php?booking_id='.$booking_id.'');
    echo "<!DOCTYPE html>\n";
    echo "<html lang=\"en\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n";
    echo "\n";
    echo "    <!-- Bootstrap core CSS -->\n";
    echo "    <link href=\"../admin2/css/bootstrap.min.css\" rel=\"stylesheet\">\n";
    echo "    <!-- Custom styles for this template -->\n";
    echo "    <link href=\"../admin2/css/dashboard.css\" rel=\"stylesheet\">\n";
    echo "	<link href=\"../admin2/css/style.css\" rel=\"stylesheet\">\n";
    echo "	<link rel=\"stylesheet\" href=\"../admin2/css/fontello.css\">\n";
    echo "    <link rel=\"stylesheet\" href=\"../admin2/css/animation.css\"><!--[if IE 7]><link rel=\"stylesheet\" href=\"css/fontello-ie7.css\"><![endif]-->\n";
    echo "    \n";
    echo "<body>\n";
    echo "<div class=\"container\">\n";
    echo "	<div class=\"row\">\n";
    echo "		<div class=\"col-xs-3\">\n";
    echo "		</div>\n";
    echo "		<div class=\"col-xs-6 \">\n";
    echo "		<h4> Success. Please wait few seconds for redirection...<i class=\"icon-spin4 animate-spin\" style=\"font-size:28px;\"></i></h4>\n";
    echo "		\n";
    echo "		</div>\n";
    echo "		<div class=\"col-xs-3\">\n";
    echo "		</div>\n";
    echo "	</div>\n";
    echo "</div>\n";
    echo "\n";
    echo "\n";
    echo "</body></html>";

}
