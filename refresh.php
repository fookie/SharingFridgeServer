<?php  
header('Content-type: application/json');  
$jsonObject;
$sharingArray = array();
$conn = mysql_connect("localhost", "root", "toor");
mysql_select_db("sharingfridge", $conn);

$requestString = $_POST["refresh"];
$groupinfo = json_decode($requestString, true);
$groupname = $groupinfo ['groupname'];

$sqlQuery = "SELECT * FROM items where groupname ='".$groupname."'";
$result = mysql_query($sqlQuery);
while ( $row = mysql_fetch_array($result) ) {
	$jsonObject = array('item' => $row['item'], 'category' => $row['category'], 'amount' => $row['amount'], 'addtime' => $row['addtime'], 'expiretime' => $row['expiretime'],'imageurl' => $row['imageurl'],'owner' => $row['owner'],'groupname' => $row['groupname']);
	array_push($sharingArray, $jsonObject);
}

// echo json_encode($sharingArray, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

// flush();
echo json_encode($sharingArray);

mysql_close($conn);

?> 
