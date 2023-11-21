<?php 
include('connection.php');
// $st_id = $_POST['st_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$industry = $_POST['industry'];
$comment = $_POST['comment'];

$sql = "INSERT INTO `users` (`username`,`email`,`mobile`,`industry`,`comment`) values ('$username', '$email', '$mobile', '$industry', '$comment' )";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>