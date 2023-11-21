<?php 
include('connection.php');
$username = $_POST['username'];
$st_id = $_POST['st_id'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$industry = $_POST['industry'];
$comment = $_POST['comment'];
$id = $_POST['id'];

$sql = "UPDATE `users` SET  `st_id`='$st_id' ,  `comment`='$comment' WHERE id='$id' ";
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