<?php
include './connect.php';
if(isset($_GET['data'])){
$data = $_GET['data'];
$sql = "SELECT name FROM storemusic WHERE name LIKE '$data%'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo $row['name']."</br>";
}
//Đóng kết nối
mysqli_close($conn);

}
?>