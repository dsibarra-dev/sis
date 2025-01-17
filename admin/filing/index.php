<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline card-primary rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title">List of Subjects</h3>
<!-- 		<div class="card-tools">
			<a href="./?page=students/manage_student" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Add New Student</a>
		</div> -->
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="10%">
					<col width="45%">
					<col width="5%">
					<col width="5%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-dark text-light">
						<th>#</th>
						<th>Department</th>
						<th>Course Code</th>
						<th>Course Description</th>
						<th>Year</th>
						<th>Semester</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT a.*,a.id as `course_id`,b.name as `dept_name`
						 					from `course_list` as a 
						INNER JOIN `department_list` as b  ON a.department_id=b.id
						order by a.department_id AND a.year AND a.semester asc ");
						while($row = $qry->fetch_assoc()):
							$qryCount = $conn->query("SELECT COUNT(id) as count 
													FROM `academic_history`
													WHERE course_id='".$row['id']."'");
							$count = $qryCount->fetch_assoc();
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><p class="m-0 truncate-1"><?=$row['dept_name'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['name'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['description'] ?></p></td>
							<td class="text-center"><p class="m-0 truncate-1"><?php echo $row['year'] ?></p></td>
							<td class="text-center"><p class="m-0 truncate-1"><?php echo $row['semester'] ?></p></td>
                            <td class="px-2 py-1 align-middle text-center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                	<?php if(!$count['count']<1){?>
                                    <a href="./?page=filing/view_course&id=<?= $row['id'] ?>"
                                    	class="btn btn-flat btn-md btn-muted">
                                    	<span class="fa fa-eye text-success"></span> View</a>
                                    <div class="dropdown-divider"></div>
                                	<?php }?>
                                    <a class="dropdown-item add_student" href="javascript:void(0)" 
                                    data-id="<?=$row['id'] ?>"><span class="fa fa-plus text-primary"></span> Add Student</a>
                                </div>
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
                { orderable: true, targets: 1000 }
            ],
        });
	})
	$(function(){
        $('.add_student').click(function(){
            uni_modal("Add Student","filing/add_student.php?id="+$(this).attr('data-id'),'mid-large')
        })
    })
</script>	