product_list=[];
cart_list=[];

$(function(){
	$.get({
		url:'/resources/store.json',
		dataType:'json',
		success:function(data){
			product_list=data;
			var str="";

			for(var k in product_list)
			{
				str+=`<div data-id="${k}">
							<img src="/resources/item/${product_list[k]['photo']}" alt="">
							<h3 class="name">${product_list[k]['product_name']}</h3>
							<p class="brand">${product_list[k]['brand']}</p>
							<p class="price">${product_list[k]['price']}</p>
						</div>`;
			}
			$(".item_list").html(str);
			drag();
			search();
		}
	})

	$("#buy-btn").click(function(){
		if(cart_list.length==0)
			alert("장바구니에상품이업ㄱ습니다");
		else{
		$("#buy_name").val("");
		$("#buy_adr").val("");
		$("#buy_modal").modal('show');
	}
	})

	$("#buy_ok").click(function(){
		var buy_name=$("#buy_name").val();
		var buy_adr=$("#buy_adr").val();

		if(buy_name == "" || buy_adr =="")
			alert("모든 값을 입력해 주세요");
		else{
			$("#buy_modal").modal('hide');


			var str="";
			var cart_price=0;
			for(var k in cart_list)
			{
				var id=cart_list[k][0];
				var price=Number(product_list[id]['price'].replace(/,/g,""));
				var date = new Date();
				var year=date.getFullYear();
				var month=date.getMonth()+1;
				var day=date.getDay();
				var hour=date.getHours();
				var min=date.getMinutes();
				price=price * cart_list[k][1];
				cart_price+=price;
				console.log(cart_price);

				str+=`<tr>
							<td>${product_list[id]['product_name']}</td>
							<td>${product_list[id]['price']}</td>
							<td>${cart_list[k][1]}</td>
							<td>${price}</td>
							<td>${year}-${month}-${day} ${hour}-${min}</td>
						</tr>`;
			}
			$("#ok_modal tbody").html(str);
			$("#cart_price span").text(cart_price);
			$("#ok_modal").modal('show');
			cart_list= [];
			view_cart();
			total_price();
		}
	})

})

function drag(){
	$(".item_list > div").draggable({
		revert:true
	})

	$("#drop").droppable({
		hoverClass:"hit",

		drop:function(elem,idx){
			var id=$(idx.draggable).attr('data-id');
			var price=Number(product_list[id]['price'].replace(/,/g,""));
			
			ok=1;
			for(var k in cart_list)
			{	
				if(cart_list[k][0]==id)
				{
					ok=0;
					alert("이미 장바구니에 담긴 상품입니다.");
				}
			}

			if(ok)
				cart_list.push([id,1]);

			view_cart();
		}
	})
}

function view_cart(){
	str="";
	for(var k in cart_list)
	{
		var id=cart_list[k][0];
		var price=Number(product_list[id]['price'].replace(/,/g,""));

		str+=`<div data-id="${cart_list[k][0]}" data-cart-id="${k}">
				<img src="/resources/item/${product_list[id]['photo']}" alt="">
				<ul>
					<li>상품명: ${product_list[id]['product_name']}</li>
					<li>브랜드명: ${product_list[id]['brand']}</li>
					<li>가격: ${product_list[id]['price']}</li>
					<li>수량: <input type="number" min="1" value="${cart_list[k][1]}"></li>
					<li>합계:${price}</li>
					<li><button class="delete">삭제</button></li>
				</ul>
			</div>`;
	}
	$(".cart").html(str);
	total_price();

	$(".cart input").on("keyup change",function(){
		val=$(this).val();
		id=$(this).parent().parent().parent().attr("data-id");
		cart_id=$(this).parent().parent().parent().attr("data-cart-id");

		cart_list[cart_id][1]=val;

		var price=Number(product_list[id]['price'].replace(/,/g,""));
		price= price * cart_list[cart_id][1];

		$(this).parent().next().text("합계: "+price);
		total_price();
	})

	$(".delete").click(function(){
		cart_id=$(this).parent().parent().parent().attr("data-cart-id");
		cart_list.splice(cart_list,1);
		view_cart();
		total_price();
	})
}

function total_price(){
	price=0;
	for(var k in cart_list)
	{
		var id=cart_list[k][0];
		var one_price=Number(product_list[id]['price'].replace(/,/g,""));
		price+= one_price*cart_list[k][1];
	}
	$(".total_price span").text(price);
}

// 초성검색
function search(){
	var cho=['ㄱ','ㄲ','ㄴ','ㄷ','ㄸ','ㄹ','ㅁ','ㅂ','ㅃ','ㅅ','ㅆ','ㅇ','ㅈ','ㅉ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ'];
	
	$("#search").on("keyup change",function(){
		var val=$(this).val();
		var val_leng=val.length;
		var view_count=0;

		$(".item_list > div").each(function(){
			var ok=0;
			var name=$(this).find(".name").text();
			var name_str=name.split("");
			var brand=$(this).find(".brand").text();
			var brand_str=brand.split("");

			var count=0;

			for(var k=0;k<name.length;k++) //now_item_val구하려고 이짓거리 한는거임
			{
				var now_val= val.substr(count,1);
				var now_item_val= name.substr(k,1);

				if($.inArray(now_val,cho)>=0)
				{
					var sTest=now_item_val;
					var nTmp=sTest.charCodeAt(0) - 0xAC00;
					jong=nTmp % 28; // 종성
                    jung=( (nTmp-jong)/28 ) % 21; // 중성
                    chosung=( ( (nTmp-jong)/28 ) - jung ) / 21; //초성

					now_item_val=cho[chosung];

				}

				if(now_val==now_item_val)//드디어비교한
					count++;
				else
					count=0;

				if(count==val_leng)
				{
					ok=1;
					for(var g=k-count+1;g<=k;g++)
						name_str[g]="<mark>"+name_str[g]+"</mark>";

					count=0
				}
			}

			for(var k=0;k<brand.length;k++)
			{
				var now_val=val.substr(count,1);
				var now_item_val=brand.substr(k,1);

				if($.inArray(now_val,cho)>=0)
				{
					var sTest=now_item_val;
					var nTmp=sTest.charCodeAt(0) - 0xAC00;
					jong=nTmp % 28; // 종성
                    jung=( (nTmp-jong)/28 ) % 21; // 중성
                    chosung=( ( (nTmp-jong)/28 ) - jung ) / 21; //초성

					now_item_val=cho[chosung];
				}

				if(now_item_val==now_val)
					count++;
				else
					count=0;

				if(count==val_leng)
				{
					ok=1;
					for(var g=k-count+1;g<=k;g++)
						brand_str[g]="<mark>"+brand_str[g]+"</mark>";
				}
				count=0;
			}

			$(this).find(".name").html(name_str.join(""));
			$(this).find(".brand").html(brand_str.join(""));

			if(ok)
			{
				$(this).show();
				view_count++;
			}else
				$(this).hide();

			if(view_count>=1)
				$(".none").hide();
			else {
				$(".none").show(); //display:none 인 것도 보임
			}
		})
	})
}