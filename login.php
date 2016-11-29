<?php  
header('Content-type: application/json');  
$jsonObject;
$conn = mysql_connect("localhost", "root", "toor");
mysql_select_db("sharingfridge", $conn);

$requestString = $_POST["login"];

$loginInfo = json_decode($requestString, true);
$un = $loginInfo['username'];
$pw = $loginInfo['password'];

$sqlQuery = "SELECT * FROM user where username = '$un'";
$result = mysql_query($sqlQuery);

if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}

while ( $row = mysql_fetch_array($result) ) {
	$jsonObject = array('username' => $row['username'], 'password' => $row['password'], 'groupname' => $row['groupname'],'token'=> $row ['token']);
}

if($pw==$jsonObject['password']){
	$responseJson = array('permission' => "granted",'groupname' => $jsonObject['groupname'],'token' => $jsonObject['token']);
	//$responseJson = array('permission' => "granted");
	echo json_encode($responseJson);
} else {
	$responseJson = array('permission' => "denied");
	echo json_encode($responseJson);
}

mysql_close($conn);

?> 
