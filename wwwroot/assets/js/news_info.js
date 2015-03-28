$(function() {
	
  //取消发布
  $("#cancle_publish").on("click", function() {
    var $t = $(this);
    if (confirm("确定要取消发布吗？")) {
      $.ajax({
        url: "/admin/news/cancelP/id/" + $("#news_id").val(),
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
          url = '/admin/news/publishN';
          $.ajax({
              url 		: url,
              data		: $f.serialize(),
              dataType	: "json",
              type 		: "post" ,
              success 	: function(data){
                    var str = "";
                    if(data.result==1){
                        	str +='<div >发布链接为：<a href="'+ data.url +'" target="_blank">'+ data.url +'</a>';
                        /*if(data.alis_url != ""){
                        	str +='<br>或者为：<a href="'+ data.alis_url +'" target="_blank">'+ data.alis_url +'</a>';
                        }*/
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
    
    $(".col-sm-9").css("width", "100%");


    




