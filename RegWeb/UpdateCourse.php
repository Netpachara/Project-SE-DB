<?php include 'connect.php'; ?>
<?php
    session_start();
    $username = $_SESSION['username_teacher'];

    $courseID =  $_POST['courseID'];
    $select_day = $_POST['date'];
    $lec_room = $_POST['lec_room'];
    $lab_room = $_POST['lab_room'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $capacity = $_POST['capacity'];
    
    $course_sec = explode(" ",$courseID);
    $course_ID = $course_sec['0'];
    $section = $course_sec['1'];

    $check_slot = "SELECT comp_slot FROM slot_time WHERE concat(study_day,study_start,study_finish) = '$select_day'";
    $rlt = mysqli_query($connect,$check_slot);
    $row = mysqli_fetch_assoc($rlt);
    $comp_slot = $row['comp_slot'];
    $query = "UPDATE `schduling_lec` 
    SET lec_room = '$lec_room',capacity = '$capacity',date = '$comp_slot' , semester = '$semester', year = '$year', lab_room = '$lab_room' 
    WHERE course_lecID = '$course_ID' AND section = '$section' AND semester = '$semester' AND year = '$year'";
    $query_run = mysqli_query($connect,$query);
    #if($query_run){
    #    echo '<script type ="text/javascript"> alert("Data Updated") </script>';
    #}
    #else{
    #    echo '<script type ="text/javascript"> alert("Fuck you") </script>';
    #}
    header( "location: http://127.0.0.1/RegWeb/ModifyCourseAdmin.php" );
?>  


