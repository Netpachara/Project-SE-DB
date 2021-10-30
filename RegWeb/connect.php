<?php
    $connect = mysqli_connect('localhost', 'root', '', 'register');
    if(mysqli_connect_error()){
      echo 'Failed to Connect';
    }
?>