<?php include 'connect.php'; ?>
<?php
    session_start();
    $username = $_SESSION['username_teacher'];

    $course_ID =  $_POST['courseID'];
    $examday = $_POST['examday'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];

    $check_exam = "SELECT comp_exam FROM exam_time WHERE concat(ex_date,exam_start,exam_finish) = '$examday'";
    $rlt = mysqli_query($connect,$check_exam);
    $row = mysqli_fetch_assoc($rlt);
    $comp_exam = $row['comp_exam'];
    $query = "UPDATE `schduling_exam` 
    SET ex_date = '$comp_exam'
    WHERE course_ID = '$course_ID'";
    $query_run = mysqli_query($connect,$query);
    #if($query_run){
    #    echo '<script type ="text/javascript"> alert("Data Updated") </script>';
    #}
    #else{
    #    echo '<script type ="text/javascript"> alert("Fuck you") </script>';
    #}
    header( "location: http://127.0.0.1/RegWeb/ModifyExamTeacher.php" );
?>  


