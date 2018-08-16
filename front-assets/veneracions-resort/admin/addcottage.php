<?php
session_start();
include './auth.php';
$re = mysql_query("SELECT * from admin where username = '" . $_SESSION['username'] . "'  AND password = '" . $_SESSION['password'] . "' ");
echo mysql_error();
if (mysql_num_rows($re) > 0) {

} else {
    session_destroy();
    header('location:index.htm');
}

$total = "";
$view = "";
$size = "";
$rate = "";
$desc = "";
$occupancy = "";
$imgpath = "";
$room_name = "";
$imageFileType = pathinfo($imgpath, PATHINFO_EXTENSION);
$uploadDir = "../img/";
$imagename = $_FILES['img']['name'];
$imgpath = $uploadDir . $imagename . $imageFileType;
$uploadDirForSql = "img/";
$imgpathForSQL = $uploadDirForSql . $imagename . $imageFileType;

$room_name = $_POST['room_name'];
if (isset($_POST['total_room'])) {
    $total = $_POST['total_room'];
}
if (isset($_POST['view'])) {
    $view = 'na';
    // $view = $_POST['view'];
}
if (isset($_POST['size'])) {
    $size = 'sqft';
    // $size = $_POST['size'];
}
if (isset($_POST['rate'])) {
    $rate = $_POST['rate'];
}
if (isset($_POST['desc'])) {
    $desc = $_POST['desc'];
}
if (isset($_POST['occupancy'])) {
    $occupancy = $_POST['occupancy'];
}

$sql = "INSERT INTO room (total_room, occupancy, size, view, room_name, descriptions, rate, imgpath, isCottage) VALUES ('" . $total . "', '" . $occupancy . "', '" . $size . "', '" . $view . "', '" . $room_name . "', '" . $desc . "', '" . $rate . "', '" . $imgpathForSQL . "',1)";
$result = mysql_query($sql);
echo mysql_error();
move_uploaded_file($_FILES["img"]["tmp_name"], $imgpath);

header('Refresh: 3;url=cottages.php');

echo "<!DOCTYPE html>\n";
echo "<html lang=\"en\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n";
echo "\n";
echo "    <!-- Bootstrap core CSS -->\n";
echo "    <link href=\"../admin2/css/bootstrap.min.css\" rel=\"stylesheet\">\n";
echo "    <!-- Custom styles for this template -->\n";
echo "    <link href=\"../admin2/css/dashboard.css\" rel=\"stylesheet\">\n";
echo "    <link href=\"../admin2/css/style.css\" rel=\"stylesheet\">\n";
echo "    <link rel=\"stylesheet\" href=\"../admin2/css/fontello.css\">\n";
echo "    <link rel=\"stylesheet\" href=\"../admin2/css/animation.css\"><!--[if IE 7]><link rel=\"stylesheet\" href=\"css/fontello-ie7.css\"><![endif]-->\n";
echo "    \n";
echo "<body>\n";
echo "<div class=\"container\">\n";
echo "    <div class=\"row\">\n";
echo "        <div class=\"col-xs-3\">\n";
echo "        </div>\n";
echo "        <div class=\"col-xs-6 \">\n";
echo "        <h4> Success. Please wait few seconds for redirection...<i class=\"icon-spin4 animate-spin\" style=\"font-size:28px;\"></i></h4>\n";
echo "        \n";
echo "        </div>\n";
echo "        <div class=\"col-xs-3\">\n";
echo "        </div>\n";
echo "    </div>\n";
echo "</div>\n";
echo "\n";
echo "\n";
echo "</body></html>";
