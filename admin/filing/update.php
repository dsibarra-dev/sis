<?php

$query = "
UPDATE academic_history 
SET ".$_POST["name"]." = '".$_POST["value"]."' 
WHERE id = '".$_POST["pk"]."'
";

$conn->query($query);

?>