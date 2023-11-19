<?php
include 'conn.php';

//  if sign up button is clicked
if(isset($_POST['register'])){
    $firstname = mysqli_real_escape_string($_POST['firstname']);
    $lastname = mysqli_real_escape_string($_POST['lastname']);
    $email = mysqli_real_escape_string($_POST['email']);
    $password = mysqli_real_escape_string($_POST['password']);
    $password_repeat = mysqli_real_escape_string($_POST['password_repeat']);

    //ensuring all form fields are filled properly
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($password_repeat)){
        echo "All fields are required.<br>";
    }
    elseif($password !== $password_repeat){
        echo "Password do not match";
    }
    else{
        //encrypt password
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);

        //INSERT DATA TO DATABASE
        $sql = "INSERT INTO users(firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashed_password')";

        if($conn->query($sql) ===   TRUE){
            echo "Added successfuly<br>";
        } else {
            echo "Error registering user:" .$conn->error . "br" ;
        }
    }
}
//Close connection
$conn->close();
?>