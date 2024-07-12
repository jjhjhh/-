<?php  
	include("../include/lib.php");
	$arr=[];

	$start=$_GET['pageNo']*$_GET['numOfRows']-$_GET['numOfRows'];
	$end=$_GET['pageNo']*$_GET['numOfRows'];

	$re=sql("select * from detail limit {$start},{$end}");

	$cnt=rows($re);

	while($data=fetch($re)){
		$arr2[]=[
			"ccbaKdcd"=>urlencode($data['ccbaKdcd']),
			"ccbaAsno"=>urlencode($data['ccbaAsno']),
			"ccbaCtcd"=>urlencode($data['ccbaCtcd']),
			"ccbaCpno"=>urlencode($data['ccbaCpno']),
			"ccmaName"=>urlencode($data['ccmaName']),
			"ccbaMnm1"=>urlencode($data['ccbaMnm1']),
			"ccbaMnm2"=>urlencode($data['ccbaMnm2']),
			"gcodeName"=>urlencode($data['gcodeName']),
			"bcodeName"=>urlencode($data['bcodeName']),
			"mcodeName"=>urlencode($data['mcodeName']),
			"scodeName"=>urlencode($data['scodeName']),
			"ccbaQuan"=>urlencode($data['ccbaQuan']),
			"ccbaCtcdNm"=>urlencode($data['ccbaCtcdNm']),
			"ccsiName"=>urlencode($data['ccsiName']),
			"ccbaLcad"=>urlencode($data['ccbaLcad']),
			"ccceName"=>urlencode($data['ccceName']),
			"ccbaPoss"=>urlencode($data['ccbaPoss']),
			"ccbaAdmin"=>urlencode($data['ccbaAdmin']),
			"ccbaCndt"=>urlencode($data['ccbaCndt']),
			"image"=>urlencode("../nihcImage/",$data['image']),
			"content"=>urlencode($data['content'])
		];
		array_push($arr,$arr2);
	}

	$jsonarr=[
		"numOfRows"=>$_GET['numOfRows'],
		"pageNo"=>$_GET['pageNo'],
		"totalCount"=>$cnt,
		"items"=>$arr
	];

	$json= urldecode(json_encode($jsonarr));
	echo $json;
?>