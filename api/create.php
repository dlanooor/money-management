<?php
session_start();
$email= $_SESSION['email_create'];
?>

<?php
require '../config.php';

  $post = $_POST;

  $sql = "INSERT INTO moneytable (transaction, amount, date, category, inout, email) 


	VALUES ('".$post['transaction']."', '".$post['amount']."', '".$post['date']."', '".$post['category']."', '".$post['inout']."', '".$email."')";


  $result = pg_query($dbconn, $sql);


  $sql = "SELECT * FROM moneytable Order by date desc LIMIT 1"; 


  $result = pg_query($dbconn, $sql);


  $data = pg_fetch_assoc($result);
  pg_close($dbconn);


echo json_encode($data);


?>