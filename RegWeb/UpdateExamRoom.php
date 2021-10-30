<?php include 'connect.php'; ?>

<?php
    session_start();
    $username = $_SESSION['username_admin'];
    $course_ID =  $_POST['courseID'];
    $exam_room = $_POST['exam_room'];
    $ex_capacity = $_POST['capacity'];
    $ex_date = "0";
    $teacher = $_POST['teacher'];
    $teacher_s = $_POST['teacher_support'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];


    $split = explode(" ",$course_ID);
    $courseID = $split['0'];
    $comp_examschdule = $courseID;
    $comp_examschdule .= $split['1'];
    $comp_examschdule .= $split['2'];
    $comp_examschdule .= $split['3'];
    $comp_examroom = $courseID;
    $comp_examroom .= $split['1'];
    $comp_examroom .= $split['2'];
    $comp_examroom .= $split['3'];
    $comp_examroom .= $exam_room;

    $result = $connect->prepare("insert into schduling_exam(course_ID, ex_capacity, ex_date, ex_room, t_ID1, t_ID2, comp_examschdule, comp_examroom) values(?,?,?,?,?,?,?,?)");
    $result->bind_param("siisssss",$courseID, $ex_capacity, $ex_date, $exam_room, $teacher, $teacher_s,  $comp_examschdule, $comp_examroom);
    $result->execute();
    #if($result){
    #   echo '<script type ="text/javascript"> alert("Data Updated") </script>';
    #}
    #else{
    # echo '<script type ="text/javascript"> alert("Fuck you") </script>';
    #}
    header("location: http://127.0.0.1/RegWeb/ModifyExamRoom.php" );
?>  


