<?php  
	include("include/lib.php");

	if(!isset($_SESSION['view_mode'])) $_SESSION['view_mode']="album";

	if($_POST['view_mode']){
		if($_POST['view_mode']=="앨범") $_SESSION['view_mode']="album";
		else $_SESSION['view_mode']="list";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<Host><Context path="/filepath" reloadable="true" docBase="C:\\fileupload"/></Host>
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
<body class="tmp">
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
		<h2>무형문화재현황</h2>
	</div>

	<div class="space"></div>

	<div class="wrap line s-title view">
		<h2 class="title">무형문화재현황</h2>
		<p>HOME > 무형문화재현황 > 전체</p>
	</div>
	<div class="space"></div>

	<div class="wrap ">
		<h3 class="pa">총 154건 <span>1</span>p/16p</h3>
	</div><br>

	<div class="line wrap">
		<div class="option">
			<form action="" enctype="multipart/form-data" method="post">
				<input type="submit" value="목록" name="view_mode">
				<input type="submit" value="앨범" name="view_mode">
			</form>
			
		</div>
		<a href="page/add.php" id="add">글쓰기</a>
	</div>
	<br>
<?php  
	if($_SESSION['view_mode']=="album"){
?>
	<div class="album-wrap wrap">
		<div class="album-list flex">
			<?php
				$page=isset($_GET['page'])?$_GET['page']:1;
				$re=sql("select * from detail");
				$total=rows($re);
				$list=8;
				$total_page=ceil($total/$list);
				$start=($page-1)*$list;
				$cnt=$total-$start;

				$prev=$page==1?1:$page-1;
				$next=$page==$total_page?$total_page:$page+1;

				$re=sql("select * from detail order by sn desc limit {$start},{$list} ");
				while($data=fetch($re)){
					echo "<div class='album'>";
					echo "<div><a href='page/mod.php?sn={$data['sn']}'><img src='C:/xampp/nihcImage/{$data['image']}'></a></div>";
					echo "<h2>{$data['ccbaMnm1']}</h2>";
					echo "</div>";
				}

			?>
		</div><br>

		<div class="page">
			<a href="?page=1">&lt&lt</a>
			<a href="?page=<?php echo $prev; ?>">&lt</a>
			<?php  
				for($i=1;$i<=$total_page;$i++)
					echo "<a href=?page={$i}>{$i}</a>";
			?>
			<a href="?page=<?php echo $next; ?>">&gt</a>
			<a href="?page=<?php echo $total_page; ?>">&gt&gt</a>
		</div>
	</div>
<?php }else{ ?>
	<div class="list-wrap wrap">
		<table>
			<thead>
				<tr>
					<td>순번</td>
					<td>문화재명</td>
					<td>믄화재종목</td>
					<td>지정호수</td>
					<td>소재지</td>
				</tr>
			</thead>
			<tbody>
				<?php
					$page2=isset($_GET['page2'])?$_GET['page2']:1;
					$re=sql("select * from detail");
					$total=rows($re);
					$list=10;
					$total_page=ceil($total/$list);
					$start=($page2-1)*$list;
					$cnt=$total-$start;

					$prev=$page2==1?1:$page2-1;
					$next=$page2==$total_page?$total_page:$page2+1;

					$re=sql("select * from detail order by sn desc limit {$start},{$list} ");
					while($data=fetch($re)){
						echo "<tr>";
						echo "<td><a href='page/mod.php?sn={$data['sn']}'>{$data['ccbaMnm1']}</a><td>";
						echo "<td>{$data['gcodeName']}</td>";
						echo "<td>{$data['crltsnoNm']}</td>";
						echo "<td>{$data['ccbaAdmin']}</td>";
						echo "</tr>";
					}

			?>
			</tbody>
		</table>
		<div class="space"></div>
		<div class="page">
			<a href="?page2=1">&lt&lt</a>
			<a href="?page2=<?php echo $prev; ?>">&lt</a>
			<?php  
				for($i=1;$i<=$total_page;$i++)
					echo "<a href=?page2={$i}>{$i}</a>";
			?>
			<a href="?page2=<?php echo $next; ?>">&gt</a>
			<a href="?page2=<?php echo $total_page; ?>">&gt&gt</a>
		</div>
	</div>
<?php } ?>
	<div class="space"></div>
	<footer>
		<div class="wrap line">
			<p>이용안내</p>
			<p>개인정보 처리방침</p>
			<p>저작권 보호정책</p>
			<p>도로명 주소안내</p>
			<p>사이트오류 신고</p>
		</div>
		<div class="flex">
			<img src="" alt="logo">
		<p>인천시 부평구 무네미로 448번길 77 한국산업인력공단 글로벌숙련기술진흥원<br>
COPYRIGHTⓒ 2016 HRDKOREA</p>
</div>
	</footer>
</body>
</html>