<?php  
	include("../include/lib.php");
	$showUid=$_GET['showUid'];
	sql(" delete from cal where showUid='$showUid' ");
	alert("일정 삭제 완료");
	mov("/cal.php");

?>