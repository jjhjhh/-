<?php  
	$GLOBALS['db']=mysqli_connect("localhost","root","","0606");
	mysqli_query($GLOBALS['db'],"set names utf8");
	session_start();

	function sql($q){return mysqli_query($GLOBALS['db'],$q);}
	function fetch($q){return mysqli_fetch_array($q);}
	function rows($q){return mysqli_num_rows($q);}
	function alert($q){echo "<script>alert('{$q}')</script>";}
	function mov($q){echo "<script>location.replace('{$q}')</script>";exit();}
	function back(){echo "<script>history.back()</script>";exit();}
	function member_check(){
		if(!isset($_SESSION['lv']))
		{
			alert("로그인해 주세요.");
			back();
		}
	}
?>