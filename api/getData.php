<?php
session_start();
$email = $_SESSION['email_get'];
?>
<?php
require '../config.php';

$num_rec_per_page = 5;

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

$start_from = $page * $num_rec_per_page;

$sqlTotal = "SELECT * FROM moneytable";

$sql = "SELECT * FROM moneytable WHERE email LIKE '".$email."' Order By date desc ";

$result = pg_query($dbconn, $sql);
$data = pg_fetch_all($result);

$jsonData = json_encode($data);

$data['data'] = $jsonData;

$result = pg_query($dbconn, $sqlTotal);

$data['total'] = pg_num_rows($result);

pg_close($dbconn);

echo json_encode($data);


?>