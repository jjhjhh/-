<?php  
	include("../include/header.php");
	member_check();

	if(isset($_POST['con']))
	{
		$before_img=date("U").$_FILES['before']['name'];
			move_uploaded_file($_FILES['before']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/data/".$before_img);
		$after_img=date("U").$_FILES['after']['name'];
			move_uploaded_file($_FILES['after']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/data/".$after_img);//사진저장

		extract($_POST);

		$re=sql("select * from member where id='$_SESSION[id]' ");
		$data=fetch($re);
		$no=$data['idx'];//ㅎ..;

		sql("INSERT INTO `online` (`idx`, `before_img`, `after_img`, `name`, `writer_idx`, `id`, `con`, `date`) VALUES (NULL, '$before_img', '$after_img', '$_SESSION[name]', '$no', '$_SESSION[id]', '$_POST[con]', NOW())");
		alert("글 등록이 완료되었습니다");
		mov("online.php");
	}

	if(isset($_POST['score']))
	{
		sql("insert into score(user_id,online_idx,score)values('$_SESSION[id]','$_POST[online_idx]','$_POST[score]')");
		alert("평점등록완료");
	}
?>

<style>
	#body {width:1400px;margin:0 auto;text-align:center;margin-top:100px;}
	td{height:50px;border-bottom:1px solid silver;}
	#hh td{border-bottom:2px solid skyblue;}
	img{height:200px;}
	button{width:160px;height:40px;}
</style>

<table id="body">
	<button id="write">글쓰기</button>
	<tr id="hh">
		<td>Before사진</td>
		<td>After사진</td>
		<td>작성자이름</td>
		<td>아이디</td>
		<td>작성일</td>
		<td>노하우</td>
		<td>평점</td>
		
		<td>평점주기</td>
	</tr>
	<?php  
		$re=sql("select * from online order by idx desc");
		while($data=fetch($re))
		{
			echo "<tr>";
			echo "<td><img src='/data/{$data['before_img']}'></td>";
			echo "<td><img src='/data/{$data['after_img']}'></td>";
			echo "<td>{$data['name']}</td>";
			echo "<td>{$data['id']}</td>";
			echo "<td>{$data['date']}</td>";
			echo "<td>{$data['con']}</td>";
			echo "<td>";
				$score=0;
				$re2=sql("select * from score where online_idx='$data[idx]' ");
				$num=rows($re2);
				while($data2=fetch($re2))
					$score+=$data2['score'];
				if($score!=0)
					$score=$score/$num;

				echo floor($score);
			echo "</td>";

			if($_SESSION['id']!=$data['id']) //외워
			{
				$re3=sql("select * from score where online_idx='$data[idx]' and user_id='$_SESSION[id]' ");
				$num3=rows($re3);
				if($num3==0)
				{
	?>
					<td><button class="score" data-id="<?php echo $data['idx']; ?>">평점주기</button></td>
	<?php

				}
			}
		}
	?>
</table>

<div class="modal fade" id="write_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div id="shop_wrap">
						<form action="" method="post" enctype="multipart/form-data">
							<table>
								<tr>
									<td>Before사진</td>
									<td><input type="file" name="before" required></td>
								</tr>
								<tr>
									<td>After사진</td>
									<td><input type="file" name="after" required></td>
								</tr>
								<tr>
									<td>노하우</td>
									<td><textarea name="con"></textarea></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" value="작성 완료"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			$("#write").click(function(){
				$("#write_modal").modal("show");
			})
		})
	</script>

	<div class="modal fade" id="score_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div id="shop_wrap">
						<form action="" method="post" enctype="multipart/form-data">
							<table>
								<tr>
									<td>평점</td>
									<td><input type="number" name="score" min="1" max="5" required></td>
								</tr>
								
								<tr>
									<td colspan="2"><input type="submit" value="평점주기"></td>
								</tr>
							</table>
							<input type="hidden" name="online_idx" id="online_idx">
						</form>						<!-- ????? -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(function(){
			$(".score").click(function(){
				$("#score_modal").modal("show");

				var no=$(this).attr("data-id"); //?이게뭔데
				$("#online_idx").val(no);
			})
		})
	</script>