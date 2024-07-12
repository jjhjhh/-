<?php  
	include("../include/lib.php");
	$showUid=$_GET['showUid'];
	$re=sql("select * from cal where showUid='$showUid' ");
	$data=fetch($re);

	if(isset($_POST['showName'])){
		extract($_POST);

		sql(" update cal set `showUid` = NULL, `showName` = '$showName', `showDate` = '$showDate ', `showTime` = '$showTime', `organizer` = '$organizer', `place` = '$place', `cast` = '$cast', `rm` = '$rm', `updtDt` = NOW() WHERE `cal`.`showUid` ='$showUid' ");


		alert("공연 일정 수정 완료");
		mov("/cal.php");
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
		<h2>공연일정 수정</h2>
	</div>

	<div class="space"></div>

	<div class="wrap2 line s-title view">
		<h2 class="title">공연일정 수정</h2>
		<p>HOME > 행사안내 > 공연 > 공연일정수정</p>
	</div><br>

	<form action="" enctype="multipart/form-data" class="wrap2" method="post">
		공연명 <input type="text" name="showName" required="" placeholder="필수" value="<?php echo $data['showName']; ?>"><br>
		공연일 <input type="date" name="showDate" required="" placeholder="필수" value="<?php echo $data['showDate']; ?>"><br>
		공연시간 <input type="text" name="showTime" required="" placeholder="필수(00:00형식)" value="<?php echo $data['showTime']; ?>"><br>
		주관 <input type="text" name="organizer" value="<?php echo $data['organizer']; ?>"><br>
		공연장소 <input type="text" name="place" value="<?php echo $data['place']; ?>"><br>
		출연진 <input type="text" name="cast" value="<?php echo $data['cast']; ?>"><br>
		공연내용 <input type="text" name="rm" value="<?php echo $data['rm']; ?>"><br>
		<input type="submit" value="일정 수정">
		<a href="cal_del.php?showUid=<?php echo $showUid; ?> ">삭제</a>
	</form>

	<div class="space"></div>
</body>
</html>