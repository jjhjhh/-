<?php  
	include("../include/lib.php");
	$sn=$_GET['sn'];
	$re=sql("select * from detail where sn='$sn' ");
	$data=fetch($re);

	chmod("del.php",777);
	unlink('../../nihcImage/'.$data['image']);

	sql(" delete from detail where sn='$sn' ");
	alert("삭제 완료");
	mov("/list.php");

?>