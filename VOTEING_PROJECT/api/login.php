<?php
session_start();
include('connect.php');
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

$query = "SELECT * FROM voting WHERE mobile='$mobile' AND role='$role'";
$result = mysqli_query($connect, $query);

if ($result) {
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password']; 
        if ($hashed_password===$password) {
          $qu="SELECT * from voting where role=2";
          $group_result = mysqli_query($connect, $qu);
          $groupdata=mysqli_fetch_all($group_result,MYSQLI_ASSOC);
          $_SESSION['userdata']=$row;
          $_SESSION['groupdata']=$groupdata;
          echo '<script>alert("Login Sucessful"); window.location="../routs/dashboard.php";</script>';
        } else {
          
            echo '<script>alert("Invalid Credentials or user not found"); window.location="../";</script>';
        }
    } else {
    
        echo '<script>alert("Invalid Credentials or user not found"); window.location="../";</script>';
    }
} else {
    echo "Error: " . mysqli_error($connect);
}

mysqli_free_result($result);
mysqli_close($connect);
?>
