$(function() {
	$(".category_manage").click(function() {
    	var category_id = $(this).attr('catetory_id');
    	var category_name = $(this).attr('category_name');
    	var site_url = $(this).attr('site_url');
    	var group = $(this).attr('group');
    	console.log(category_id);
    	console.log(category_name);
    	console.log(group);
//    	alert(category_id);
    	if(category_name){
    		$("#category_title").html('修改分类');
    		$("#add_category_btn").html('修改');
    	}else{
    		$("#category_title").html('新增分类');
    		$("#add_category_btn").html('添加');
    	}
    	$("#category_id").val(category_id);
    	$("#site_url").val(site_url);
    	$("#category_name").val(category_name);
    	$("#group").val(group);
    });
    
    $("#add_category_btn").click(function(){
    	$.ajax({
            type: 'post',
            url: '/admin/category/ajaxSave',
            dataType: "json",
            data: $("#category_form").serialize(),
            success: function(msg) {
            	window.location.reload();
            }
        });
    })
    
    
    
	//删除文档判断
	$(".j_category_delete").click(function() {
		var $tip = $(this).nextAll('.wrong_info');
		$tip.html("");
		if ($("#category_table").find("input:checked").length <= 0) {
			$tip.html("请至少选择一个分类");
			return false;
		}
		ids = "";
		$("#category_table").find("input:checked").each(function() {
			var val = $(this).val();
			if (ids != "") {
				ids += ',' + val;
			} else {
				ids = val;
			}
		});
		console.log(ids);
		$.ajax({
			type: 'get',
			url: '/admin/category/check/ids/' + ids,
			dataType: 'json',
			success: function(data) {
				if(data.result == 0){
					var string = '';
					var obj = data.category;
					for (var el in obj) {
						if(string != ''){
							string += ',['+obj[el].name+']';
						}else{
							string += '['+obj[el].name+']';
						}
					}
					if(confirm(string+'分类下有活动页面，确实要删除吗？')){
						window.location.href='/admin/category/delete/ids/'+ids;
					}
				}else{
					window.location.href='/admin/category/delete/ids/'+ids; 
				}
			}
		});
	});
});


