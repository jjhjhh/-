<?php  
	include("../include/lib.php");
	$sn=$_GET['sn'];
	$re=sql("select * from detail where sn='$sn' ");
	$data=fetch($re);

	if(isset($_POST['gcodeName'])){
		extract($_POST);

		if(!$_FILES['image']['name']){
			$image=$ori_img;
		}else{
			$image=$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."../../nihcImage/".$image);
		}

		sql(" update detail set `sn` = NULL, `ccbaKdcd` = '$ccbaKdcd', `ccbaAsno` = '$ccbaAsno', `ccbaCpno` = '$ccbaCpno', `longitude` = '$longitude', `latitude` = '$latitude', `ccmaName` = '$ccmaName', `crltsnoNm` = '$crltsnoNm', `ccbaMnm1` = '$ccbaMnm1', `ccbaMnm2` = '$ccbaMnm2', `gcodeName` = '$gcodeName', `bcodeName` = '$bcodeName', `mcodeName` = '$mcodeName', `scodeName` = '$scodeName', `ccbaQuan` = '$ccbaQuan', `ccbaAsdt` = '$ccbaAsdt', `ccbaCtcdNm` = '$ccbaCtcdNm', `ccsiName` = '$ccsiName', `ccbaLcad` = '$ccbaLcad', `ccceName` = '$ccceName ', `ccbaAdmin` = '$ccbaAdmin', `ccbaCncl` = '$ccbaCncl', `ccbaCndt` = '$ccbaCndt', `image` = '$image', `content` = '$content' WHERE `detail`.`sn` ='$sn' ");

		alert("문화재 수정 완료");
		// mov("/list.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style2.css">
	<title>Document</title>
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href="#">logo</a></li>
				<li><a href="#">무형문화재관리원</a>
					<ul class="sub">
						<li><a href="#">소개</a></li>
						<li><a href="#">일반현황</a></li>

						<li><a href="#">설립목적</a></li>
						<li><a href="#">연혁</a></li>
						<li><a href="#">역할</a></li>

						<li><a href="#">주요업무계획</a></li>
						<li><a href="#">조직 및 구성</a></li>
						<li><a href="#">전화번호</a></li>
					
					</ul>

				</li>
				<li><a href="#">무형문화재 현황</a>
					<ul class="sub">
						<li><a href="#">전통 공연·예술</a></li>
						<li><a href="#">전통기술</a></li>
						<li><a href="#">전통지식</a></li>
						<li><a href="#">구전 전통 및 표현</a></li>
						<li><a href="#">전통 생활관습</a></li>
						<li><a href="#">의례·의식</a></li>
						<li><a href="#">전통 놀이·무예</a></li>
						<li><a href="#">전체 현황</a></li>
					
					</ul>

				</li>

				<li><a href="#">행사 안내</a>
					<ul class="sub">
						<li><a href="#">공연</a></li>

						<li><a href="#">월간 공연 일정</a></li>
						<li><a href="#">년간 공연 일정</a></li>

						<li><a href="#">전시</a></li>

						<li><a href="#">관람 안내</a></li>
						<li><a href="#">전시실</a></li>
						<li><a href="#">디지털 체험관</a></li>
						<li><a href="#">기획 전시실</a></li>

						<li><a href="#">교육</a></li>

						<li><a href="#">전문 교육</a></li>
						<li><a href="#">사회 교육</a></li>
						<li><a href="#">연간 교육일정</a></li>
					
					</ul>

				</li>

				<li><a href="#">전승지원</a>
					<ul class="sub">
						<li><a href="#">공방</a></li>
						<li><a href="#">공예품 갤러리</a></li>
						<li><a href="#">전수교육관 현황</a></li>
					
					</ul>

				</li>
				<li><a href="#">데이터 공개</a>
					<ul class="sub">
						<li><a href="#">무형문화재 현황</a></li>
						<li><a href="#">월간/년간 공연현황</a></li>
						<li><a href="#">공방/공예품/전수교육관 사진 자료</a></li>
					
					</ul>

				</li>
				<li><a href="#">문의하기</a></li>
				<li class="mem">
					<div class="lang line"><p>한국어</p><p>English</p><p>中文(简体)</p><p>日本語</p></div>
					<a href="#">로그인</a>
					<a href="#">회원가입</a>
				</li>
			</ul>
		</nav>
	</header>

	<div class="s-visual">
		<h2>무형문화재 등록</h2>
	</div>

	<div class="space"></div>

	<div class="wrap2 line s-title view">
		<h2 class="title">무형문화재현황 등록</h2>
		<p>HOME > 무형문화재현황 > 전체</p>
	</div><br>

	<form action="" enctype="multipart/form-data" class="wrap2" method="post">
		종목코드 <input type="text" name="ccbaKdcd" required="" placeholder="필수" value="<?php echo $data['ccbaKdcd']; ?>"><br>
		지정번호 <input type="text" name="ccbaAsno" required="" placeholder="필수" value="<?php echo $data['ccbaAsno']; ?>"><br>
		시도코드 <input type="text" name="ccbaCtcd" required="" placeholder="필수" value="<?php echo $data['ccbaCtcd']; ?>"><br>
		연계번호 <input type="text" name="ccbaCpno" value="<?php echo $data['ccbaCpno']; ?>"><br>
		경도 <input type="text" name="longitude" value="<?php echo $data['longitude']; ?>"><br>
		위도 <input type="text" name="ccmaName" value="<?php echo $data['ccmaName']; ?>"><br>
		공연내용 <input type="text" name="crltsnoNm" value="<?php echo $data['crltsnoNm']; ?>"><br>
		문화재종목 <input type="text" name="ccbaMnm1" required="" placeholder="필수" value="<?php echo $data['ccbaMnm1']; ?>"><br>


		지정호수 <input type="text" name="ccbaMnm2"required="" placeholder="필수" value="<?php echo $data['ccbaMnm2']; ?>"><br>
		문화재명(국문) <input type="text" name="gcodeName"required="" placeholder="필수" value="<?php echo $data['gcodeName']; ?>"><br>
		문화재명(한자 <input type="text" name="bcodeName" value="<?php echo $data['bcodeName']; ?>"><br>
		latitude(한자 <input type="text" name="latitude" value="<?php echo $data['latitude']; ?>"><br>
		문화재분류 <input type="text" name="mcodeName" value="<?php echo $data['mcodeName']; ?>"><br>
		문화재분류2(종류) <input type="text" name="scodeName" value="<?php echo $data['scodeName']; ?>"><br>
		문화재분류3 <input type="text" name="ccbaQuan" value="<?php echo $data['ccbaQuan']; ?>"><br>
		문화재분류4 <input type="text" name="ccbaAsdt" value="<?php echo $data['ccbaAsdt']; ?>"><br>
		수량 <input type="text" name="ccbaCtcdNm" value="<?php echo $data['ccbaCtcdNm']; ?>"><br>
		지정(등록일) <input type="text" name="ccsiName" placeholder="ex)1967616" value="<?php echo $data['ccsiName']; ?>"><br>
		시도명 <input type="text" name="ccbaLcad" value="<?php echo $data['ccbaLcad']; ?>"><br>
		시대 <input type="text" name="ccceName" value="<?php echo $data['ccceName']; ?>"><br>
		ccbaCncl <input type="text" name="ccbaCncl" value="<?php echo $data['ccbaCncl']; ?>"><br>
		소유자 <input type="text" name="ccbaPoss" value="<?php echo $data['ccbaPoss']; ?>"><br>
		관리자 <input type="text" name="ccbaAdmin" value="<?php echo $data['ccbaAdmin']; ?>"><br>
		지정해제일 <input type="text" name="ccbaCndt" value="<?php echo $data['ccbaCndt']; ?>"><br>
		이미지 <input type="file" name="image"><br>
		<input type="hidden" name="ori_img" value="<?php echo $data['image']; ?>">
		설명 <input type="text" name="content" value="<?php echo $data['content']; ?>"><br>

		<a href="del.php?sn=<?php echo $sn; ?>">삭제</a>
		<input type="submit" value="문화재 수정">
	</form>

	<div class="space"></div>
</body>
</html>