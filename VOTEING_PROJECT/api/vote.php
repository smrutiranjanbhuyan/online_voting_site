<?php
session_start();
if (!isset($_SESSION["userdata"])) {
    header("Location: ../");
    exit();
}
include('../api/connect.php');
if(isset($_POST['gvotes'], $_POST['gid'])) {

$votes = $_POST['gvotes'];
$total_votes = $votes + 1;
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];
$q1="UPDATE voting SET votes = '$total_votes' WHERE id = '$gid'";
$q2= "UPDATE voting SET status = 1 WHERE id = '$uid'";

$update_vote = mysqli_query($connect,$q1 );
$update_status = mysqli_query($connect,$q2);

if ($update_vote && $update_status) {
    
    $qu = "SELECT * FROM voting WHERE role = 2";
    $group_result = mysqli_query($connect, $qu);
    $groupdata = mysqli_fetch_all($group_result, MYSQLI_ASSOC);

   
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupdata'] = $groupdata;
    echo '<script>alert("Voted Sucessfully."); window.location="../routs/dashboard.php";</script>';
} else {
 
    echo '<script>alert("Some error occurred."); window.location="../routs/dashboard.php";</script>';
}
}else{
    echo '<script>alert("."); </script>';
}
?>
