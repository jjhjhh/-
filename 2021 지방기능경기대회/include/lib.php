<?php  
	$GLOBALS['db']=mysqli_connect("localhost","root","","2021-3");
	mysqli_query($db,"set names utf8");
	session_start();

	function sql($q){ return mysqli_query($GLOBALS['db'],$q);}
	function fetch($q){ return mysqli_fetch_array($q);}
	function rows($q){return mysqli_num_rows($q);}
	function alert($q){ echo "<script>alert('{$q}')</script>";}
	function console($q){ echo "<script>console.log('{$q}')</script>";}
	function mov($q){ echo "<script>location.replace('{$q}')</script>";}
?>