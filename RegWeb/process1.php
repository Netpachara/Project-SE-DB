<?php include 'connect.php'; ?>
<?php
    $result = "SELECT * FROM course";
    $rlt = mysqli_query($connect,$result);
    while( $row = mysqli_fetch_assoc($rlt) ){
        echo"<tr>";
        echo"<td>$row[course_ID]</td>";
        echo"<td>$row[coursename]</td>";
        echo"<td>$row[lec_credit]</td>";
        echo"<td>$row[lab_credit]</td>";
        echo"<tr><br></br>";
    }
?>


