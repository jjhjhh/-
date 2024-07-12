$(function(){

	html="";last_page=1;cnt=0;
	for(var i=0;i<154;i++){
		html+=`	<div class="album">
			
			</div>`;
	}
	$(".album-list").html(html);
	cnt=0;
	$.get('../xml/nihList.xml',function(data){
		console.log(data);

		$(data).find("item").each(function(){
			ccbaKdcd=$(this).find("ccbaKdcd").text();
			ccbaCtcd=$(this).find("ccbaCtcd").text();
			ccbaAsno=$(this).find("ccbaAsno").text();

			$.get('../xml/detail/'+ccbaKdcd+'_'+ccbaCtcd+'_'+ccbaAsno+'.xml',function(data2){
				imageUrl=$(data2).find("item imageUrl").text();
				ccbaMnm1=$(data2).find("item ccbaMnm1").text();

				if(imageUrl)
					html=`<div class="img"><img src="../xml/nihcImage/${imageUrl}"></div>
					<h2>${ccbaMnm1}</h2>`;
				else
					html=`<div class="error">No Image</div>
					<h2>${ccbaMnm1}</h2>`;

				$(".album-list>.album").eq(cnt).html(html);
				cnt++;
			})
		})

		total_page=Math.ceil(154/8);
		html2=`<a href="#"><<</a>
			<a href="#"><</a>`;
		for(var i=1;i<=total_page;i++)
			html2+=`<a href="#">${i}</a>`;
		html2+=`<a href="#">></a>
			<a href="#">>></a>`;
		$(".page").html(html2);

		view_page(1);
	})

	$(document).on("click",".page a",function(){
		text=$(this).text();

		if(text!="<<" && text!="<" && text!=">" && text!=">>"){
			view_page(text);
			last_page=text;
		}else{

			if(text=="<<"){
				view_page(1);
				last_page=1;
			}else if(text==">>"){
				view_page(20);
				last_page=20;
			}else if(text=="<" && last_page!=1){
				view_page(last_page-1);
				last_page--;
			}else if(text==">" && last_page!=20){
				view_page(Number(last_page)+1);
				last_page++;
			}
		}
	})
})

function view_page(now_page){
	now_num=now_page;
	console.log(now_num);
	start_no=(now_num-1)*8;
	end_no=now_num*8;

	now=0;
	$(".album-list>div").each(function(){
		if(now>=start_no && now<end_no)
			$(this).show();
		else
			$(this).hide();
		now++;
	})

	$("h3 span").text(now_num);
}