<?php

$column = array("student_id", "fullname", "status", "grade", "year", "semester", "school_year");

$query = "SELECT a.*, concat(b.lastname,', ',b.firstname,' ',b.middlename) as fullname FROM academic_history as a INNER JOIN student_list as b ON a.student_id=b.id";

if(isset($_POST["search"]["value"]))
{
	$query .= '
	WHERE b.firstname LIKE "%'.$_POST["search"]["value"].'%" 
	OR b.last_name LIKE "%'.$_POST["search"]["value"].'%"
	OR a.student_id LIKE "%'.$_POST["search"]["value"].'%"
	';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY a.student_id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
	$query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$result = $connect->query($query . $query1);

$data = array();

foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = $row['student_id'];
	$sub_array[] = $row['fullname'];
	$sub_array[] = $row['status'];
	$sub_array[] = $row['grade'];
	$sub_array[] = $row['year'];
	$sub_array[] = $row['semester'];
	$sub_array[] = $row['school_year'];
	$data[] = $sub_array;
}

function count_all_data($connect)
{
	$query = "SELECT * FROM academic_history";

	$statement = $conn->prepare($query);

	$statement->execute();

	return $statement->rowCount();
}

$output = array(
	'draw'		=>	intval($_POST['draw']),
	'recordsTotal'	=>	count_all_data($connect),
	'recordsFiltered'	=>	$number_filter_row,
	'data'		=>	$data
);

echo json_encode($output);

?>