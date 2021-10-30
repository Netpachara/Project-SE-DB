<?php include 'connect.php';

    session_start();

    if(isset($_POST['btn_login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
    }

    $result = "SELECT * FROM login where username = '$username' and password = '$password'";
    $rlt = mysqli_query($connect,$result);
    $row = mysqli_fetch_assoc($rlt);
    if($_POST['username'] == $row['username'] && $_POST['password'] == $row['password'] && $row['type'] == 1){
        $_SESSION['username_student']=$username;
        header("location: http://127.0.0.1/RegWeb/StudentInfo.php");
    }
    elseif($_POST['username'] == $row['username'] && $_POST['password'] == $row['password'] && $row['type'] == 2){
        $_SESSION['username_teacher']=$username;
        header( "location: http://127.0.0.1/RegWeb/EnrollTeach.php" );
    }
    elseif($_POST['username'] == $row['username'] && $_POST['password'] == $row['password'] && $row['type'] == 3){
        $_SESSION['username_admin']=$username;
        header( "location: http://127.0.0.1/RegWeb/AdminInfo.php" );
    }
    else{
        header( "location: http://127.0.0.1/RegWeb/Login.php" );
    }
    mysql_close($connect);
?>