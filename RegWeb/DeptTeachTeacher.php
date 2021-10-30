<?php include 'connect.php'; ?>
<?php
session_start();
$username = $_SESSION['username_teacher'];
if(!isset($_SESSION['username_teacher'])){
    header( "location: http://127.0.0.1/RegWeb/Login.php");
}
$teacher_info = "SELECT * FROM teacher,department,faculty where t_email = '$username' AND teacher.dt_ID = department.dept_ID AND department.fac_ID = faculty.fac_ID";
$dept_name = "SELECT * FROM department";
$dept = mysqli_query($connect,$dept_name);
$rlt = mysqli_query($connect,$teacher_info)
?>


<html>
<title>Registration System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<head></head>
<div class="container-fluid" style = "background-color: #eee; height:67px;">
    <div class="row">
        <div class="col-sm">
            <img src = "picture/logo.png" width = "64" height = "64" style = "float: left;">
            <div style = "margin:"><h5>ระบบจัดตารางสอนตารางสอบหลักสูตรปริญญาตรี มหาวิทยาลัยเชียงใหม่</h5>
            <h5>Registration System</h5></div>
        </div>
        <div class="col-sm" style = "text-align: right; margin: 13px">
            <a style ="background-color:grey; border-color:grey;" href="http://127.0.0.1/RegWeb/Logout1.php" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">ออกจากระบบ/Logout</a>
        </div>
    </div>
</div>
<body>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

