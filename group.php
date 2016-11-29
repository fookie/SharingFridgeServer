<?php  
header('Content-type: application/json');  
$jsonObject;
$sharingArray = array();
$conn = mysql_connect("localhost", "root", "toor");
mysql_select_db("sharingfridge", $conn);

$requestString = $_POST["group"];
$groupinfo = json_decode($requestString, true);
$action = $groupinfo ['action'];
$username = $groupinfo ['username'];
$groupname=$groupinfo['groupname'];

$responseJson = array('permission' => "denied");
$sqlQuery = "SELECT count(*) as c FROM user where groupname ='".$groupname."'";
$result = mysql_query($sqlQuery);
$row = mysql_fetch_array($result);
$deldummy="delete from items where item='__dummy' and owner='".$username."'";
$makedummy="INSERT INTO items(item,category,amount,addtime,expiretime,imageurl,owner,groupname) VALUES ('__dummy','dummy','-39','','','','$username','$groupname')";
if($row['c']>0){//exist
	if($action=="join"){
	$addquery="update user set groupname ='".$groupname."' where username ='".$username."'"; 
	mysql_query($addquery);
	mysql_query($deldummy);
	mysql_query($makedummy);
	$responseJson = array('permission' => "granted");}
	else{//can't create a exist group
	$responseJson = array('permission' => "denied");
	}
}
else{//not exist 
	if($action=="join"){
	$responseJson = array('permission' => "denied");
	}
	else{
	$addquery="update user set groupname ='".$groupname."' where username ='".$username."'"; 
	mysql_query($addquery);
	mysql_query($deldummy);
	mysql_query($makedummy);
	$responseJson = array('permission' => "granted");
	}}

echo json_encode($responseJson);

mysql_close($conn);

?> 
