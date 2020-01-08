<?php
date_default_timezone_set('America/Los_Angeles');
$chk_date=date("Y-m-d H:i:s");
$y_date=date("Y-m-d");
echo "\nCurrently MYSQL Verified Users on:\n" .$chk_date;
$dbhost = 'db';
$dbname = 'db';
$dbuser = 'db';
$dbpass = 'db';
$dbport = '3306';
$conn = mysqli_connect($dbhost, $dbname, $dbuser, $dbpass , $dbport);
$my_query = "select count(*) , date(last_updated) as d from teenpatti_user_device_2fa where last_updated > '$chk_date' group by d order by d";
$result = mysqli_query($conn, $my_query);

$tblCnt = 0;
while($tbl = mysqli_fetch_array($result)) {
  $tblCnt++;

$global1= $tbl;
$email_out= $tbl[0]."\n";
}


$yesterday = $y_date("Y-m-d", strtotime("yesterday"));
echo $yesterday;
echo $y_date;
$my_old_query = "select count(*) , date(last_updated) as d from teenpatti_user_device_2fa where last_updated >'$yesterday' and last_updated < '$y_date' group by d order by d";
$result_old = mysqli_query($conn, $my_old_query);
echo $my_old_query;
$tblCntold = 0;
while($tblold = mysqli_fetch_array($result_old)) {
  $tblCntold++;
  $yesterdayData=$tblold[0];
# echo "\nToday ".$email_out." Yestrerday ".$yesterdayData;
}

$day_before = date("Y-m-d", strtotime("-2 days"));
$my_old_query1 = "select count(*) as total , date(last_updated) as d from teenpatti_user_device_2fa where last_updated >'$day_before' and last_updated < '$yesterday' group by d order by d";
$result_old1 = mysqli_query($conn, $my_old_query1);
$tblCntold1 = 0;
while($tblold1 = mysqli_fetch_array($result_old1)) {
 $tblCntold1++;
 $day_before=$tblold1['total'];
}

$three_day = date("Y-m-d", strtotime("-3 days"));
$my_old_query2 = "select count(*) as total , date(last_updated) as d from teenpatti_user_device_2fa where last_updated >'$three_day' and last_updated < '$day_before' group by d order by d;";
$result_old2 = mysqli_query($conn, $my_old_query2);
$tblCntold2 = 0;

echo $my_old_query2;

while($tblold2 = mysqli_fetch_array($result_old2)) {
  $tblCntold2++;
  $three_day=$tblold2['total'];
}

echo "\n Today ".$email_out."\n Yestrerday ".$yesterdayData. " \n Day before yesterday ".$day_before. "\n Two days before today " .$three_day;

#if (!$conn) {
 #   die("Connection failed: " . mysqli_connect_error());
#}
#else{
#	echo "\nConnected successfully to MySql DB\n";
#	mysqli_close($conn);
#}

$new_per = ($email_out / 100) * $yesterdayData;
echo "\nPercentage " .$new_per ."\r\n";

$mailBody= "\nToday: ".$email_out."Yesterday: ".$yesterdayData. "\nPercentage: ".$new_per;

$to_email = "alok.sinha@gmail.com";
   $subject = "Mysql Verified Users Issue";
   $body = "Currently MYSQL Verified Users are:\n" .$mailBody;
   $headers = "From: sender@example.com";

 if ( mail($to_email, $subject, $body, $headers)) {
     echo("\n Email successfully sent\n");
   }
   else {
      echo("Email sending failed.\n");
   }

?>
