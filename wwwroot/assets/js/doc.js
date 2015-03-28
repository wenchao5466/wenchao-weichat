$(function() {
	
        Firstp2p.upload($('#content_h5'), {
            switch : "html5", //上传方式选择 html5 flash normal
            static : ["css/html5.v1.css"], //需要额外加载的静态资源 css和js
            datatype : "json", //返回值类型
            onsuccess : function(ele, data){ //上传成功回调
                console.log(data);
                if(data.result==1){
					$("#myimg_h5").html('<img src="'+data.img_url+'" width="100px;" height="100px">');
					$("#weixinimg").val(data.img_url);
	            }else{
	            	alert(data.msg);
	            }
            },
            onerror : function(e){ //产生错误回调
                console.log('error', e);
            },
            progress : function(per, ele){ //上传进度条回调, 参数 per 代表百分比
                var pele = ele.parent().find(".progress");
                pele.css({"display": "block", "width": per + "%"});
                if (per>=100) {
                    pele.hide(100);
                }
            },
            upload_url : "/admin/activity/ajaxupload", //上传地址
            //文件类型限制
            type : "'jpeg|jpg|png|gif'", //允许上传类型
            size : 1 * 1024 * 1024, // 1M 单个文件大小限制
            post_params: {"test": "html5"} //post参数
        });

            
    
    
	//表单提交验证
	$("#doc_form").submit(function(){
		var flag = false;
		$("#editor").val(ueditor.getContent());
		var name = $("#doc_name").val();
		var content = $("#editor").val();
		if(name == ""){
			alert("请输入活动标题");
       	 	return false;
       }else if(content == ""){
    	   alert("请输入内容");
      	 	return false;
       }else{
			$.ajax({
		        url: "/admin/activity/ajaxCheck/",
		        dataType	:	"json",
		        type 		:	"post",
		        async		:	false,
		        data		:	$("#doc_form").serialize(),
		        success		:	function(data) {
		            if(data.result == 1){
		            	flag = true;
		            }else{
		            	alert(data.msg);
		            	flag = false;
		            }
		        }
			})
       	}
		return flag;
	});
	
	
	
	
	
	
	
     //取消发布
  $("#cancle_publish").on("click", function() {
    var $t = $(this);
    if (confirm("确定要取消发布吗？")) {
//    	alert("ss");
//    	alert("/admin/activity/cancelPublish/activity_id/" + $("#doc_id").val());
      $.ajax({
        url: "/admin/activity/cancelPublish/activity_id/" + $("#doc_id").val(),
        dataType: "json",
        success: function(data) {
            
            if(data.result == 1){
                $("#release").show();
                $("#publish_url").hide();
                $t.hide();
            }
            
        }
      })
    }
  });

  


     //发布表单提交
    $("#p_button").click(function(){
          var $t = $(this),
          $f = $t.closest("form"),
          url = '/admin/activity/publishActivity';
          $.ajax({
              url 		: url,
              data		: $f.serialize(),
              dataType	: "json",
              type 		: "post" ,
              success 	: function(data){
                    var str = "";
                    if(data.result==1){
                        	str +='<div >发布链接为：<a href="'+ data.url +'" target="_blank">'+ data.url +'</a>';
                        if(data.alis_url != ""){
                        	str +='<br>或者为：<a href="'+ data.alis_url +'" target="_blank">'+ data.alis_url +'</a>';
                        }
                        	str+="</div>";
//                        console.log(str);
                        $("#publish_url").html(str);
                        $("#publish_url").show();
                        $("#release").hide();
                        $("#cancle_publish").show();
                    }else if(data.result == 2){
                    	alert(data.msg);
                    }
              }
          });


    });


    //新建文档获取焦点
    var ueditor = UE.getEditor('editor',{enterTag:''});
    $("#input-name").focus();
    
    $("#preview").click(function() {
        var id = $(this).attr('activity_id');
//        return $EDITORUI["edui273"]._onClick();
//    	alert(ueditor.getAllHtml());
    	window.open('/admin/activity/preview/id/'+id);
    });

    var arr = [];
	
});
    
    $(".col-sm-3").hide();
    $(".col-sm-9").css("width", "100%");


    




