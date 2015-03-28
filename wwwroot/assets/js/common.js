;(function($) {
	
	$("#checkAll").click(function() {
		var obj = $(this);
		var check_obj = $("input[name='input_checkbox[]']");
		if (obj.prop('checked')) {
			check_obj.prop('checked', true);
		} else {
			check_obj.prop('checked', false);
			}
	});
/*   $(function() {
        (function() {
            requirejs(['converse'], function(converse) {
                converse.initialize({
                    auto_list_rooms: false,
                    auto_subscribe: false,
                    bosh_service_url: "/jwchat/http-bind/",
                    hide_muc_server: false,
                    i18n: locales.en, // Refer to ./locale/locales.js to see which locales are supported
                    prebind: false,
                    show_controlbox_by_default: false,
                    xhr_user_search: false,
                    show_only_online_users: true,
                    xhr_custom_status : false,
                    debug : false

                });
                 setTimeout(function(){
                     var u = converse_obj;
                   
                     if(!!u.autoLoading){
                            return;
                     }
                     u.connection = new Strophe.Connection(u.bosh_service_url);
                     u.autoLoading = true;
                     $.ajax({
                        url:'/user/getXmppUser',
                        dataType:"json",
                        success : function(data){
                            u.connection.connect(data.user + "@"+ service_url , data.pwd , u.onConnect);  
                            //u.connection.connect("mabaoyue@"+ service_url , "bx3h6n", u.onConnect);  
                        }    
                     });
                 }, 5000);

            });
           
            $(window).on("resize load", function() {
                if ($(this).width() < 800) {
                    $("#conversejs").hide();
                } else {
                    $("#conversejs").show();
                }

            });

            //绑定聊天界面关闭事件
            $("body").on("click" , ".oc-chat-head>.close-chatbox-button" ,function(){
                   $("#controlbox").hide();
            });

        })();


    });
*/
})(jQuery);