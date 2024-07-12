$(function(){
	if(!sessionStorage['ok']){
		$(".content").html(localStorage['html']);
		eqNum=localStorage['eq'];
		sessionStorage['ok']="ok";
	}else{
		eqNum=0;
		view_page();
	}

//버튼클릭
	$(document).on("click",".option button",function(){
		eqNum=$(this).attr("data-cnt");
		view_page();
	})

// 추가
	$(document).on("click","#add",function(){
		html=`연혁일자: <input type="date" class="dt" value=""><br>
				연혁내용: <input type="text" class="cn" value=""><br>`
		$("#add_modal .modal-body").html(html);
		$("#add_modal").modal('show');
	})

	$(document).on("click","#add_modal .save",function(){
		dt=$(this).parent().parent().find(".dt").val();
		cn=$(this).parent().parent().find(".cn").val();

		html=`<tr>
				<td class="dt">${dt}</td>
				<td class="cn">${cn}</td>
				<td><a href="#" class="mod">수정</a></td>
				<td><a href="#" class="del">삭제</a></td>
			</tr>`;

		$(".all-wrap .group").eq(eqNum).find("table").append(html);
		$(".option button").eq(eqNum).trigger("click");

		$("#add_modal").modal('hide');
	})

// 수정
	$(document).on("click",".mod",function(){
		dt=$(this).parent().parent().find(".dt").text();
		cn=$(this).parent().parent().find(".cn").text();

		$(this).parent().parent().attr('id','tmpPoint');

		html=`연혁일자: <input type="date" class="dt" value="${dt}"><br>
				연혁내용: <input type="text" class="cn" value="${cn}"><br>`
		$("#mod_modal .modal-body").html(html);
		$("#mod_modal").modal('show');
	})

	$(document).on("click","#mod_modal .save",function(){
		dt=$(this).parent().parent().find(".dt").val();
		cn=$(this).parent().parent().find(".cn").val();

		$(".show-wrap .group").find("#tmpPoint .cn").text(cn);
		$(".show-wrap .group").find("#tmpPoint .dt").text(dt);
		$(".show-wrap .group").find("#tmpPoint").removeAttr('id','tmpPoint');


		show=$(".show-wrap .group").html();
		$(".all-wrap .group").eq(eqNum).html(show);

		$("#mod_modal").modal('hide');
	})

// 삭제
	$(document).on("click",".del",function(){
		why=confirm("정말로 삭제하시겠습니까?");
		if(why){
			$(this).parent().parent().remove();
			show=$(".show-wrap .group").html();
			$(".all-wrap .group").eq(eqNum).html(show);
		}
	})

// 닫기
	$(document).on("click",".down",function(){
		$("#mod_modal").modal('hide');
		$("#add_modal").modal('hide');
	})
})

function view_page(){
	show=$(".all-wrap .group").eq(eqNum).html();
	$(".show-wrap .group").html(show);
	$(".show-wrap").show();
	$(".all-wrap").hide();
	save();
}

function save(){
	localStorage['html']=$(".content").html();
	localStorage['eq']=eqNum;
	sessionStorage['ok']="ok";
}