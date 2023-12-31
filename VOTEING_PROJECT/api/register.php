<?php
include("connect.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $groupname=$_POST['groupName'];
    // Validate password match
    if ($password === $cpassword) {
        // File upload handling
        $target_directory = "../uploads/";
        $photo = $_FILES['photo']['name']; // Corrected field name
        $temp_name = $_FILES['photo']['tmp_name']; // Corrected field name
        $target_file = $target_directory . basename($photo);

        if (move_uploaded_file($temp_name, $target_file)) {
            $hashed_password =$password;

            $query = "INSERT INTO voting (name, mobile, password, address, photo, role, status, votes,groupname) 
                      VALUES ('$name', '$mobile', '$hashed_password', '$address', '$photo', '$role', 0, 0,'$groupname')";

            $insert = mysqli_query($connect, $query);

            if ($insert) {
                echo '<script>alert("Registration successful!"); window.location="../";</script>';
            } else {
                echo "Error: " . mysqli_error($connect);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo '<script>alert("Password and confirm password do not match"); window.location="../routs/register.html";</script>';
    }
}
?>
