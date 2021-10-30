<?php include 'connect.php'; ?>
<?php
session_start();
$username = $_SESSION['username_admin'];
if(!isset($_SESSION['username_admin'])){
    header( "location: http://127.0.0.1/RegWeb/Login.php");
}
$admin_info = "SELECT * FROM admin,department,faculty where ad_email = '$username' AND admin.dept_ID = department.dept_ID AND department.fac_ID = faculty.fac_ID";
$rlt = mysqli_query($connect,$admin_info);
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
            <a style ="background-color:grey; border-color:grey;" href="http://127.0.0.1/RegWeb/Logout.php" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">ออกจากระบบ/Logout</a>
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
            <h3><span class="badge bg-secondary"><img src="picture/user_icon.png" width = "30" height = "30" style = "margin: 5px; ">ข้อมูลเจ้าหน้าที่ภาควิชา</span><h3>
            <img src=<?="picture/",$username,'.jpg'?> width = "140" height = "180">
            <table style = "text-align: left; margin: 20; font-size:20px;">
            <?php foreach($rlt as $data){ ?>
                <tr>
                    <td><strong>ชื่อ-สกุล: </strong></td>
                    <td><?=$data['ad_fname'],' ',$data['ad_lname']?></td>
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
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/AdminInfo.php">จัดการข้อมูลกระบวนวิชาที่เปิดสอน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/ModifyCourseAdmin.php">เเก้ไขกระบวนวิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeleteCourseAdmin.php">ลบข้อมูลวิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="http://127.0.0.1/RegWeb/ModifyExamRoom.php">จัดการข้อมูลห้องสอบ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptTeachAdmin.php">ตารางเรียนภาควิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptExamAdmin.php">ตารางสอบภาควิชา</a>
                </li>
            </ul>
            <form method = "POST" action = "UpdateExamRoom.php">
                <h5><label for='type' class = 'col-sm-3 control-label' style = "margin-top: 20;">Select semester & year</label></h5>
                <div class = 'from-group'>
                    <div class="clo-sm-12" style="margin-top: 20;">
                        <select name="semester" class="form-contorl" required>
                            <option value="" selected="selected">- Select semester -</option>
                            <option value= '1'>1</option>
                            <option value= '2'>2</option>
                            <option value= 's'>summer</option>
                        </select>
                        <select name="year" class="form-contorl" required>
                            <option value="" selected="selected">- Select year -</option>
                            <option value= '64'>2564</option>
                            <option value= '65'>2565</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <?php
                        $course_open = "SELECT * FROM `schduling_lec` 
                        INNER JOIN course
                        ON schduling_lec.course_lecID = course.course_ID
                        INNER JOIN teacher
                        ON course.db_ID = teacher.dt_ID
                        WHERE teacher.t_email = 't001'";
                        $course_open = mysqli_query($connect,$course_open);
                    ?>
                    <h5><label for='type' class = 'col-sm-3 control-label' style = "margin-top: 20;">Select Course with section</label></h5>
                    <div class = 'from-group'>
                        <div class="clo-sm-12" style="margin-top: 20;">
                            <select name="courseID" class="form-contorl" required>
                                <option value="" selected="selected">- Select course -</option>
                                <?php foreach($course_open as $course_open){ ?>
                                <option value= '<?=$course_open['course_lecID'],' ',$course_open['section'],' ',$course_open['semester'],' ',$course_open['year']?>'><?=$course_open['course_lecID'],' ',$course_open['coursename'],' (',$course_open['section'],')'?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div style="margin-top: 15;">
                    <?php 
                        $lecture_room = "SELECT * FROM `room`
                        INNER JOIN admin
                        ON room.dr_ID = admin.dept_ID                        
                        WHERE admin.ad_email = '$username'";
                        $lec_room = mysqli_query($connect,$lecture_room);
                        $lab_room = mysqli_query($connect,$lecture_room);
                    ?>
                    <h5><label for='type' class = 'col-sm-3 control-label' style = "margin-top: 20;">Select Exam room</label></h5>
                    <div class = 'from-group'>
                        <div class="clo-sm-12" style="margin-top: 20;">
                            <select name="exam_room" class="form-contorl" required>
                                <option value="" selected="selected">- Select room -</option>
                                <?php foreach($lec_room as $lec_room){ ?>
                                <option value= '<?=$lec_room['room_ID']?>'><?=$lec_room['room_ID']?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <?php
                        $teacher = "SELECT * FROM teacher WHERE type = '1' AND teacher.dt_ID = (SELECT dept_ID FROM admin WHERE admin.ad_email = '$username')";
                        $teacher_s = "SELECT * FROM teacher WHERE teacher.dt_ID = (SELECT dept_ID FROM admin WHERE admin.ad_email = '$username')";
                        $teacher = mysqli_query($connect,$teacher);
                        $teacher_s = mysqli_query($connect,$teacher_s);
                    ?>
                    <h5><label for='type' class = 'col-sm-3 control-label' style = "margin-top: 20;">Select teacher</label></h5>
                    <div class = 'from-group'>
                        <div class="clo-sm-12" style="margin-top: 20;">
                            <select name="teacher" class="form-contorl" required>
                                <option value="" selected="selected">- Select -</option>
                                <?php foreach($teacher as $teacher){ ?>
                                <option value= '<?=$teacher['t_fname'],' ',$teacher['t_lname']?>'><?=$teacher['t_fname'],' ',$teacher['t_lname']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <h5><label for='type' class = 'col-sm-3 control-label' style = "margin-top: 20;">Select teacher support</label></h5>
                    <div class = 'from-group'>
                        <div class="clo-sm-12" style="margin-top: 20;">
                            <select name="teacher_support" class="form-contorl" required>
                                <option value="" selected="selected">- Select -</option>
                                <?php foreach($teacher_s as $teacher_s){ ?>
                                <option value= '<?=$teacher_s['t_fname'],' ',$teacher_s['t_lname']?>'><?=$teacher_s['t_fname'],' ',$teacher_s['t_lname']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <h5 style = "text-align: left; font-size:20px; margin-top: 15;">จำนวนคนสอบ</h5>
                    <input style="width:300px;" type="text" class="form-control" id="capacity" name = "capacity">
                    <button style ="background-color:grey; border-color:grey; margin-top: 20; margin-bottom: 20;" type="search" class="btn btn-primary" onclick = "alert('Modify success')">insert</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>