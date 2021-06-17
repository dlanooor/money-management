<?php

 require '../config.php';


 $id  = $_POST["id"];


 $sql = "DELETE FROM moneytable WHERE id = '".$id."'";


 $result = pg_query($dbconn, $sql);


 echo json_encode([$id]);


?>