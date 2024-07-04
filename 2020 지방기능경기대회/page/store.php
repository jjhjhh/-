<?php  
	include("../include/header.php");
?>
	
	<div class="shop_wrap">
		<div>
			<div class="none" style="display: none">일치하는 상품이 없습니다</div>
			<div class="item_list flex">
				<div>
					<img src="/resources/item/product_1.jpg" alt="">
					<h3 class="item_name">이름</h3>
					<p class="brand_name">브랜드</p>
					<p class="price">가격</p>
				</div>
			</div>
			<div class="cc">
				<input type="text" placeholder="검색" id="search" name="search">
				<div id="drop"><h3>이곳에 상품을 넣어주세요.</h3></div>
				<div class="cart">
					<!-- <div>
						<img src="/resources/item/product_1.jpg" alt="">
						<ul>
							<li>상품명: </li>
							<li>브랜드명: </li>
							<li>가격: </li>
							<li>수량: <input type="number" min="1"></li>
							<li>합계:</li>
							<li><button class="delete">삭제</button></li>
						</ul>
					</div> -->
				</div>
				<div class="line">
					<h3 class="total_price">총 합계: <span>0</span>원</h3>
					<button id="buy-btn">구매하기</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="buy_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<table>
						<tr>
							<td>이름</td>
							<td><input type="text" name="b_name"></td>
						</tr>
						<tr>
							<td>주소</td>
							<td><input type="text" name="b_add"></td>
						</tr>
					</table>
					<button id="buy_ok" data-dismiss="modal">구매완료</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="ok_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<table>
						<thead>
							<tr>
								<td>상품명</td>
								<td>가격</td>
								<td>수량</td>
								<td>총합계</td>
								<td>구매일시</td>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<div class="cart-price">총합계: <span></span></div>
					<button id="buy_ok" data-dismiss="modal">구매완료</button>
				</div>
			</div>
		</div>
	</div>


	<footer class="full-width">Copyright (C) 2020 by MyHome Inc All Rights Reserved.</footer>

	<script src="/resources/script.js"></script>
</body>
</html>