<?php  
header('Content-type: application/json');  
$jsonObject;
$locationArray = array();
$conn = mysql_connect("localhost", "root", "toor");
mysql_select_db("sharingfridge", $conn);

$requestString = $_POST["location"];
$locationinfo = json_decode($requestString, true);
$action = $locationinfo ['action'];
$username = $locationinfo ['user'];
$action=$locationinfo['action'];
if($action=="upload"){
    $la=$locationinfo['la'];
    $lo=$locationinfo['lo'];
    $sqlQuery="update user set lo=".$lo.",la=".$la." where username ='".$username."'";
    $result = mysql_query($sqlQuery);
    $responseJson = array('result' =>$result);
    echo json_encode($responseJson);
    mysql_close($conn);
}else{
    $sqlQuery="select username,la,lo from user where groupname = (select groupname from user where username ='".$username."') and username!='".$username."' and la!=0 and lo!=0";
    $resultlist = mysql_query($sqlQuery);
    while($row = mysql_fetch_array($resultlist)){
       $temparr=array('username' => $row['username'],'lo' => $row['lo'],'la' => $row['la']);
       array_push($locationArray,$temparr);
    }
    echo json_encode($locationArray);
    mysql_close($conn);
}

