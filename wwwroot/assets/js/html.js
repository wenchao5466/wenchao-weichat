var username = "";
var coupon = "";
$(function() {
/* 	var strCookie=document.cookie; 
//	console.log(strCookie);
//	alert($.cookie('pgv_pvi'));
	if($.cookie('username')){
		var username = $.cookie('username');
//		console.log(username);
		var coupon = $.cookie('coupon');
		$(".user_login_show").each(function(){
			var string = $(this).html();
			if(username != undefined){
				string = string.replace('{{username}}', username);
			}else{
				string = string.replace('{{username}}', '');
			}
//			console.log(data.coupon);
			if(coupon != undefined){
				string = string.replace('{{coupon}}', coupon);
			}else{
				string = string.replace('{{coupon}}', '');
			}
			$(this).html(string);
		});
		$('.user_login_show').show();
		$('.user_login_hide').hide();
	}
	
	
	 */
	
	$.ajax({
		 type: "get",
		 async: false,
		 url: ajax_url+'/user/checkLogin',
		 dataType: "jsonp", 
		 jsonpCallback:"jsonpHandler",//自定义的jsonp回调函数名称，默认为jQuery自动生成的随机函数名，也可以写"?"，jQuery会自动为你处理数据
		 success: function(data){
			if(data.status == true){
				username = data.realname;
				coupon = data.coupon;
				$('.user_login_hide').remove()
				$('.user_login_show').show();
				$(".user_login_show").each(function(){
					var string = $(this).html();
					if(username != undefined && username != null){
						string = string.replace('{{username}}', username);
					}else{
						string = string.replace('{{username}}', '');
					}
					if(coupon != undefined){
						string = string.replace('{{coupon}}', coupon);
					}else{
						string = string.replace('{{coupon}}', '');
					}
					$(this).html(string);
				});
				}
		 },
		 error: function(){
			 console.log('error');
		 }
	 });
	
		 
		 
		 
});

/* 
function jsonpHandler(){
	//alert("sdfsdf");
}
 */


