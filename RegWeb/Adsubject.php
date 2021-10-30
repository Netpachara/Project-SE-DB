<?php include 'connect.php'; ?>

<?php
    session_start();
    $username = $_SESSION['username_admin'];
    $select_day = $_POST['date'];
    $course_ID =  $_POST['course_ID'];
    $section = $_POST['section'];
    $lec_room = $_POST['lec_room'];
    $lab_room = $_POST['lab_room'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $capacity = $_POST['capacity'];
    $check_slot = "SELECT comp_slot FROM slot_time WHERE concat(study_day,study_start,study_finish) = '$select_day'";
    $rlt = mysqli_query($connect,$check_slot);
    $row = mysqli_fetch_assoc($rlt);
    $comp_schdule = $course_ID;
    $comp_schdule .= $section;
    $comp_schdule .= $semester;
    $comp_schdule .= $year;
    $result = $connect->prepare("insert into schduling_lec(course_lecID, lec_room, capacity, date, section, semester, year, comp_schduling, lab_room) values(?,?,?,?,?,?,?,?,?)");
    $result->bind_param("ssiisssss",$course_ID, $lec_room, $capacity, $row['comp_slot'], $section, $semester, $year, $comp_schdule, $lab_room);
    $result->execute();
    if($result){
        echo '<script type ="text/javascript"> alert("Data Updated") </script>';
    }
    else{
       echo '<script type ="text/javascript"> alert("Fuck you") </script>';
    }
    header("location: http://127.0.0.1/RegWeb/AdminInfo.php" );
?>  


