<?php
session_start();

$_SESSION['firstname'] = $_POST["firstname"];
$_SESSION['lastname'] = $_POST["lastname"];
$_SESSION['email'] = $_POST["email"];
$_SESSION['phone'] = $_POST["phone"];
$_SESSION['addressline1'] = $_POST["addressline1"];

$_SESSION['postcode'] = $_POST["postcode"];
$_SESSION['city'] = $_POST["city"];
$_SESSION['state'] = 'PH';
$_SESSION['country'] = 'Philippines';

if (isset($_POST["addressline2"])) {
    $_SESSION['addressline2'] = $_POST["addressline2"];
} else {

    $_SESSION['addressline2'] = "";
}
if (isset($_POST["specialrequirements"])) {
    $_SESSION['special_requirement'] = $_POST["specialrequirements"];
} else {

    $_SESSION['special_requirement'] = "";
}

function generateRandomString($length = 10)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

// echo generateRandomString(24); // OR: generateRandomString(24)
$_SESSION['reservation_code'] = generateRandomString(8);
include './auth.php';
mysql_query("INSERT INTO booking (booking_id, reservation_code, total_adult, total_children, checkin_date, checkout_date, special_requirement, payment_status, total_amount, deposit, first_name, last_name, email, telephone_no, add_line1, add_line2, city, state, postcode, country,isReserved,isActive,isModified,isCancelled,isCocoylandia)
VALUES (NULL,'" . $_SESSION['reservation_code'] . "', '0' , 0, '" . $_SESSION['checkin_db'] . "', '" . $_SESSION['checkout_db'] . "', '" . $_SESSION['special_requirement'] . "', 'Pending', '" . $_SESSION['total_amount'] . "', '" . $_SESSION['deposit'] . "', '" . $_SESSION['firstname'] . "', '" . $_SESSION['lastname'] . "', '" . $_SESSION['email'] . "', '" . $_SESSION['phone'] . "', '" . $_SESSION['addressline1'] . "', '" . $_SESSION['addressline2'] . "', '" . $_SESSION['city'] . "', '" . $_SESSION['state'] . "', '" . $_SESSION['postcode'] . "', '" . $_SESSION['country'] . "',1,0,0,0,0)");
echo mysql_error();
$_SESSION['booking_id'] = mysql_insert_id();
$count = 0;
foreach ($_SESSION['room_id'] as &$value0) {

    mysql_query("INSERT INTO `roombook` (`booking_id`, `room_id`, `totalroombook`, `id`,isCocoylandia) VALUES ('" . $_SESSION['booking_id'] . "', '" . $value0 . "', '" . $_SESSION['roomqty'][$count] . "', NULL,0);");
    $count = $count + 1;
}
;

unset($_SESSION['checkin_date']);
unset($_SESSION['checkout_date']);
unset($_SESSION['checkin_db']);
unset($_SESSION['checkout_db']);
unset($_SESSION['datetime1']);
unset($_SESSION['datetime2']);
unset($_SESSION['checkin_unformat']);
unset($_SESSION['checkout_unformat']);
unset($_SESSION['interval']);
unset($_SESSION['total_night']);
unset($_SESSION['room_id']);
unset($_SESSION['roomname']);
unset($_SESSION['roomqty']);
unset($_SESSION['guestqty']);
unset($_SESSION['ind_rate']);
unset($_SESSION['total_amount']);
unset($_SESSION['deposit']);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['email']);
unset($_SESSION['phone']);
unset($_SESSION['addressline1']);
unset($_SESSION['postcode']);
unset($_SESSION['city']);
unset($_SESSION['state']);
unset($_SESSION['country']);
unset($_SESSION['addressline2']);
unset($_SESSION['special_requirement']);
unset($_SESSION['reservation_code']);
unset($_SESSION['booking_id']);
header('Refresh: 2; url=add-walkin.php');
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
echo "		<h4> Booking Success. Please wait few seconds for redirection...<i class=\"icon-spin4 animate-spin\" style=\"font-size:28px;\"></i></h4>\n";
echo "		\n";
echo "		</div>\n";
echo "		<div class=\"col-xs-3\">\n";
echo "		</div>\n";
echo "	</div>\n";
echo "</div>\n";
echo "\n";
echo "\n";
echo "</body></html>";
