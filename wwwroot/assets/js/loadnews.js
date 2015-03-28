$(function() {
//alert("sssss");
	$.ajax({
		 type: "get",
		 async: false,
		 url: 'http://lc.event.firstp2p.com/news/newslist/1',
		 dataType: "jsonp", 
		 jsonpCallback:"jsonpHandler",
		 success: function(data){
			 var html = '';
			 var list = data.list;
			 $.each(list, function(i, item){
//				 console.log(item);
				 $.each(item, function(j, info){
					 if(j == 0){
						 alert(info.title);
					 }
				 });
			 }); 
			 $('#newslist').html(html);
		 },
		 error: function(msg){
			 console.log(msg);
		 }
	 });
	
	

});
/*function load_iframe(){
	$(".").click(function(){
		var url = $(this).attr('video_url');
		var html = '<iframe height=498 width=510 src="'+video_url+'" frameborder=0 allowfullscreen></iframe>';
		$('').html(html);
	});
}*/
/* 
function jsonpHandler(){
	//alert("sdfsdf");
}
 */


