$(function() {
	//将用户表单初始化
	$(".user_manage").click(function() {
    	var user_id = $(this).attr('user_id');
    	var user_name = $(this).attr('user_name');
    	var user_email = $(this).attr('email');
    	var authority = $(this).attr('is_admin');
    	var group = $(this).attr('group');
    	if(group!=''){
    		var group_list = group.split(",");
//    		console.log(group_list);
    		$("input[name='group[]']").each(function() {
    			for(var el in group_list){
//    				console.log(group_list[el]);
//    				console.log($(this).attr("id")+'---------------'+'group'+group_list[el]);
    				if($(this).attr("id")=='group'+group_list[el]){
    					$(this).attr("checked",true);
    				}
    			}
    		});
    	}

    	if(user_name){
    		$("#user_title").html('修改用户信息');
    		$("#add_user_btn").html('修改');
//    		$("#user_name").attr('disabled',true);
//    		$("#user_email").attr('disabled',true);
    	}else{
//    		$("#user_name").attr('disabled',false);
//    		$("#user_email").attr('disabled',false);
    		$("#user_title").html('新增加用户');
    		$("#add_user_btn").html('添加');
    	}
    	if(authority&&authority ==1){
    		$("#authority_admin").attr('checked',true);
    	}else{
    		$("#authority_general").attr('checked',true);
    	}
    	$("#user_id").val(user_id);
    	$("#user_name").val(user_name);
    	$("#user_email").val(user_email);
    });
    
    $("#add_user_btn").click(function(){
//    	console.log($("#user_form").serialize());
//    	console.log($("#user_id").val());
    	$.ajax({
            type: 'post',
            url: '/admin/user/ajaxSave',
            dataType: "json",
            data: $("#user_form").serialize(),
            success: function(msg) {
            	if(msg.result == 1){
            		alert('保存成功.');
            		window.location.reload()
            	}else{
            		alert(msg.result);
            	}
            }
        });
    });
	

	//删除用户判断
	$(".j_docs_delete").click(function() {
		var $tip = $(this).nextAll('.wrong_info');
		$tip.html("");
		if ($("#user_table").find("input:checked").length <= 0) {
			$tip.html("请至少选择一个用户");
			return false;
		}
		ids = "";
		$("#user_table").find("input:checked").each(function() {
			var val = $(this).val();
			if (ids != "") {
				ids += ',' + val;
			} else {
				ids = val;
			}
		});
//		console.log(ids);
		$.ajax({
			type: 'get',
			url: '/admin/user/deleteUser/ids/' + ids,
			dataType: 'json',
			success: function(data) {
				if(data.result == 1){
					alert('删除成功.');
					$("#user_table").find("input:checked").each(function() {
						$(this).parent().parent('tr').remove();
//						console.log($(this).parent());
//						console.log($(this).parent().find('tr'));
					});
				}else{
					alert('删除失败,请重试.');
				}
			}
		});
	});
	
	
	
	
	
	
	
	
	
	
	
	//管理分类弹窗添加按钮
	$("#j_add_group").click(function(){
		group_name = $("#group_name").val();
		if(!group_name){
			alert("分组名称不能为空");
			return false;
		}
		$.ajax({
			type: 'get',
			url: '/admin/user/addGroup/group_name/'+group_name,
			dataType: 'json',
			success: function(msg) {
				if(msg.result != 1){
					alert(msg.msg)
					return false;
				}else if(msg.result == 1){
					$("#group_name").val("");
					data = '<div class="yd_pop" id="div'+msg.id+'">';
					data += '<h2 id="ulh2'+msg.id+'">';
					data += '<label class="edit_label">'+msg.name+'</label>';
					data += '<input class="edit_input" id="'+msg.id+'" type="text" value="宋文超" style="display:none">';
					data += '<a href="javascript:del('+msg.id+');" class="j_del_classify">删除</a>';
					data += '</h2>';
					data += '</div>';
					$("#group_list").append(data)
//					bindDoc();
				}
			}
		});
	});
$("#add_group_button").click(function(){
	window.location.reload();
});

});

//管理分组--删除分组
function del(id){
	if (confirm('删除后将无法恢复,确定要删除?')) {
		$.ajax({
			type: 'get',
			url: '/admin/user/deleteGroup/group_id/' + id,
			dataType: 'json',
			success: function(msg) {
				if(msg.result != 1){
					alert(msg.msg)
					return false;
				}else if(msg.result == 1){
					$("#div"+id).remove()
					$("#option"+id).remove()
				}
			}
		});
	}
}
