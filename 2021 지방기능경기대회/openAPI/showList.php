<?php  
	include("../include/lib.php");
	$arr=[];

	if($_GET['searchType']=="Y"){
		$re=sql("select * from cal where showDate>='$_GET[year]-01-01' and showDate<='$_GET[year]-12-31' order by showDate asc");
	}else{
		if($_GET['month']<10) $month="0".$_GET['month'];
		else $month=$_GET['month'];

		$re=sql("select * from cal where showDate>='$_GET[year]-$month-01' and showDate<='$_GET[year]-$month-31' order by showDate asc");
	}

	

	$cnt=rows($re);

	while($data=fetch($re)){
		$arr2[]=[
			"showUid"=>(int)$data['showUid'],
			"showName"=>urlencode($data['showName']),
			"showDt"=>urlencode($data['showDate']." ".$data['showTime']),
			"organizer"=>urlencode($data['organizer']),
			"place"=>urlencode($data['place']),
			"cast"=>urlencode($data['cast']),
			"rm"=>urlencode($data['rm'])
	
		];
		array_push($arr,$arr2);
	}

	if($_GET['searchType']=="Y"){
		$jsonarr=[
			"showType"=>"Y",
			"year"=>$_GET['year'],
			"totalCount"=>$cnt,
			"items"=>$arr
		];
		$json= urldecode(json_encode($jsonarr));

	}else{
		$jsonarr=[
			"showType"=>"Y",
			"year"=>$_GET['year'],
			"month"=>$_GET['month'],
			"totalCount"=>$cnt,
			"items"=>$arr
		];
		$json= urldecode(json_encode($jsonarr,JSON_UNESCAPED_UNICODE));
	}

	echo $json;
?>