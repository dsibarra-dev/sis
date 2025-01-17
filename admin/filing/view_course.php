<?php
require_once('../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT a.*,b.* FROM `academic_history` as a
    INNER JOIN `course_list` as b ON a.course_id=b.id where a.course_id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }else{
        echo "<center><small class='text-muted'>Unkown Academic ID.</small</center>";
        exit;
    }
}
?>
<style>
    img#cimg{
        height: 17vh;
        width: 25vw;
        object-fit: scale-down;
    }
</style>
<div class="card card-outline card-primary rounded-0 shadow">
    <div class="card-header">
        <h3 class="card-title">Students Enrolled in <?=$res['name']?> (<?=$res['description']?>)</h3>
<!--        <div class="card-tools">
            <a href="./?page=students/manage_student" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Add New Student</a>
        </div> -->
    </div>
    <div class="card-body">
        <div class="container-fluid">
        <div class="container-fluid">
            <table class="table table-bordered table-hover table-striped">
                <colgroup>
                    <col width="2%">
                    <col width="5%">
                    <col width="15%">
                    <col width="10%">
                    <col width="2%">
                    <col width="5%">
                    <col width="5%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-dark text-light">
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Yr/Semester/Sc.Yr.</th>
                        <th>Grade</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        $qry = $conn->query("SELECT a.*,b.roll as stud_id, CONCAT(b.lastname,', ',
                            b.firstname,' ',b.middlename) as fullname FROM `academic_history` as a INNER JOIN `student_list` as b ON a.student_id=b.id
                            where a.course_id = '{$_GET['id']}'");
                        while($row = $qry->fetch_assoc()):
                            $qryCount = $conn->query("SELECT COUNT(id) as count 
                                                    FROM `academic_history`
                                                    WHERE course_id='".$row['id']."'");
                            $count = $qryCount->fetch_assoc();
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class=""><p class="m-0 truncate-1"><?=$row['stud_id'] ?></p></td>
                            <td class=""><p class="m-0 truncate-1"><?=$row['fullname'] ?></p></td>
                            <td class="text-center"><p class="m-0 truncate-1">
                                <?=$row['year'] ?>/<?=$row['semester'] ?>/S.Y. <?=$row['school_year'] ?></p></td>
                            <td class="text-center"><p class="m-0 truncate-1"><?=$row['grade'] ?></p></td>
                            <td class="text-center"><p class="m-0 truncate-1">
                                <?php 
                                if ($row['status']=='1') {
                                    echo "New";
                                }elseif ($row['status']=='2') {
                                    echo "Regular";
                                }elseif ($row['status']=='3') {
                                    echo "Returnee";
                                }elseif ($row['status']=='4') {
                                    echo "Transferee";
                                }else {
                                    echo "N/A";
                                }?>
                                </p>
                            </td>
                            <td class="px-2 py-1 align-middle text-center">
                                <a class="btn  btn-sm edit_academic" href="javascript:void(0)" data-id ="<?=$row['id'] ?>"><span class="fa fa-edit text-primary"></span> 
                                Academic</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.table td, .table th').addClass('py-1 px-2 align-middle')
        $('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
    })
    $(function(){
        $('.edit_academic').click(function(){
            uni_modal("Manage Academic Record<b><?= isset($roll) ? $roll.' - '.$fullname : "" ?></b>","filing/manage_grade.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('#uni_modal').on('shown.bs.modal',function(){
            $('#amount').focus();
            $('#course_id').select2({
                placeholder:'Please Select Here',
                width:"100%",
                dropdownParent:$('#uni_modal')
            })
        })
        $('#uni_modal #academic-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            if(_this[0].checkValidity() == false){
                _this[0].reportValidity();
                return false;
            }
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_academic",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured",'error');
                    end_loader();
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload();
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>