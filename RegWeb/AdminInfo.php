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
                    <a class="nav-link active" href="http://127.0.0.1/RegWeb/AdminInfo.php">จัดการข้อมูลกระบวนวิชาที่เปิดสอน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/ModifyCourseAdmin.php">เเก้ไขกระบวนวิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeleteCourseAdmin.php">ลบข้อมูลวิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/ModifyExamRoom.php">จัดการข้อมูลห้องสอบ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptTeachAdmin.php">ตารางเรียนภาควิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptExamAdmin.php">ตารางสอบภาควิชา</a>
                </li>
            </ul>
            <form method = "POST" action = "Adsubject.php">
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
                    <h5 style = "text-align: left; font-size:20px; margin-top: 30;">รหัสกระบวนวิชา</h5>
                    <input style="width:300px;" type="text" class="form-control" id="course_ID" name = "course_ID">
                    <h5 style = "text-align: left; font-size:20px; margin-top: 15;">section</h5>
                    <input style="width:300px;" type="text" class="form-control" id="section" name = "section">
                    <div style="margin-top: 15;">
                    <?php 
                        $lecture_room = "SELECT * FROM `room`
                        INNER JOIN admin
                        ON room.dr_ID = admin.dept_ID                        
                        WHERE admin.ad_email = '$username'";
                        $lec_room = mysqli_query($connect,$lecture_room);
                        $lab_room = mysqli_query($connect,$lecture_room);
                    ?>
                    <h5><label for='type' class = 'col-sm-3 control-label' style = "margin-top: 20;">Select lecture room</label></h5>
                    <div class = 'from-group'>
                        <div class="clo-sm-12" style="margin-top: 20;">
                            <select name="lec_room" class="form-contorl" required>
                                <option value="" selected="selected">- Select room -</option>
                                <?php foreach($lec_room as $lec_room){ ?>
                                <option value= '<?=$lec_room['room_ID']?>'><?=$lec_room['room_ID']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <h5><label for='type' class = 'col-sm-3 control-label' style = "margin-top: 20;">Select labatory room</label></h5>
                    <div class = 'from-group'>
                        <div class="clo-sm-12" style="margin-top: 20;">
                            <select name="lab_room" class="form-contorl">
                                <option value="" selected="selected">- Select room -</option>
                                <?php foreach($lab_room as $lab_room){ ?>
                                <option value= '<?=$lab_room['room_ID']?>'><?=$lab_room['room_ID']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div style="margin-top: 15;">
                    <?php 
                        $slottime = "SELECT * FROM slot_time";
                        $slot_time = mysqli_query($connect,$slottime);
                    ?>
                    <h5><label for='type' class = 'col-sm-3 control-label' style = "margin-top: 20;">Select Slot time Study</label></h5>
                    <div class = 'from-group'>
                        <div class="clo-sm-12" style="margin-top: 20;">
                            <select name="date" class="form-contorl" required>
                                <option value="" selected="selected">- Select Slot time -</option>
                                <?php foreach($slot_time as $slt){ ?>
                                <option value= '<?=$slt['study_day'],$slt['study_start'],$slt['study_finish']?>'><?=$slt['study_day'],' ',$slt['study_start'],'-',$slt['study_finish']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <h5 style = "text-align: left; font-size:20px; margin-top: 15;">จำนวนรับ</h5>
                    <input style="width:300px;" type="text" class="form-control" id="capacity" name = "capacity">
                    <button style ="background-color:grey; border-color:grey; margin-top: 20; margin-bottom: 20;" type="search" class="btn btn-primary" onclick = "alert('Addcourse success')">addcourse</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>