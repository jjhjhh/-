<?php  
	include("lib.php");

	if(isset($_POST['j_id']))
	{
		// if($_SESSION['capcha']!=$_POST['capcha'])
		// {
		// 	alert("자동입력방지 문자를 잘못 입력하였습니다.");
		// 	back();
		// }
		extract($_POST);

		$re=sql("select * from member where id='$j_id' ");
		$num=rows($re);

		if($num!=0)
		{
			alert("중복되는 아이디입니다. 다른 아이디를 사 용해주세요.");
			back();
		}else{

			$file_name=$_FILES['img']['name'];
			move_uploaded_file($_FILES['img']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."../data/".$file_name);
			sql("INSERT INTO `member` (`idx`, `id`, `pw`, `name`, `img`, `lv`) VALUES (NULL, '$j_id', PASSWORD('$pw'), '$name', '$file_name', '1')");
			alert("회원가입이 완료되었습니다");
			// mov("/");
		}
	}


	if(isset($_POST['id']))
	{
		extract($_POST);

		$re=sql("select * from member where id='$id' and pw=PASSWORD('$pw') ");
		$num=rows($re);
		if($num==0)
		{
			alert("아이디 또는 비밀번호가 일치하지 않습니다");
			back();
		}else{
			$re=sql("select * from member where id='$id' ");
			$data=fetch($re);
			$_SESSION['id']=$data['id'];
			$_SESSION['name']=$data['name'];
			$_SESSION['lv']=$data['lv'];

			// alert($_SESSION['name']);
			alert("로그인 완료");
			mov("/");
		}
	}

	if(isset($_GET['logout']))
	{
		session_unset();
		session_destroy();
		mov("/");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, inital-scale=1">
	<link rel="stylesheet" href="/resources/style.css">
	<link rel="stylesheet" href="/resources/style.css">
	<link rel="stylesheet" href="/resources/bootstrap-4.3.1-dist/bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/resources/jquery-ui-1.12.1.custom/jquery-ui-1.12.1.custom/jquery-ui.min.css">

	<script src="/resources/jquery-3.4.1.min.js"></script>
	<script src="/resources/jquery-ui-1.12.1.custom/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script> <!-- 제이쿼리먼저 -->
	<script src="/resources/bootstrap-4.3.1-dist/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</head>
<body>
	<header class="full-width">
		<div class="line wrap3">
			<img src="../Design/logo.jpg" alt="d">
			<div>
				<ul>
					<?php  
						if(!isset($_SESSION['lv']))
						{
							echo "<li><button id='login'>로그인</button></li>";
							echo "<li><button id='join'>회원가입</button></li>";
						}else{
							echo "<li><a>{$_SESSION['name']}({$_SESSION['id']})</a></li>";
							echo "<li><a href='?logout'>로그아웃</a></li>";
						}
					?>				
				</ul>
			</div>
		</div>
		<button id="ham"><ul><li>-</li><li>-</li><li>-</li></ul></button>
		<nav>
			<ul class="wrap3">
				<li><a href="/">홈</a></li>
				<li><a href="/page/online.php">온라인 집들이</a></li>
				<li><a href="/page/store.php">스토어</a></li>
				<li><a href="/page/special.php">전문가</a></li>
				<li><a href="/page/contact.php">시공 견적</a></li>
			</ul>
		</nav>
	</header>

	<div class="modal fade" id="join_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<form action="" method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>아이디</td>
								<td><input type="text" name="j_id"></td>
							</tr>
							<tr>
								<td>비밀번호</td>
								<td><input type="password" name="pw"></td>
							</tr>
							<tr>
								<td>이름</td>
								<td><input type="text" name="name"></td>
							</tr>
							<tr>
								<td>사진</td>
								<td><input type="file" name="img"></td>
							</tr>
							<tr>
								<td><img src="/include/capcha.php" alt="자동방지입력문자"></td>
								<td><input type="text" name="capcha"></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" value="회원가입"></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			$("#join").click(function(){
				$("#join_modal").modal('show');
			})
		})
	</script>

	<div class="modal fade" id="login_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<form action="" method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>아이디</td>
								<td><input type="text" name="id"></td>
							</tr>
							<tr>
								<td>비밀번호</td>
								<td><input type="password" name="pw"></td>
							</tr>
								<td></td>
								<td><input type="submit" value="로그인"></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			$("#login").click(function(){
				$("#login_modal").modal('show');
			})
		})
	</script>