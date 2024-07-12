<?php  
	include("include/lib.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style2.css">
	<link rel="stylesheet" href="js/bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="js/jQueryUI/jquery-ui-1.12.1/jquery-ui.min.css">

	<script src="js/jQuery/jquery-2.2.4.min.js"></script>
	<script src="js/jQueryUI/jquery-ui-1.12.1/jquery-ui.min.js"></script>
	<script src="js/bootstrap/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>

	<title>Document</title>
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href="/"><img src="img/logo.png" alt="img" title="img"></a></li>
				<li><a href="#">무형문화재관리원</a>
					<ul class="sub">
						<li><a href="#">소개</a></li>
						<li><a href="#">일반현황+</a></li>

						<li><a href="#" class="mini">설립목적</a></li>
						<li><a href="history.html" class="mini">연혁</a></li>
						<li><a href="#" class="mini">역할</a></li>

						<li><a href="#">주요업무계획</a></li>
						<li><a href="#">조직 및 구성</a></li>
						<li><a href="phone.html">전화번호</a></li>
					</ul>
				</li>

				<li><a href="list.html">무형문화재 현황</a>
					<ul class="sub">
						<li><a href="#">무형문화재 현황</a></li>
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
						<li><a href="#">공연+</a></li>

						<li><a href="#" class="mini">월간 공연 일정</a></li>
						<li><a href="#" class="mini">년간 공연 일정</a></li>

						<li><a href="#">전시+</a></li>

						<li><a href="#" class="mini">관람 안내</a></li>
						<li><a href="#" class="mini">전시실</a></li>
						<li><a href="#" class="mini">디지털 체험관</a></li>
						<li><a href="#" class="mini">기획 전시실</a></li>

						<li><a href="#">교육+</a></li>

						<li><a href="#" class="mini">전문 교육</a></li>
						<li><a href="#" class="mini">사회 교육</a></li>
						<li><a href="#" class="mini">연간 교육일정</a></li>
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
					<select name="" id="">
						<option value="">한국어</option>
						<option value="">English</option>
						<option value="">中文(简体)</option>
						<option value="">日本語</option>
					</select><br>
					<a href="#">회원가입</a>
					<a href="#">로그인</a>
				</li>
			</ul>
		</nav>
	</header>

	<div class="s-visual back">
		<h2>연혁</h2>
	</div>
	<div class="space"></div>

	<div class="view wrap line">
		<h2 class="title">연혁</h2>
		<p>HOME > 무형문화재관리원 > 일반현황 > 연혁 </p>
	</div><br>
	<div class="wrap"><a href="#" id="add">글 등록하기</a></div>

	<form action="openAPI/showList.php" class="wrap">
		<select id="type">
			<option value="y">년도별</option>
			<option value="m">월별</option>
		</select>

		<input type="text" id="year" placeholder="년도">
		<input type="text" id="month" placeholder="월">

		<input type="button" value="데이터 전송" id="go-data">

		<div class="data-wrap"></div>
	</form>

	<script>
		$(function(){
			view_mode();
			$("#go-data").click(function(){
				type=$("#type").val();
				year=$("#year").val();
				month=$("#month").val();

				if(type=="y"){
					data={
						'searchType':'Y',
						'year':year
					};
				}else{
					data={
						'searchType':'M',
						'year':year,
						'month':month
					}
				}

				$.ajax({
					url:'openAPI/showList.php',
					data:data,
					success:function(data){
						$(".data-wrap").html(data);
					}
				})
			})
			$("#type").change(function(){
				view_mode();
			})
		})

		function view_mode(){
			type=$("#type").val();

			if(type=="y") $("#month").hide();
			else $("#month").show();
		}
	</script>
</body>
</html>