tr:nth-child(even) {
  background-color: #EBF5FF;
}
</style>
<div class="container-fluid">
    <div class="row" style = "top: 15%; position: absolute;">
        <div class="col-md-auto" style =  " text-align: center;">
            <h3><span class="badge bg-secondary"><img src="picture/user_icon.png" width = "30" height = "30" style = "margin: 5px; ">ข้อมูลอาจารย์</span><h3>
            <img src=<?="picture/",$username,'.jpg'?> width = "140" height = "180">
             <table style = "text-align: left; margin: 20; font-size:20px;">
             <?php foreach($rlt as $data){ ?>
                <tr>
                    <td><strong>ชื่อ-สกุล: </strong></td>
                    <td><?=$data['t_fname'],' ',$data['t_lname']?></td>
                </tr>
                <tr>
                    <td><strong>คณะ: </strong></td>
                    <td><?=$data['fac_name']?></td>
                </tr>
                <tr>
                    <td><strong>สาขา: </strong></td>
                    <td><?=$data['dept_name']?></td>
                </tr>
                <?php } ?>
             </table>
        </div>
        <div class="col-md-auto" style =  "text-align: left;">
            <ul class="nav nav-tabs" style="font-size:22px; font-weight:bold;">
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/EnrollTeach.php">ลงทะเบียนสอน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/TeacherInfo.php">ตารางเรียนนักศึกษาในการดูเเล</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/ModifyExamTeacher.php">เเก้ไขวันสอบ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/TeacherTeachTable.php">ตารางสอน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/TeacherExamTable.php">ตารางคุมสอบ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="http://127.0.0.1/RegWeb/DeptTeachTeacher.php">ตารางสอนภาควิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptExamTeacher.php">ตารางสอบภาควิชา</a>
                </li>
            </ul>
            <style>
            .mix, .mix td {
                border: 1px solid #999;
            }
            .mix td {
                height: 90px;
                width: 124px;
            }
            </style>
            <h5 style = "margin-top: 30;">ตารางเรียนภาควิชา จันทร์-พฤหัสบดี</h5>
            <table class = "mix" style = "margin-top: 30; text-align: center; margin-bottom: 100;">
                    <tr>
                        <td>วันเวลา<br>/ห้อง</td>
                        <td>8:00</td>
                        <td>9:00</td>
                        <td>10:00</td>
                        <td>11:00</td>
                        <td>12:00</td>
                        <td>13:00</td>
                        <td>14:00</td>
                        <td>15:00</td>
                        <td>16:00</td>
                        <td>17:00</td>
                        <td>18:00</td>
                    </tr>
                    <?php $room_info = "SELECT * FROM room INNER JOIN teacher ON room.dr_ID = teacher.dt_ID WHERE teacher.t_email = '$username'";
                          $room = mysqli_query($connect,$room_info);
                    ?>
                    <?php foreach($room as $r){ ?>
                    <tr>
                        <td><?=$r['room_ID']?></td>
                        <td colspan = "11">
                                <?php
                                    $room_c = $r['room_ID'];
                                    $dept_course = "SELECT * FROM slot_time
                                    INNER JOIN schduling_lec
                                    ON slot_time.comp_slot = schduling_lec.date
                                    INNER JOIN course
                                    ON schduling_lec.course_lecID = course.course_ID
                                    INNER JOIN teach
                                    ON schduling_lec.course_lecID = teach.course_ID
                                    INNER JOIN teacher 
                                    ON teach.t_ID = teacher.t_ID
                                    WHERE schduling_lec.lec_room = '$room_c' AND schduling_lec.section = teach.t_sec AND slot_time.study_day = 'MTh'
                                    ORDER BY slot_time.comp_slot";
                                    $dept_c = mysqli_query($connect,$dept_course);
                                ?>
                                 <div class="row row-cols-6" style = "margin-left: 0;">
                                    <?php $showcolor; $pixel = 992; $count = 0; $color = array("#F8C471", "#52BE80", "#58D68D", "#A569BD", "#CD6155", "#909497", "#F1948A", "#E59866"); $subject = array();
                                        foreach($dept_c as $dept_c){ 
                                        $pi_sub = 0;
                                        $C1 = strval($dept_c['study_start']); //แปลงเวลาเริ่มเรียนเป็น str
                                        $Part1 = substr($C1, 0, 1); //อักษรเวลาตัวเเรก สมมุติ 8:00 ก็คือ เลข 8
                                        $Part2 = substr($C1, 1, 1); //ตัว :
                                        $Part3 = substr($C1, 2, 1); //เลข 0
                                        $Part4 = substr($C1, 3, 1); //เลข 0
                                        if ($Part1 == 1){ //จุดคำนวณ pixel //ถ้าเวลาเริ่มเรียนเป็น 10 โมงขึ้นไป
                                            $pi_sub = (((int)($Part1)) * 1240) + (((int)($Part2)) * 124) + ((((int)($Part4))/3) * 62);
                                        }
                                        else{ //เวลาเรียน 7-9 โมง ที่ต้องเเยกเพราะว่า 10 โมงขึ้นไปจะมีตัวเลขตัวเลข 1 เข้ามาเพิ่ม
                                            $pi_sub = (((int)($Part1)) * 124) + ((((int)($Part3))/3) * 62);
                                        }
                                        $Remain = $pi_sub - $pixel; //คำนวณหาช่องว่างที่ต้องมีก่อน ถ้า remain เป็น 0 ก็ไม่มีช่องว่างคั่น
                                        $pixel += $Remain;
                                        while($Remain != 0){
                                            if($Remain >= 124){
                                                echo "<div class='col' style = 'width: 124px; height: 90px; text-align: center; padding:30;'></div>";
                                                $Remain -= 124;
                                            }
                                            else if ($Remain >= 62){
                                                echo "<div class='col' style = 'width: 62px; height: 90px; text-align: center; padding:30;'></div>";
                                                $Remain -= 62;
                                            }
                                        }
                                        $C2 = strval($dept_c['study_finish']);  //เหมือนกับข้างบน เเต่เป็นเวลาที่เรียนเสร็จ
                                        $Part1_stop = substr($C2, 0, 1);
                                        $Part2_stop = substr($C2, 1, 1); 
                                        $Part3_stop = substr($C2, 2, 1);
                                        $Part4_stop = substr($C2, 3, 1);
                                        $Study_time = 0;  //เวลาเรียน
                                        $stop = 0; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                        if ($Part1_stop == 1){
                                            $stop = (((int)($Part1_stop)) * 1240) + (((int)($Part2_stop)) * 124) + ((((int)($Part4_stop))/3) * 62);
                                        }
                                        else{
                                            $stop = (((int)($Part1_stop)) * 124) + ((((int)($Part3_stop))/3) * 62);
                                        }
                                        $Study_time = $stop - $pi_sub; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                        $pixel += $Study_time;
                                        if (in_array($dept_c['course_ID'], $subject)){
                                            $showcolor = $subject[$dept_c['course_ID']];
                                        }
                                        else{
                                            $subject[$dept_c['course_ID']] = $color[$count];
                                            $showcolor = $color[$count];
                                            $count += 1;
                                        }?>
                                        <div class="col" style = "border: 1px solid #999; width: <?=$Study_time?>px; height: 90px; text-align: center; padding:15; background-color: <?=$showcolor?>"><?=$dept_c['course_ID']?><br><?='(',$dept_c['section'],')'?><br><?=$dept_c['t_fname'],' ',$dept_c['t_lname']?></div>
                                    <?php } ?>
                                </div>
                        </td>
                        <?php } ?>
                    </tr>
                </table>
                <h5 style = "margin-top: 30;">ตารางเรียนภาควิชา อังคาร-ศุกร์</h5>
                <table class = "mix" style = "margin-top: 30; text-align: center; margin-bottom: 100;">
                    <tr>
                        <td>วันเวลา<br>/ห้อง</td>
                        <td>8:00</td>
                        <td>9:00</td>
                        <td>10:00</td>
                        <td>11:00</td>
                        <td>12:00</td>
                        <td>13:00</td>
                        <td>14:00</td>
                        <td>15:00</td>
                        <td>16:00</td>
                        <td>17:00</td>
                        <td>18:00</td>
                    </tr>
                    <?php $room_info = "SELECT * FROM room INNER JOIN teacher ON room.dr_ID = teacher.dt_ID WHERE teacher.t_email = '$username'";
                          $room = mysqli_query($connect,$room_info);
                    ?>
                    <?php foreach($room as $r){ ?>
                    <tr>
                        <td><?=$r['room_ID']?></td>
                        <td colspan = "11">
                                <?php
                                    $room_c = $r['room_ID'];
                                    $dept_course = "SELECT * FROM slot_time
                                    INNER JOIN schduling_lec
                                    ON slot_time.comp_slot = schduling_lec.date
                                    INNER JOIN course
                                    ON schduling_lec.course_lecID = course.course_ID
                                    INNER JOIN teach
                                    ON schduling_lec.course_lecID = teach.course_ID
                                    INNER JOIN teacher 
                                    ON teach.t_ID = teacher.t_ID
                                    WHERE schduling_lec.lec_room = '$room_c' AND schduling_lec.section = teach.t_sec AND slot_time.study_day = 'TuF'
                                    ORDER BY slot_time.comp_slot";
                                    $dept_c = mysqli_query($connect,$dept_course);
                                ?>
                                 <div class="row row-cols-6" style = "margin-left: 0;">
                                    <?php $pixel = 992;
                                        foreach($dept_c as $dept_c){ 
                                        $pi_sub = 0;
                                        $C1 = strval($dept_c['study_start']); //แปลงเวลาเริ่มเรียนเป็น str
                                        $Part1 = substr($C1, 0, 1); //อักษรเวลาตัวเเรก สมมุติ 8:00 ก็คือ เลข 8
                                        $Part2 = substr($C1, 1, 1); //ตัว :
                                        $Part3 = substr($C1, 2, 1); //เลข 0
                                        $Part4 = substr($C1, 3, 1); //เลข 0
                                        if ($Part1 == 1){ //จุดคำนวณ pixel //ถ้าเวลาเริ่มเรียนเป็น 10 โมงขึ้นไป
                                            $pi_sub = (((int)($Part1)) * 1240) + (((int)($Part2)) * 124) + ((((int)($Part4))/3) * 62);
                                        }
                                        else{ //เวลาเรียน 7-9 โมง ที่ต้องเเยกเพราะว่า 10 โมงขึ้นไปจะมีตัวเลขตัวเลข 1 เข้ามาเพิ่ม
                                            $pi_sub = (((int)($Part1)) * 124) + ((((int)($Part3))/3) * 62);
                                        }
                                        $Remain = $pi_sub - $pixel; //คำนวณหาช่องว่างที่ต้องมีก่อน ถ้า remain เป็น 0 ก็ไม่มีช่องว่างคั่น
                                        $pixel += $Remain;
                                        while($Remain != 0){
                                            if($Remain >= 124){
                                                echo "<div class='col' style = 'width: 124px; height: 90px; text-align: center; padding:30;'></div>";
                                                $Remain -= 124;
                                            }
                                            else if ($Remain >= 62){
                                                echo "<div class='col' style = 'width: 62px; height: 90px; text-align: center; padding:30;'></div>";
                                                $Remain -= 62;
                                            }
                                        }
                                        $C2 = strval($dept_c['study_finish']);  //เหมือนกับข้างบน เเต่เป็นเวลาที่เรียนเสร็จ
                                        $Part1_stop = substr($C2, 0, 1);
                                        $Part2_stop = substr($C2, 1, 1); 
                                        $Part3_stop = substr($C2, 2, 1);
                                        $Part4_stop = substr($C2, 3, 1);
                                        $Study_time = 0;  //เวลาเรียน
                                        $stop = 0; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                        if ($Part1_stop == 1){
                                            $stop = (((int)($Part1_stop)) * 1240) + (((int)($Part2_stop)) * 124) + ((((int)($Part4_stop))/3) * 62);
                                        }
                                        else{
                                            $stop = (((int)($Part1_stop)) * 124) + ((((int)($Part3_stop))/3) * 62);
                                        }
                                        $Study_time = $stop - $pi_sub; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                        $pixel += $Study_time;
                                        if (in_array($dept_c['course_ID'], $subject)){
                                            $showcolor = $subject[$dept_c['course_ID']];
                                        }
                                        else{
                                            $subject[$dept_c['course_ID']] = $color[$count];
                                            $showcolor = $color[$count];
                                            $count += 1;
                                        }?>
                                        <div class="col" style = "border: 1px solid #999; width: <?=$Study_time?>px; height: 90px; text-align: center; padding:15; background-color: <?=$showcolor?>"><?=$dept_c['course_ID']?><br><?='(',$dept_c['section'],')'?><br><?=$dept_c['t_fname'],' ',$dept_c['t_lname']?></div>
                                    <?php } ?>
                                </div>
                        </td>
                        <?php } ?>
                    </tr>
                </table>
        </div>
    </div>
</div>
</body>
</html>