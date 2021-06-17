<?php

require '../config.php';

$id  = $_POST["id"];
$post = $_POST;


  $sql = "UPDATE moneytable SET transaction = '".$post['transaction']."'
    ,amount   = '".$post['amount']."' 
    ,date     = '".$post['date']."' 
    ,category = '".$post['category']."'
    ,inout    = '".$post['inout']."' 
    WHERE id  = '".$id."'";


  $result = pg_query($dbconn, $sql);

  $sql = "SELECT * FROM moneytable WHERE id = '".$id."'"; 


  $result = pg_query($dbconn, $sql);


  $data = pg_fetch_assoc($result);
  pg_close($dbconn);


  echo json_encode($data);


?>