<?php  
header('Content-type: application/json');  
$jsonObject;
// $sharingArray = array();
$conn = mysql_connect("localhost", "root", "toor");
mysql_select_db("sharingfridge", $conn);

$requestString = $_POST["share"];

$iteminfo= json_decode($requestString, true);
$it = $iteminfo['item'];
$ca = $iteminfo['category'];
$am = $iteminfo['amount'];
$at = $iteminfo['addtime'];
$et = $iteminfo['expiretime'];
$im = $iteminfo['imageurl'];
$ow = $iteminfo['owner'];
$gn = $iteminfo['groupname'];

$requestSQL = "INSERT INTO items(item,category,amount,addtime,expiretime,imageurl,owner,groupname) VALUES ('$it','$ca','$am','$at','$et','$im','$ow','$gn')";
mysql_query($requestSQL);

// $sqlQuery = "SELECT * FROM sharings";
// $result = mysql_query($sqlQuery);

// while ( $row = mysql_fetch_array($result) ) {
// 	$jsonObject = array('username' => $row['username'], 'category' => $row['category'], 'amount' => $row['amount'], 'date' => $row['time'], 'comment' => $row['comment']);
// 	array_push($sharingArray, $jsonObject);
// }
$result = array('result' => 'success');
echo json_encode($result);

mysql_close($conn);

?> 
