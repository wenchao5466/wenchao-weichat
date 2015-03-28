$(function() {
    $(".j_docs_delete").click(function(){
    	var $tip = $(this).nextAll('.wrong_info');
		$tip.html("");
		if ($("#activity_table").find("input:checked").length <= 0) {
			$tip.html("请至少选择一个分类");
			return false;
		}
		ids = "";
		$("#activity_table").find("input:checked").each(function() {
			var val = $(this).val();
			if (ids != "") {
				ids += ',' + val;
			} else {
				ids = val;
			}
		});
		console.log(ids);
    	var action = $(this).attr('action');
    	$.ajax({
			type: 'get',
			url: '/admin/activity/deleteActivityList/ids/' + ids+'/type/'+action,
			dataType: 'json',
			success: function(data) {
				if(data.result == 1){
					if(action=='restore'){
						alert('还原成功.');
					}else if(action=='delete'){
						alert('彻底删除成功.');
					}else if(action=='remove'){
						alert('删除成功.');
					}
					$("#activity_table").find("input:checked").each(function() {
						$(this).parent().parent('tr').remove();
					});
				}else{
					if(action=='restore'){
						alert('还原失败,请重试.');
					}else if(action=='delete'){
						alert('彻底删除失败,请重试.');
					}else if(action=='remove'){
						alert('删除失败,请重试.');
					}
				}
			}
		});
    });
    
});


