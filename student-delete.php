<?php
require 'student_db.php';
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
if($id) {
	
	$table='tb_sinhvien';
	$where="sv_id=$id";
	student_db::remove($table,$where);
}
header("location: student-list.php");
?>