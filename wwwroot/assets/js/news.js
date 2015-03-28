$(function() {

	$("#manage_category").click(function(){
		loadcategory();
	});
	loadcategory();

	$(".j_news_delete").click(function() {
		var $tip = $(this).nextAll('.wrong_info');
		$tip.html("");
		if ($("#user_table").find("input[name='input_checkbox[]']:checked").length <= 0) {
			$tip.html("请至少选择一篇文档");
			return false;
		}
		id = "";
		$("#user_table").find("input:checked").each(function() {
			var val = $(this).val();
			if (id != "") {
				id += ',' + val;
			} else {
				id = val;
			}
		});
		if (confirm('删除后将无法恢复,确定要删除?')) {
			$.ajax({
				type: 'get',
				url: '/admin/news/ajaxdel/id/' + id,
				dataType: 'json',
				success: function(msg) {
					$("#user_table").find("input:checked").prop('checked', false);
					for (var el in msg.delete_ids) {
						 $("#user_table tr[id='"+msg.delete_ids[el]+"']").remove();
					}
				}
			});
		}
	});
});


function loadcategory(){
	$(window).resize(
			function() {
				var h = Math.max($(window).height() - 0, 420);
				$('#container, #data, #tree, #data .content').height(h).filter('.default').css('lineHeight', h + 'px');
			}).resize();
	$('#tree').jstree({
		'core' : {
			'data' : {
				'url' : '/admin/news/loadCategory/action/get_node/',
				'data' : function(node) {
					return {
						'id' : node.id
					};
				}
			},
			'check_callback' : true,
			'themes' : {
				'responsive' : false
			}
		},
		'plugins' : [ 'state', 'dnd', 'contextmenu', 'wholerow', 'types' ],
		
		"types" : {
			"default" : {
				"icon" : "glyphicon glyphicon-flash"
			},
			"demo" : {
				"icon" : "glyphicon glyphicon-ok"
			}
		},
		"contextmenu" : {
			items: {
				"create" : {
				"separator_before"	: false,
				"separator_after"	: true,
				"_disabled"			: false, //(this.check("create_node", data.reference, {}, "last")),
				"label"				: "创建",
				"action"			: function (data) {
					var inst = $.jstree.reference(data.reference),
						obj = inst.get_node(data.reference);
					inst.create_node(obj, {}, "last", function (new_node) {
						setTimeout(function () { inst.edit(new_node); },0);
					});
				}
			},
			"rename" : {
				"separator_before"	: false,
				"separator_after"	: false,
				"_disabled"			: false, //(this.check("rename_node", data.reference, this.get_parent(data.reference), "")),
				"label"				: "重命名",
				"action"			: function (data) {
					var inst = $.jstree.reference(data.reference),
						obj = inst.get_node(data.reference);
					inst.edit(obj);
				}
			},
			"remove" : {
				"separator_before"	: false,
				"icon"				: false,
				"separator_after"	: false,
				"_disabled"			: false, //(this.check("delete_node", data.reference, this.get_parent(data.reference), "")),
				"label"				: "删除",
				"action"			: function (data) {
					var inst = $.jstree.reference(data.reference),
						obj = inst.get_node(data.reference);
					if(inst.is_selected(obj)) {
						inst.delete_node(inst.get_selected());
					}
					else {
						inst.delete_node(obj);
					}
				}
			},
			}

		}
	}).on('delete_node.jstree', function(e, data) {
		$.post('/admin/news/loadCategory/action/delete_node', {
			'id' : data.node.id
		}).fail(function() {
			data.instance.refresh();
		});
	}).on('create_node.jstree', function(e, data) {
//		console.log(data);
//		alert(data);
		$.post('/admin/news/loadCategory/action/create_node', {
			'id' : data.node.parent,
			'position' : data.position,
			'text' : data.node.text
		}).done(function(d) {
			console.log(d);
//			alert(d.id);
			data.instance.set_id(data.node, d.id);
		}).fail(function() {
			data.instance.refresh();
		});
	}).on('rename_node.jstree', function(e, data) {
		//alert(data.node.id);
		$.post('/admin/news/loadCategory/action/rename_node', {
			'id' : data.node.id,
			'text' : data.text
		}).fail(function() {
			//alert(d);
			data.instance.refresh();
		});
	}).on('changed.jstree',function(e, data) {
		
			/*if (data && data.selected && data.selected.length) {
				$.get('/admin/news/loadCategory/action/get_content/id/'+ data.selected.join(':'), function(d) {
					$('#data .default').html(d.content).show();
				});
			} else {
				$('#data .content').hide();
				$('#data .default').html('Select a file from the tree.').show();
			}*/
		
		//alert(url);
			//window.location.href=url;
		}).on("click.jstree", ".jstree-anchor", $.proxy(function (e) {
			e.preventDefault();
			if(e.currentTarget !== document.activeElement) { $(e.currentTarget).focus(); }
			setTimeout(function(){
				var id = $(e.target).parents('li').attr('id');
				var url = "/admin/news/index/category/"+id;
				window.location.href=url;
			},100);
		}, this))
	}