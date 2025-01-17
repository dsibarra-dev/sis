<!-- <h1>Welcome to <?php echo $_settings->info('name') ?> - Admin Panel</h1> -->
<!-- <hr class="border-purple"> -->
<style>
    #website-cover{
        width:100%;
        height:30em;
        object-fit:cover;
        object-position:center center;
    }
</style>
<?php if ($_settings->userdata('type') == 1 || $_settings->userdata('type') == 2) { ?>
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-building"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Departments</span>
                <span class="info-box-number text-right">
                    <?php 
                        echo $conn->query("SELECT * FROM `department_list` where delete_flag= 0 and `status` = 1 ")->num_rows;
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-scroll"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Total Courses</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `course_list` where delete_flag= 0 and `status` = 1 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-user-friends"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Students</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `student_list`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-teal elevation-1"><i class="fas fa-file-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Student Academics</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `academic_history`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<hr>
<div class="row align-items-center">
    <div class="col-md-12">
        <img src="<?= validate_image($_settings->info('cover')) ?>" alt="Website Cover" class="img-fluid border w-100" id="website-cover">
    </div>
</div>
<?php }else {?>
<div class="content py-5">
    <div class="card card-outline card-navy shadow rounded-0">
        <div class="card-header">
            <div class="card-tools">
                <button class="btn btn-sm btn-success bg-success btn-flat" type="button" id="print"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid" id="outprint">
                <style>
                    #sys_logo{
                        width:5em;
                        height:5em;
                        object-fit:scale-down;
                        object-position:center center;
                    }
                </style>
                <?php
            $department = $conn->query("SELECT a.id, a.name FROM `department_list` as a 
                INNER JOIN `student_list` as b ON a.name=b.department
                    WHERE b.id='".$_settings->userdata('academic_id')."'");
            while($row = $department->fetch_assoc()){
                $department_id=$row['id'];
                $department_name=$row['name'];
                }
        ?>
        <fieldset>
            <!-- <legend class="text-muted text-center">Academic History : <?=$department_name?></legend> -->
            <h5 class="text-center">First Year - First Semester</h5>
            <table class="table table-stripped table-bordered" id="academic-history">
                <colgroup>
                    <col width="20%">
                    <col width="40%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-light">
                        <th class="py-1 text-center">Course Code</th>
                        <th class="py-1 text-center">Description</th>
                        <th class="py-1 text-center">Units</th>
                        <th class="py-1 text-center">Grade</th>
                        <th class="py-1 text-center">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $academics = $conn->query("SELECT * FROM `course_list`
                                            WHERE department_id='".$department_id."'
                                            AND year=1 AND semester=1");
                    while($row = $academics->fetch_assoc()):?>
                    <tr>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['name'] ?></span>
                        </td>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['description'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <span class=""><?= $row['units'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <?php
                                $grade = $conn->query("SELECT course_id,grade FROM `academic_history`
                                        WHERE student_id='".$_settings->userdata('academic_id')."'
                                        and course_id='".$row['id']."'");
                                $rows = $grade->fetch_assoc();
                                    if (isset($rows['course_id'])) {
                                        if ($rows['course_id'] == $row['id']) {
                                            echo '<b>'.$rows['grade'].'</b>';
                                        }else{
                                            echo ' ';
                                        }
                                    }else{
                                            echo ' ';
                                        }
                                        
                            ?>
                        </td>
                        <td class="px-2 py-1 text-center"><?php
                            $status = $conn->query("SELECT end_status FROM `academic_history`
                            WHERE student_id='".$_settings->userdata('academic_id')."'
                            and course_id='".$row['id']."'");
                            if (mysqli_num_rows($status) >= 1) {
                                while($rows = $status->fetch_assoc()){
                                    switch($rows['end_status']){
                                    case '0':
                                        echo '<span class="rounded-pill badge badge-secondary px-3">Pending</span>';
                                        break;
                                    case '1':
                                        echo '<span class="rounded-pill badge badge-success px-3">Completed</span>';
                                        break;
                                    case '2':
                                        echo '<span class="rounded-pill badge badgedefault bg-maroon px-3">
                                        Drop out</span>';
                                        break;
                                    case '3':
                                        echo '<span class="rounded-pill badge badge-danger px-3">Failed</span>';
                                        break;
                                    case '4':
                                        echo '<span class="rounded-pill badge badge-default border px-3">Transferred-out</span>';
                                        break;
                                    case '5':
                                        echo '<span class="rounded-pill badge badge-default 
                                        bg-gradient-teal text-light px-3">Graduated</span>';
                                        break;
                                    default:
                                        echo '<span class="rounded-pill badge badge-default border px-3">
                                        N/A</span>';
                                        break;
                                    }
                                }
                            }else{
                                echo '<span class="rounded-pill badge badge-secondary px-3">No Grade</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <h5 class="text-center">First Year - Second Semester</h5>
            <table class="table table-stripped table-bordered" id="academic-history">
                <colgroup>
                    <col width="20%">
                    <col width="40%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-light">
                        <th class="py-1 text-center">Course Code</th>
                        <th class="py-1 text-center">Description</th>
                        <th class="py-1 text-center">Units</th>
                        <th class="py-1 text-center">Grade</th>
                        <th class="py-1 text-center">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $academics = $conn->query("SELECT * FROM `course_list`
                                            WHERE department_id='".$department_id."'
                                            AND year=1 AND semester=2");
                    while($row = $academics->fetch_assoc()):?>
                    <tr>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['name'] ?></span>
                        </td>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['description'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <span class=""><?= $row['units'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <?php
                                $grade = $conn->query("SELECT course_id,grade FROM `academic_history`
                                        WHERE student_id='".$_settings->userdata('academic_id')."'
                                        and course_id='".$row['id']."'");
                                $rows = $grade->fetch_assoc();
                                    if (isset($rows['course_id'])) {
                                        if ($rows['course_id'] == $row['id']) {
                                            echo '<b>'.$rows['grade'].'</b>';
                                        }else{
                                            echo ' ';
                                        }
                                    }else{
                                            echo ' ';
                                        }
                                        
                            ?>
                        </td>
                        <td class="px-2 py-1 text-center"><?php
                            $status = $conn->query("SELECT end_status FROM `academic_history`
                            WHERE student_id='".$_settings->userdata('academic_id')."'
                            and course_id='".$row['id']."'");
                            if (mysqli_num_rows($status) >= 1) {
                                while($rows = $status->fetch_assoc()){
                                    switch($rows['end_status']){
                                    case '0':
                                        echo '<span class="rounded-pill badge badge-secondary px-3">Pending</span>';
                                        break;
                                    case '1':
                                        echo '<span class="rounded-pill badge badge-success px-3">Completed</span>';
                                        break;
                                    case '2':
                                        echo '<span class="rounded-pill badge badgedefault bg-maroon px-3">
                                        Drop out</span>';
                                        break;
                                    case '3':
                                        echo '<span class="rounded-pill badge badge-danger px-3">Failed</span>';
                                        break;
                                    case '4':
                                        echo '<span class="rounded-pill badge badge-default border px-3">Transferred-out</span>';
                                        break;
                                    case '5':
                                        echo '<span class="rounded-pill badge badge-default 
                                        bg-gradient-teal text-light px-3">Graduated</span>';
                                        break;
                                    default:
                                        echo '<span class="rounded-pill badge badge-default border px-3">
                                        N/A</span>';
                                        break;
                                    }
                                }
                            }else{
                                echo '<span class="rounded-pill badge badge-secondary px-3">No Grade</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <h5 class="text-center">Second Year - First Semester</h5>
            <table class="table table-stripped table-bordered" id="academic-history">
                <colgroup>
                    <col width="20%">
                    <col width="40%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-light">
                        <th class="py-1 text-center">Course Code</th>
                        <th class="py-1 text-center">Description</th>
                        <th class="py-1 text-center">Units</th>
                        <th class="py-1 text-center">Grade</th>
                        <th class="py-1 text-center">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $academics = $conn->query("SELECT * FROM `course_list`
                                            WHERE department_id='".$department_id."'
                                            AND year=2 AND semester=1");
                    while($row = $academics->fetch_assoc()):?>
                    <tr>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['name'] ?></span>
                        </td>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['description'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <span class=""><?= $row['units'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <?php
                                $grade = $conn->query("SELECT course_id,grade FROM `academic_history`
                                        WHERE student_id='".$_settings->userdata('academic_id')."'
                                        and course_id='".$row['id']."'");
                                $rows = $grade->fetch_assoc();
                                    if (isset($rows['course_id'])) {
                                        if ($rows['course_id'] == $row['id']) {
                                            echo '<b>'.$rows['grade'].'</b>';
                                        }else{
                                            echo ' ';
                                        }
                                    }else{
                                            echo ' ';
                                        }
                                        
                            ?>
                        </td>
                        <td class="px-2 py-1 text-center"><?php
                            $status = $conn->query("SELECT end_status FROM `academic_history`
                            WHERE student_id='".$_settings->userdata('academic_id')."'
                            and course_id='".$row['id']."'");
                            if (mysqli_num_rows($status) >= 1) {
                                while($rows = $status->fetch_assoc()){
                                    switch($rows['end_status']){
                                    case '0':
                                        echo '<span class="rounded-pill badge badge-secondary px-3">Pending</span>';
                                        break;
                                    case '1':
                                        echo '<span class="rounded-pill badge badge-success px-3">Completed</span>';
                                        break;
                                    case '2':
                                        echo '<span class="rounded-pill badge badgedefault bg-maroon px-3">
                                        Drop out</span>';
                                        break;
                                    case '3':
                                        echo '<span class="rounded-pill badge badge-danger px-3">Failed</span>';
                                        break;
                                    case '4':
                                        echo '<span class="rounded-pill badge badge-default border px-3">Transferred-out</span>';
                                        break;
                                    case '5':
                                        echo '<span class="rounded-pill badge badge-default 
                                        bg-gradient-teal text-light px-3">Graduated</span>';
                                        break;
                                    default:
                                        echo '<span class="rounded-pill badge badge-default border px-3">
                                        N/A</span>';
                                        break;
                                    }
                                }
                            }else{
                                echo '<span class="rounded-pill badge badge-secondary px-3">No Grade</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <h5 class="text-center">Second Year - Second Semester</h5>
            <table class="table table-stripped table-bordered" id="academic-history">
                <colgroup>
                    <col width="20%">
                    <col width="40%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-light">
                        <th class="py-1 text-center">Course Code</th>
                        <th class="py-1 text-center">Description</th>
                        <th class="py-1 text-center">Units</th>
                        <th class="py-1 text-center">Grade</th>
                        <th class="py-1 text-center">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $academics = $conn->query("SELECT * FROM `course_list`
                                            WHERE department_id='".$department_id."'
                                            AND year=2 AND semester=2");
                    while($row = $academics->fetch_assoc()):?>
                    <tr>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['name'] ?></span>
                        </td>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['description'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <span class=""><?= $row['units'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <?php
                                $grade = $conn->query("SELECT course_id,grade FROM `academic_history`
                                        WHERE student_id='".$_settings->userdata('academic_id')."'
                                        and course_id='".$row['id']."'");
                                $rows = $grade->fetch_assoc();
                                    if (isset($rows['course_id'])) {
                                        if ($rows['course_id'] == $row['id']) {
                                            echo '<b>'.$rows['grade'].'</b>';
                                        }else{
                                            echo ' ';
                                        }
                                    }else{
                                            echo ' ';
                                        }
                                        
                            ?>
                        </td>
                        <td class="px-2 py-1 text-center"><?php
                            $status = $conn->query("SELECT end_status FROM `academic_history`
                            WHERE student_id='".$_settings->userdata('academic_id')."'
                            and course_id='".$row['id']."'");
                            if (mysqli_num_rows($status) >= 1) {
                                while($rows = $status->fetch_assoc()){
                                    switch($rows['end_status']){
                                    case '0':
                                        echo '<span class="rounded-pill badge badge-secondary px-3">Pending</span>';
                                        break;
                                    case '1':
                                        echo '<span class="rounded-pill badge badge-success px-3">Completed</span>';
                                        break;
                                    case '2':
                                        echo '<span class="rounded-pill badge badgedefault bg-maroon px-3">
                                        Drop out</span>';
                                        break;
                                    case '3':
                                        echo '<span class="rounded-pill badge badge-danger px-3">Failed</span>';
                                        break;
                                    case '4':
                                        echo '<span class="rounded-pill badge badge-default border px-3">Transferred-out</span>';
                                        break;
                                    case '5':
                                        echo '<span class="rounded-pill badge badge-default 
                                        bg-gradient-teal text-light px-3">Graduated</span>';
                                        break;
                                    default:
                                        echo '<span class="rounded-pill badge badge-default border px-3">
                                        N/A</span>';
                                        break;
                                    }
                                }
                            }else{
                                echo '<span class="rounded-pill badge badge-secondary px-3">No Grade</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <h5 class="text-center">Third Year - First Semester</h5>
            <table class="table table-stripped table-bordered" id="academic-history">
                <colgroup>
                    <col width="20%">
                    <col width="40%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-light">
                        <th class="py-1 text-center">Course Code</th>
                        <th class="py-1 text-center">Description</th>
                        <th class="py-1 text-center">Units</th>
                        <th class="py-1 text-center">Grade</th>
                        <th class="py-1 text-center">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $academics = $conn->query("SELECT * FROM `course_list`
                                            WHERE department_id='".$department_id."'
                                            AND year=3 AND semester=1");
                    while($row = $academics->fetch_assoc()):?>
                    <tr>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['name'] ?></span>
                        </td>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['description'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <span class=""><?= $row['units'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <?php
                                $grade = $conn->query("SELECT course_id,grade FROM `academic_history`
                                        WHERE student_id='".$_settings->userdata('academic_id')."'
                                        and course_id='".$row['id']."'");
                                $rows = $grade->fetch_assoc();
                                    if (isset($rows['course_id'])) {
                                        if ($rows['course_id'] == $row['id']) {
                                            echo '<b>'.$rows['grade'].'</b>';
                                        }else{
                                            echo ' ';
                                        }
                                    }else{
                                            echo ' ';
                                        }
                                        
                            ?>
                        </td>
                        <td class="px-2 py-1 text-center"><?php
                            $status = $conn->query("SELECT end_status FROM `academic_history`
                            WHERE student_id='".$_settings->userdata('academic_id')."'
                            and course_id='".$row['id']."'");
                            if (mysqli_num_rows($status) >= 1) {
                                while($rows = $status->fetch_assoc()){
                                    switch($rows['end_status']){
                                    case '0':
                                        echo '<span class="rounded-pill badge badge-secondary px-3">Pending</span>';
                                        break;
                                    case '1':
                                        echo '<span class="rounded-pill badge badge-success px-3">Completed</span>';
                                        break;
                                    case '2':
                                        echo '<span class="rounded-pill badge badgedefault bg-maroon px-3">
                                        Drop out</span>';
                                        break;
                                    case '3':
                                        echo '<span class="rounded-pill badge badge-danger px-3">Failed</span>';
                                        break;
                                    case '4':
                                        echo '<span class="rounded-pill badge badge-default border px-3">Transferred-out</span>';
                                        break;
                                    case '5':
                                        echo '<span class="rounded-pill badge badge-default 
                                        bg-gradient-teal text-light px-3">Graduated</span>';
                                        break;
                                    default:
                                        echo '<span class="rounded-pill badge badge-default border px-3">
                                        N/A</span>';
                                        break;
                                    }
                                }
                            }else{
                                echo '<span class="rounded-pill badge badge-secondary px-3">No Grade</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <h5 class="text-center">Third Year - Second Semester</h5>
            <table class="table table-stripped table-bordered" id="academic-history">
                <colgroup>
                    <col width="20%">
                    <col width="40%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-light">
                        <th class="py-1 text-center">Course Code</th>
                        <th class="py-1 text-center">Description</th>
                        <th class="py-1 text-center">Units</th>
                        <th class="py-1 text-center">Grade</th>
                        <th class="py-1 text-center">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $academics = $conn->query("SELECT * FROM `course_list`
                                            WHERE department_id='".$department_id."'
                                            AND year=3 AND semester=2");
                    while($row = $academics->fetch_assoc()):?>
                    <tr>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['name'] ?></span>
                        </td>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['description'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <span class=""><?= $row['units'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <?php
                                $grade = $conn->query("SELECT course_id,grade FROM `academic_history`
                                        WHERE student_id='".$_settings->userdata('academic_id')."'
                                        and course_id='".$row['id']."'");
                                $rows = $grade->fetch_assoc();
                                    if (isset($rows['course_id'])) {
                                        if ($rows['course_id'] == $row['id']) {
                                            echo '<b>'.$rows['grade'].'</b>';
                                        }else{
                                            echo ' ';
                                        }
                                    }else{
                                            echo ' ';
                                        }
                                        
                            ?>
                        </td>
                        <td class="px-2 py-1 text-center"><?php
                            $status = $conn->query("SELECT end_status FROM `academic_history`
                            WHERE student_id='".$_settings->userdata('academic_id')."'
                            and course_id='".$row['id']."'");
                            if (mysqli_num_rows($status) >= 1) {
                                while($rows = $status->fetch_assoc()){
                                    switch($rows['end_status']){
                                    case '0':
                                        echo '<span class="rounded-pill badge badge-secondary px-3">Pending</span>';
                                        break;
                                    case '1':
                                        echo '<span class="rounded-pill badge badge-success px-3">Completed</span>';
                                        break;
                                    case '2':
                                        echo '<span class="rounded-pill badge badgedefault bg-maroon px-3">
                                        Drop out</span>';
                                        break;
                                    case '3':
                                        echo '<span class="rounded-pill badge badge-danger px-3">Failed</span>';
                                        break;
                                    case '4':
                                        echo '<span class="rounded-pill badge badge-default border px-3">Transferred-out</span>';
                                        break;
                                    case '5':
                                        echo '<span class="rounded-pill badge badge-default 
                                        bg-gradient-teal text-light px-3">Graduated</span>';
                                        break;
                                    default:
                                        echo '<span class="rounded-pill badge badge-default border px-3">
                                        N/A</span>';
                                        break;
                                    }
                                }
                            }else{
                                echo '<span class="rounded-pill badge badge-secondary px-3">No Grade</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <h5 class="text-center">Fourth Year - First Semester</h5>
            <table class="table table-stripped table-bordered" id="academic-history">
                <colgroup>
                    <col width="20%">
                    <col width="40%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-light">
                        <th class="py-1 text-center">Course Code</th>
                        <th class="py-1 text-center">Description</th>
                        <th class="py-1 text-center">Units</th>
                        <th class="py-1 text-center">Grade</th>
                        <th class="py-1 text-center">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $academics = $conn->query("SELECT * FROM `course_list`
                                            WHERE department_id='".$department_id."'
                                            AND year=4 AND semester=1");
                    while($row = $academics->fetch_assoc()):?>
                    <tr>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['name'] ?></span>
                        </td>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['description'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <span class=""><?= $row['units'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <?php
                                $grade = $conn->query("SELECT course_id,grade FROM `academic_history`
                                        WHERE student_id='".$_settings->userdata('academic_id')."'
                                        and course_id='".$row['id']."'");
                                $rows = $grade->fetch_assoc();
                                    if (isset($rows['course_id'])) {
                                        if ($rows['course_id'] == $row['id']) {
                                            echo '<b>'.$rows['grade'].'</b>';
                                        }else{
                                            echo ' ';
                                        }
                                    }else{
                                            echo ' ';
                                        }
                                        
                            ?>
                        </td>
                        <td class="px-2 py-1 text-center"><?php
                            $status = $conn->query("SELECT end_status FROM `academic_history`
                            WHERE student_id='".$_settings->userdata('academic_id')."'
                            and course_id='".$row['id']."'");
                            if (mysqli_num_rows($status) >= 1) {
                                while($rows = $status->fetch_assoc()){
                                    switch($rows['end_status']){
                                    case '0':
                                        echo '<span class="rounded-pill badge badge-secondary px-3">Pending</span>';
                                        break;
                                    case '1':
                                        echo '<span class="rounded-pill badge badge-success px-3">Completed</span>';
                                        break;
                                    case '2':
                                        echo '<span class="rounded-pill badge badgedefault bg-maroon px-3">
                                        Drop out</span>';
                                        break;
                                    case '3':
                                        echo '<span class="rounded-pill badge badge-danger px-3">Failed</span>';
                                        break;
                                    case '4':
                                        echo '<span class="rounded-pill badge badge-default border px-3">Transferred-out</span>';
                                        break;
                                    case '5':
                                        echo '<span class="rounded-pill badge badge-default 
                                        bg-gradient-teal text-light px-3">Graduated</span>';
                                        break;
                                    default:
                                        echo '<span class="rounded-pill badge badge-default border px-3">
                                        N/A</span>';
                                        break;
                                    }
                                }
                            }else{
                                echo '<span class="rounded-pill badge badge-secondary px-3">No Grade</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <h5 class="text-center">Fourth Year - Second Semester</h5>
            <table class="table table-stripped table-bordered" id="academic-history">
                <colgroup>
                    <col width="20%">
                    <col width="40%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-light">
                        <th class="py-1 text-center">Course Code</th>
                        <th class="py-1 text-center">Description</th>
                        <th class="py-1 text-center">Units</th>
                        <th class="py-1 text-center">Grade</th>
                        <th class="py-1 text-center">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $academics = $conn->query("SELECT * FROM `course_list`
                                            WHERE department_id='".$department_id."'
                                            AND year=4 AND semester=2");
                    while($row = $academics->fetch_assoc()):?>
                    <tr>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['name'] ?></span>
                        </td>
                        <td class="px-2 py-1 align-middle">
                            <span class=""><?= $row['description'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <span class=""><?= $row['units'] ?></span>
                        </td>
                        <td class="px-2 py-1 text-center">
                            <?php
                                $grade = $conn->query("SELECT course_id,grade FROM `academic_history`
                                        WHERE student_id='".$_settings->userdata('academic_id')."'
                                        and course_id='".$row['id']."'");
                                $rows = $grade->fetch_assoc();
                                    if (isset($rows['course_id'])) {
                                        if ($rows['course_id'] == $row['id']) {
                                            echo '<b>'.$rows['grade'].'</b>';
                                        }else{
                                            echo ' ';
                                        }
                                    }else{
                                            echo ' ';
                                        }
                                        
                            ?>
                        </td>
                        <td class="px-2 py-1 text-center"><?php
                            $status = $conn->query("SELECT end_status FROM `academic_history`
                            WHERE student_id='".$_settings->userdata('academic_id')."'
                            and course_id='".$row['id']."'");
                            if (mysqli_num_rows($status) >= 1) {
                                while($rows = $status->fetch_assoc()){
                                    switch($rows['end_status']){
                                    case '0':
                                        echo '<span class="rounded-pill badge badge-secondary px-3">Pending</span>';
                                        break;
                                    case '1':
                                        echo '<span class="rounded-pill badge badge-success px-3">Completed</span>';
                                        break;
                                    case '2':
                                        echo '<span class="rounded-pill badge badgedefault bg-maroon px-3">
                                        Drop out</span>';
                                        break;
                                    case '3':
                                        echo '<span class="rounded-pill badge badge-danger px-3">Failed</span>';
                                        break;
                                    case '4':
                                        echo '<span class="rounded-pill badge badge-default border px-3">Transferred-out</span>';
                                        break;
                                    case '5':
                                        echo '<span class="rounded-pill badge badge-default 
                                        bg-gradient-teal text-light px-3">Graduated</span>';
                                        break;
                                    default:
                                        echo '<span class="rounded-pill badge badge-default border px-3">
                                        N/A</span>';
                                        break;
                                    }
                                }
                            }else{
                                echo '<span class="rounded-pill badge badge-secondary px-3">No Grade</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <p class="text-center">
                <i>This online access is considered valid even without signature or dry seal.</i>
            </p>
        </fieldset>
            </div>
        </div>
    </div>
</div>
<noscript id="print-header">
    <div class="row">
        <div class="col-2 d-flex justify-content-center align-items-center">
            <img src="<?= validate_image($_settings->info('logo')) ?>" class="img-circle" id="sys_logo" alt="System Logo">
        </div>
        <div class="col-8">
            <p class="text-center">
                Republic of the Philippines<br>
                APAYAO STAYE COLLEGE<br>
                <small>San Isidro Sur, Luna, Apayao</small>
            </p>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row text-center">
        <div class="col-12">
            <h5>Bachelor of Science in Information Technology</h5><br>
        </div>
    </div>
</noscript>
<script>
    $(function() {
        $('#print').click(function(){
            start_loader()
            $('#academic-history').dataTable().fnDestroy()
            var _h = $('head').clone()
            var _p = $('#outprint').clone()
            var _ph = $($('noscript#print-header').html()).clone()
            var _el = $('<div>')
            _p.find('tr.bg-gradient-dark').removeClass('bg-gradient-dark')
            _p.find('tr>td:last-child,tr>th:last-child,colgroup>col:last-child').remove()
            _p.find('.badge').css({'border':'unset'})
            _el.append(_h)
            _el.append(_ph)
            _el.find('title').text('Student Records - Print View')
            _el.append(_p)


            var nw = window.open('','_blank','width=1000,height=900,top=50,left=200')
                nw.document.write(_el.html())
                nw.document.close()
                setTimeout(() => {
                    nw.print()
                    setTimeout(() => {
                        nw.close()
                        end_loader()
                    }, 300);
                }, (750));
                
            
        })
    })
</script>
<?php }?>
