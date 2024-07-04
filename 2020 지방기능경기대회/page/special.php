<?php
	include("../include/header.php");
	member_check();

	if(isset($_POST['price']))
	{
		sql("INSERT INTO `score2` (`idx`, `uesr_id`, `user_idx`, `score`, `con`, `price`) VALUES (NULL, '$_SESSION[id]', '$_POST[user_idx]', '$_POST[score]', '$_POST[con]', '$_POST[price]')");
		alert("등록완료");
	}
?>
<style>
	#body {width:1400px;margin:0 auto;text-align:center;margin-top:100px;}
	#body2 {width:1400px;margin:0 auto;text-align:center;}
	td{height:50px;border-bottom:1px solid silver;}
	#hh td{border-bottom:2px solid #c6f;}
	img{height:250px;}
	button{width:160px;height:40px;}
</style>

<?php 

	$re=sql("select * from member where lv='2' ");
	while($data=fetch($re))
	{
?>
		<table id="body">
			<tr id="hh">
				<td>전문가 사진</td>
				<td>이름</td>
				<td>아이디</td>
				<td>평점</td>
				<td>시공후기</td>
			</tr>
			<tr>
				<td><img src="/data/<?php echo $data['img']; ?>" alt=""></td>
				<td><?php echo $data['name']; ?></td>
				<td><?php echo $data['id']; ?></td>
				<td>
				<?php  
					$score=0;
					$re2=sql("select * from score2 where user_idx='$data[idx]' ");
					$num=rows($re2);
					while($data2=fetch($re2))
						$score+=$data2['score'];
					if($score!=0)
						$score=$score/$num;

					echo floor($score);
				?>
				</td>
				<td><button class="score" data-id="<?php echo $data['idx']; ?>">시공후기작성</button>
				</td>		
			</tr>
		</table>

		<table id="body2">
			<tr>
				<td>전문가 이름/전문가 아이디</td>
				<td>작성자 이름/작성자 아이디</td>
				<td>비용</td>
				<td>내용</td>
				<td>평점</td>
			</tr>

			<?php  //이걸어케외우노ㅜㅜㅜ
				$re2=sql("select * from score2 where user_id='$data[idx]' ");
				while($data2=fetch($re2))
				{
					$re3=sql("select * from member where id='$data2[user_id]' ");
					$data3=fetch($re3);
			?>
				<tr>
					<td><?php echo $data['name'] ?> / <?php echo $data['id'] ?></td>
					<td><?php echo $data3['name'] ?> / <?php echo $data2['user_id'] ?></td>
					<td><?php echo $data2['price'] ?></td>
					<td><?php echo $data2['con'] ?></td>
					<td><?php echo $data2['score'] ?></td>
				</tr>
			<?php
			}
			?>
		</table>
<?php
	}
?>

<div class="modal fade" id="score_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div id="shop_wrap">
						<form action="" method="post" enctype="multipart/form-data">
							<table>
								<tr>
									<td>비용</td>
									<td><input type="text" name="price" required></td>
								</tr>
								<tr>
									<td>내용</td>
									<td><textarea name="con" required></textarea></td>
								</tr>
								<tr>
									<td>평점</td>
									<td><input type="number" name="score" min="1" max="5" required></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" value="평점 주기"></td>
								</tr>
							</table>
							<input type="hidden" name="user_idx" id="user_idx">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(function(){
			$(".score").click(function(){
				$("#score_modal").modal("show");
				var no=$(this).attr('data-id');
				$("#user_idx").val(no);
			})
		})
	</script>