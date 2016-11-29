<?php  
header('Content-type: application/json');  
$jsonObject;
$conn = mysql_connect("localhost", "root", "toor");
mysql_select_db("sharingfridge", $conn);

$requestString = $_POST["delete"];

$del_info = json_decode($requestString, true);
$amount=$del_info['amount'];
$owner=$del_info['owner'];
$item=$del_info['item'];
if($amount<0){
	$sqlQuery="delete from items where owner ='".$owner."' and item='".$item."' ";
}else{
$sqlQuery="update items set amount = amount - ".$amount." where owner ='".$owner."' and item='".$item."' ";
 }

$result= mysql_query($sqlQuery);
$responseJson = array('result' => $result);
mysql_close($conn);
echo json_encode($responseJson);
?>
