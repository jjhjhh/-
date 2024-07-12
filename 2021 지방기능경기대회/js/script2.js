$(function(){
	$.get('../restAPI/phone.php',function(data){
		data=JSON.parse(data);
		console.log(data);

		if(data['statusCd']!=200){
			alert("데이터베이스에 연결할 수 없습니다.");
			window.location="/";
			return false;
		}

		html=`<button data-cnt="99">전체</button>`;
		for(var i=0;i<14;i++){	
			html+=`<button data-cnt="${i}">${data['option'][i]}</button>`;
		}
		$(".option").html(html);


		for(var i=0;i<data['totalCount'];i++){
			deptNm=data['items'][i]['deptNm'];
			name=data['items'][i]['name'];
			telNo=data['items'][i]['telNo'];

			html=`<div class="phone line"><p>${name}</p> | <p>${telNo}</p></div>`;

			if(deptNm=="기획운영과") $(".all-wrap .group").eq(0).find(".phone-list").append(html);
			if(deptNm=="기획서무") $(".all-wrap .group").eq(1).find(".phone-list").append(html);
			if(deptNm=="홍보") $(".all-wrap .group").eq(2).find(".phone-list").append(html);
			if(deptNm=="시설") $(".all-wrap .group").eq(3).find(".phone-list").append(html);
			if(deptNm=="전승지원과") $(".all-wrap .group").eq(4).find(".phone-list").append(html);
			if(deptNm=="전승활성") $(".all-wrap .group").eq(5).find(".phone-list").append(html);
			if(deptNm=="이수심사") $(".all-wrap .group").eq(6).find(".phone-list").append(html);
			if(deptNm=="조사연구기록과") $(".all-wrap .group").eq(7).find(".phone-list").append(html);
			if(deptNm=="조사연구") $(".all-wrap .group").eq(8).find(".phone-list").append(html);
			if(deptNm=="기록화사업") $(".all-wrap .group").eq(9).find(".phone-list").append(html);
			if(deptNm=="무형유산진흥과") $(".all-wrap .group").eq(10).find(".phone-list").append(html);
			if(deptNm=="교육협력") $(".all-wrap .group").eq(11).find(".phone-list").append(html);
			if(deptNm=="전시") $(".all-wrap .group").eq(12).find(".phone-list").append(html);
			if(deptNm=="공연") $(".all-wrap .group").eq(13).find(".phone-list").append(html);
		}
	})

	$(document).on("click",".option button",function(){
		eqNum=$(this).attr("data-cnt");
		view_page();
	})
})

function view_page(){


	if(eqNum==99){
		$(".show-wrap").hide();
		$(".all-wrap").show();
	}else{
		show=$(".all-wrap .group").eq(eqNum).html();
		$(".show-wrap .group").html(show);
		$(".show-wrap").show();
		$(".all-wrap").hide();
	}
}